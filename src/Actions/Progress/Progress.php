<?php

final class Progress {

	public static function Clear(){
		Scope::$WINDOW['progress_log_entries_produced'] = null;
		Scope::$WINDOW['progress_log_entries_shown'] = null;
		Scope::$WINDOW['progress'] = null;
		Scope::$WINDOW['progress_cancelled'] = null;
		Scope::$WINDOW['progress_finished'] = null;
	}

	private static function GetLogEtriesProduced(){ $r = Scope::$WINDOW['progress_log_entries_produced']; return is_null($r) ? 0 : $r; }
	private static function SetLogEtriesProduced($value){ Scope::$WINDOW['progress_log_entries_produced'] = $value; }
	private static function GetLogEtriesShown(){ $r = Scope::$WINDOW['progress_log_entries_shown']; return is_null($r) ? 0 : $r; }
	private static function SetLogEtriesShown($value){ Scope::$WINDOW['progress_log_entries_shown'] = $value; }
	private static function GetLogEntry($i){ return Scope::$WINDOW['progress_log_entry_'.$i]; }
	private static function SetLogEntry($i,$value){ Scope::$WINDOW['progress_log_entry_'.$i] = $value; }
	private static function DeleteLogEntry($i){ Scope::$WINDOW['progress_log_entry_'.$i] = null; }
	public static function GetLogEntries(){
		$r = array();
		$log_entries_shown = self::GetLogEtriesShown();
		$log_entries_produced = self::GetLogEtriesProduced();
		self::SetLogEtriesShown($log_entries_produced);
		if ($log_entries_shown<$log_entries_produced){
			for($i = $log_entries_shown; $i<$log_entries_produced; $i++){
				$r[$i] = self::GetLogEntry($i);
				self::DeleteLogEntry($i);
			}
		}
		return $r;
	}
	private static function AddLogEntry(Message $message){
		$c = new MessageControl($message);
		$entry = strval($c->WithShowBorder(false));
		$log_entries_produced = self::GetLogEtriesProduced();
		self::SetLogEntry($log_entries_produced,$entry);
		self::SetLogEtriesProduced(++$log_entries_produced);
	}

	public static function GetProgress(){ $r = Scope::$WINDOW['progress']; return is_null($r) ? 0.0 : $r; }
	private static function SetProgress($value){ Scope::$WINDOW['progress'] = $value; }

	public static function HasFinished(){ return Scope::$WINDOW->ForceGet('progress_finished') === true; }
	public static function SetFinished($value){

		Scope::$WINDOW['progress_finished'] = $value;

	}
	public static function Finish(Message $m=null){
		self::AddLogEntry(is_null($m) ? new SuccessMessage(Lemma::Pick('MsgProgressCompleted')) : $m);
		self::SetProgress(1.0);
		self::SetFinished(true);
	}
	public static function HandleExceptionAndFinish(Exception $ex){
		self::AddLogEntry(Message::Cast($ex));
		self::SetProgress(1.0);
		self::SetFinished(true);
		if (!($ex instanceof ApplicationException)) {
			if (DEV)
				Debug::RecordExceptionServed($ex,'Progress Exception Handler.');
			else
				Debug::RecordExceptionServedGeneric($ex,'Progress Exception Handler.');
		}
	}

	public static function IsCancelled(){ return !is_null(Scope::$WINDOW->ForceGet('progress_cancelled')); }
	public static function Cancel(){ Scope::$WINDOW['progress_cancelled'] = true; }
	private static function CheckCancelled(){
		if(!self::HasFinished())
			if (self::IsCancelled())
				throw new ApplicationException(Lemma::Pick('MsgProgressCancelled'));
	}





	private static $has_started = false;

	public static function Start(Message $m, $time_to_finish_is_not_known = false ){
		self::Clear();
		set_time_limit(0);
		self::$has_started = true;
		self::$step = 0.01;
		self::Update( $time_to_finish_is_not_known ? -1 : 0, $m );
	}
	public static function Shutdown(){
		if (!self::$has_started) return;
		self::SetFinished(true);
	}

	public static function Write(Message $message){
		if (!self::$has_started) return;
		self::AddLogEntry($message);
		self::CheckCancelled();
	}

	public static function Dump($var){
		self::Write(new InfoMessage('<pre>'.new Html(Debug::GetVariableAsString($var)).'</pre>','oxy/ico/Bug'));
	}

	public static function Update($absolute_progress,Message $message = null){
		if (!self::$has_started) return;
		self::SetProgress($absolute_progress);
		if (!is_null($message)) self::AddLogEntry($message);
		self::CheckCancelled();
	}


	private static $step = 0.01;
	private static $next_milestone = null;
	public static function SetNextMilestone($milestone,$steps){
		if (!is_null(self::$next_milestone))
			self::Update(self::$next_milestone);
		else
			self::$next_milestone = self::GetProgress();
		self::$step = $steps==0 ? 0.01 : floatval($milestone - self::$next_milestone) / floatval($steps);
		self::$next_milestone = $milestone;
	}
	public static function UpdateStep(Message $message = null){
		if (!self::$has_started) return;
		if (is_null(self::$next_milestone)) throw new Exception('No progress milestone is set.');
		self::Update( min(self::$next_milestone,self::GetProgress()+self::$step),$message);
	}
	public static function SkipSteps($steps){
		if (!self::$has_started) return;
		if (is_null(self::$next_milestone)) throw new Exception('No progress milestone is set.');
		self::Update( min(self::$next_milestone,self::GetProgress()+(self::$step*$steps)));
	}
}


