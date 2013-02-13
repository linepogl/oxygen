<?php
set_time_limit(0);

$exception_recorded = @$_POST['exception_recorded'] === 'true';
$serial = @$_POST['serial'];
$lck_filename = @$_POST['lck_filename'];
$acc_filename = @$_POST['acc_filename'];
$app_name = @$_POST['app_name'];
$err_filename = @$_POST['err_filename'];
$emails = @unserialize($_POST['emails']); if (!is_array($emails)) $emails = array();
$subject = @$_POST['subject'];
$head = @unserialize($_POST['head']); if (!is_array($head)) $head = array();
$body = @$_POST['body'];

//
// opening phase
//
if (!$exception_recorded) {
	file_put_contents( $acc_filename , $serial . "\n" , FILE_APPEND | LOCK_EX );
}

$f_lck = fopen($lck_filename,'w');
if (!flock($f_lck,LOCK_EX | LOCK_NB)) {  // some other accumulator is already running
	fclose($f_lck);
	die;
}


function SendEmail($from_name,$from_email,$rcpt,$subject,$body){
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= 'From: '. $from_name . ' <'. $from_email .'>'."\r\n";
	$headers .= 'Sender: '. $from_email ."\r\n";
	$msg = '<html><head>';
	$msg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
	$msg .= '<title>'.$subject.'</title>';
	$msg .= '</head><body>';
	$msg .= str_replace( array('<','>') , array("\n<",">\n") ,$body );
	$msg .= '</body></html>';
	$subject = '=?UTF-8?B?'.base64_encode($subject).'?=';
	mail($rcpt, $subject, $msg, $headers);
}




for($wave = 1; ; $wave++) {

	//
	// waiting phase
	//
	switch($wave) {
		case 1: sleep(60 * 0.5); break; // be conservative at start: each exception will keep a php process open for 30 seconds more than it should.
		case 2: sleep(60 * 2.0); break; // then relax a little: this is a repeating exception, so it is better to keep a process open.
		case 3: sleep(60 * 2.5); break;
		case 5: sleep(60 * 5.0); break;
		default:sleep(60 * 5.0); break;
	}




	//
	// processing phase
	//
	$f_acc = fopen($acc_filename,'a+');
	flock($f_acc,LOCK_EX);

	$s = trim(file_get_contents( $acc_filename ));
	$a = empty($s) ? array() : explode("\n",$s);

	if (count($a) ==  0) { // nothing accumulated
		@unlink($lck_filename);  // unlock carefully, first the process
		flock($f_lck,LOCK_UN);
		fclose($f_lck);

		@unlink($acc_filename);  // then the file (the initiator will have to recheck for the process...)
		flock($f_acc,LOCK_UN);
		fclose($f_acc);

		die;
	}

	file_put_contents( $acc_filename , '' ); // clear the file
	flock($f_acc,LOCK_UN);                   // unlock it to start accumulating new entries
	fclose($f_acc);


	//
	// recording phase
	//
	$new_serial = str_replace(',','.',sprintf('%0.3f',microtime(true)));
	$new_err_filename = str_replace('.err','.'.$serial.'~'.$wave.'.x'.count($a).'.err',str_replace($serial,$new_serial,$err_filename));
	$new_subject = str_replace($serial,$serial.'~'.$wave,$subject) . ' (x'.count($a).')';

	$i = 1;
	$wave_info = '<br/><br/>&bull;&bull;&bull;&gt; #'.$serial.' ('.date('Y-m-d H:i:s',intval($serial)).') x'.count($a).' (Deferred wave '.$wave.')';
	foreach ($a as $t) $wave_info .= '<br/>'.str_repeat('&nbsp;',max(0,2-intval(log10($i)))).$i++.'. #'.$t . ' (' . date('Y-m-d H:i:s',intval($t)).')';

	$new_body = str_replace($serial,$new_serial.$wave_info,$body);

	// write log file
	file_put_contents( $new_err_filename, serialize(array( 'head' => $head , 'body' => $new_body )));

	// send e-mail
	foreach ($emails as $email) @SendEmail( 'oxygen@'.$app_name , $email , $email , $new_subject , $new_body );

}