<?php
Oxygen::RegisterResourceManager('oxy','_oxy');
if (false) { class oxy extends _oxy {} }
abstract class _oxy {

	//
	//
	// Icons
	//
	//

	// 000 - Basic
	public static function icoSpacer             (){ return new Glyph('oxy-icon',0xE000); }
	public static function icoBlock              (){ return new Glyph('oxy-icon',0xE001); }
	public static function icoItem               (){ return new Glyph('oxy-icon',0xE001); }
	public static function icoItems              (){ return new Glyph('oxy-icon',0xE002); }
	public static function icoUser               (){ return new Glyph('oxy-icon',0xE003); }
	public static function icoUsers              (){ return new Glyph('oxy-icon',0xE004); }
	public static function icoSettings           (){ return new Glyph('oxy-icon',0xE005); }
	public static function icoEmail              (){ return new Glyph('oxy-icon',0xE006); }
	public static function icoPrint              (){ return new Glyph('oxy-icon',0xE007); }
	public static function icoComment            (){ return new Glyph('oxy-icon',0xE008); }
	public static function icoKey                (){ return new Glyph('oxy-icon',0xE009); }
	public static function icoFavorite           (){ return new Glyph('oxy-icon',0xE00A); }
	public static function icoTime               (){ return new Glyph('oxy-icon',0xE00C); }
	public static function icoDate               (){ return new Glyph('oxy-icon',0xE00D); }
	public static function icoEmpty              (){ return new Glyph('oxy-icon',0xE00E); }
	public static function icoAll                (){ return new Glyph('oxy-icon',0xE00F); }
	public static function icoAsterisk           (){ return new Glyph('oxy-icon',0xE010); }
	public static function icoNew                (){ return new Glyph('oxy-icon',0xE011); }
	public static function icoForbidden          (){ return new Glyph('oxy-icon',0xE012); }

	// 100 - Messages
	public static function icoInfo               (){ return new Glyph('oxy-icon',0xE100); }
	public static function icoSuccess            (){ return new Glyph('oxy-icon',0xE101); }
	public static function icoWarning            (){ return new Glyph('oxy-icon',0xE102); }
	public static function icoQuestion           (){ return new Glyph('oxy-icon',0xE103); }
	public static function icoSecurity           (){ return new Glyph('oxy-icon',0xE104); }
	public static function icoError              (){ return new Glyph('oxy-icon',0xE105); }
	public static function icoBug                (){ return new Glyph('oxy-icon',0xE106); }

	// 200 - Basic Actions
	public static function icoView               (){ return new Glyph('oxy-icon',0xE200); }
	public static function icoModify             (){ return new Glyph('oxy-icon',0xE201); }
	public static function icoRename             (){ return new Glyph('oxy-icon',0xE202); }
	public static function icoRefresh            (){ return new Glyph('oxy-icon',0xE203); }
	public static function icoUndo               (){ return new Glyph('oxy-icon',0xE204); }
	public static function icoRedo               (){ return new Glyph('oxy-icon',0xE205); }
	public static function icoLogin              (){ return new Glyph('oxy-icon',0xE206); }
	public static function icoLogoff             (){ return new Glyph('oxy-icon',0xE207); }
	public static function icoSelect             (){ return new Glyph('oxy-icon',0xE208); }
	public static function icoFavoritize         (){ return new Glyph('oxy-icon',0xE00A); }
	public static function icoUnfavoritize       (){ return new Glyph('oxy-icon',0xE00B); }

	// 500/600 - Circle/Simple Actions
	public static function icoBrowse             (){ return new Glyph('oxy-icon',0xE500); }
	public static function icoList               (){ return new Glyph('oxy-icon',0xE600); }
	public static function icoAdd                (){ return new Glyph('oxy-icon',0xE501); }
	public static function icoCreate             (){ return new Glyph('oxy-icon',0xE501); }
	public static function icoPlus               (){ return new Glyph('oxy-icon',0xE601); }
	public static function icoRemove             (){ return new Glyph('oxy-icon',0xE502); }
	public static function icoMinus              (){ return new Glyph('oxy-icon',0xE602); }
	public static function icoCancel             (){ return new Glyph('oxy-icon',0xE503); }
	public static function icoDelete             (){ return new Glyph('oxy-icon',0xE503); }
	public static function icoX                  (){ return new Glyph('oxy-icon',0xE603); }
	public static function icoNo                 (){ return new Glyph('oxy-icon',0xE603); }
	public static function icoAccept             (){ return new Glyph('oxy-icon',0xE504); }
	public static function icoOK                 (){ return new Glyph('oxy-icon',0xE504); }
	public static function icoTick               (){ return new Glyph('oxy-icon',0xE604); }
	public static function icoYes                (){ return new Glyph('oxy-icon',0xE604); }
	public static function icoHelp               (){ return new Glyph('oxy-icon',0xE505); }
	public static function icoQuestionMark       (){ return new Glyph('oxy-icon',0xE605); }
	public static function icoSearch             (){ return new Glyph('oxy-icon',0xE506); }
	public static function icoSearchGlass        (){ return new Glyph('oxy-icon',0xE606); }
	public static function icoGoToParent         (){ return new Glyph('oxy-icon',0xE507); }
	public static function icoParent             (){ return new Glyph('oxy-icon',0xE607); }
	public static function icoMoveUp             (){ return new Glyph('oxy-icon',0xE508); }
	public static function icoUpload             (){ return new Glyph('oxy-icon',0xE508); }
	public static function icoUp                 (){ return new Glyph('oxy-icon',0xE608); }
	public static function icoMoveDown           (){ return new Glyph('oxy-icon',0xE509); }
	public static function icoDownload           (){ return new Glyph('oxy-icon',0xE509); }
	public static function icoDown               (){ return new Glyph('oxy-icon',0xE609); }
	public static function icoMoveLeft           (){ return new Glyph('oxy-icon',0xE50A); }
	public static function icoBack               (){ return new Glyph('oxy-icon',0xE50A); }
	public static function icoLeft               (){ return new Glyph('oxy-icon',0xE60A); }
	public static function icoMove               (){ return new Glyph('oxy-icon',0xE50B); }
	public static function icoMoveRight          (){ return new Glyph('oxy-icon',0xE50B); }
	public static function icoForward            (){ return new Glyph('oxy-icon',0xE50B); }
	public static function icoRight              (){ return new Glyph('oxy-icon',0xE60B); }
	public static function icoDuplicate          (){ return new Glyph('oxy-icon',0xE50C); }
	public static function icoDouble             (){ return new Glyph('oxy-icon',0xE60C); }
	public static function icoLock               (){ return new Glyph('oxy-icon',0xE50D); }
	public static function icoLocked             (){ return new Glyph('oxy-icon',0xE60D); }
	public static function icoFree               (){ return new Glyph('oxy-icon',0xE50E); }
	public static function icoUnlock             (){ return new Glyph('oxy-icon',0xE50E); }
	public static function icoUnlocked           (){ return new Glyph('oxy-icon',0xE60E); }
	public static function icoAction             (){ return new Glyph('oxy-icon',0xE50F); }
	public static function icoApply              (){ return new Glyph('oxy-icon',0xE50F); }
	public static function icoBatch              (){ return new Glyph('oxy-icon',0xE50F); }
	public static function icoThunder            (){ return new Glyph('oxy-icon',0xE60F); }

	// 900 - Interface
	public static function icoContextMenuAnchor  (){ return new Glyph('oxy-icon',0xE900); }
	public static function icoMore               (){ return new Glyph('oxy-icon',0xE902); }
	public static function icoClear              (){ return new Glyph('oxy-icon',0xE901); }
	public static function icoDropArea           (){ return new Glyph('oxy-icon',0xE903); }
	public static function icoMenuUp             (){ return new Glyph('oxy-icon',0xE904); }
	public static function icoMenuDown           (){ return new Glyph('oxy-icon',0xE905); }
	public static function icoMenuLeft           (){ return new Glyph('oxy-icon',0xE906); }
	public static function icoMenuRight          (){ return new Glyph('oxy-icon',0xE907); }
	public static function icoOrderAsc           (){ return new Glyph('oxy-icon',0xE908); }
	public static function icoOrderDesc          (){ return new Glyph('oxy-icon',0xE909); }
	public static function icoBoxUnchecked       (){ return new Glyph('oxy-icon',0xE9A0); }
	public static function icoBoxChecked         (){ return new Glyph('oxy-icon',0xE9A1); }
	public static function icoBoxDirty           (){ return new Glyph('oxy-icon',0xE9A3); }
	public static function icoTreePlus           (){ return new Glyph('oxy-icon',0xE9A2); }
	public static function icoTreeMinus          (){ return new Glyph('oxy-icon',0xE9A3); }
	public static function icoTreeDot            (){ return new Glyph('oxy-icon',0xE9A4); }
	public static function icoBoxUncheckedLocked (){ return new Glyph('oxy-icon',0xE9B0); }
	public static function icoBoxCheckedLocked   (){ return new Glyph('oxy-icon',0xE9B1); }
	public static function icoBoxDirtyLocked     (){ return new Glyph('oxy-icon',0xE9B3); }
	public static function icoTreePlusLocked     (){ return new Glyph('oxy-icon',0xE9B2); }
	public static function icoTreeMinusLocked    (){ return new Glyph('oxy-icon',0xE9B3); }
	public static function icoTreeDotLocked      (){ return new Glyph('oxy-icon',0xE9B4); }




	//
	//
	// Formating
	//
	//
	public static function FormatDate( XDateTime $date = null ){ return Language::FormatDate( $date  );	}
	public static function FormatDateTime( XDateTime $date = null){ return Language::FormatDateTime( $date ); }
	public static function FormatTime( XDateTime $time = null ){		return Language::FormatDateTime( $time );	}
	public static function FormatDateTime24( XDateTime $date = null ){ if ($date!==null&&$date->Format('His')=='000000') return static::FormatDate( $date->AddDays(-1) ).' 24:00:00'; else return static::FormatDateTime( $date ); }
	public static function FormatDateSpanSince( XDateTime $date = null ){		return Language::FormatDateSpanSince( $date );	}
	public static function FormatTimeSpan( XTimeSpan $timespan = null ){		return Language::FormatTimeSpan( $timespan );	}
	public static function FormatTimeSpanSince( XDateTime $date = null ){		return Language::FormatTimeSpanSince( $date );	}
	public static function FormatDaysSince( XDateTime $date = null ){		return Language::FormatDaysSince( $date );	}
	public static function FormatDateTimeRelatively( XDateTime $date = null ){		return Language::FormatDateTimeRelatively( $date );	}
	public static function FormatBytes( $bytes ) {		return Language::FormatBytes($bytes);	}


	public static function AbbrSeconds( XTimeSpan $timespan = null , $number_of_decimals = -1 ){ return $timespan===null ? null : '<span style="display:none;">'.sprintf('%020d',$timespan->GetTotalMilliSeconds()).'"</span><abbr title="'. new Html(Language::FormatTimeSpan($timespan)).'">'.new Html( Language::FormatNumber($timespan->GetTotalMilliSeconds()/1000,$number_of_decimals).'"').'</abbr>'; }
	public static function AbbrDateTime( XDateTime $date_time = null , $default_value = ''){ return $date_time===null ? $default_value : '<abbr s="'.$date_time->Format('YmdHis').'" title="'. new Html(Lemma::Pick('xAgo')->Sprintf(static::FormatTimeSpanSince($date_time))).new XmlAttr("\n".Oxygen::GetClientTimeZone()).'">'.new Html(static::FormatDateTime($date_time)).'</abbr>'; }
	public static function AbbrDateTime24( XDateTime $date_time = null , $default_value = ''){ return $date_time===null ? $default_value : '<abbr s="'.$date_time->Format('YmdHis').'" title="'. new Html(Lemma::Pick('xAgo')->Sprintf(static::FormatTimeSpanSince($date_time))).new XmlAttr("\n".Oxygen::GetClientTimeZone()).'">'.new Html(static::FormatDateTime24($date_time)).'</abbr>';	}
	public static function AbbrDaysSince( XDateTime $date_time = null , $default_value = '' ){ if ($date_time===null) return $default_value; /** @var $diff XTimeSpan */ return '<span style="display:none;">'.sprintf('%020d',XDateTime::Now()->Diff( $date_time )->GetTotalMilliSeconds()).'</span><abbr title="'. new Html(static::FormatDateTime($date_time).' - '.Lemma::Pick('xAgo')->Sprintf(static::FormatTimeSpanSince($date_time))).'">'.static::FormatDaysSince($date_time).'</abbr>'; }
	public static function AbbrDate( XDateTime $date_time = null ){ return $date_time===null ? null : '<abbr s="'.$date_time->Format('YmdHis').'" title="'.new Html($date_time instanceof XDate ? static::FormatDate($date_time) . "\n" . Lemma::Pick('xAgo')->Sprintf( static::FormatDaysSince($date_time) ) : static::FormatDateTime($date_time) . "\n" . Lemma::Pick('xAgo')->Sprintf( static::FormatTimeSpanSince($date_time) .new XmlAttr("\n".Oxygen::GetClientTimeZone()) )).'">'.new Html(static::FormatDate($date_time)).'</abbr>'; }
	public static function AbbrByteRate( $byterate ){ return '<span style="display:none;">'.sprintf('%030d',$byterate).'</span><abbr title="'. new Html(Language::FormatNumber($byterate).' '.Lemma::Pick('unit:byte').'/'.Lemma::Pick('unit:sec')).'" class="nowrap">'.Language::FormatBytes($byterate).'/'.Lemma::Pick('unit:sec').'</abbr>'; }
	public static function AbbrByte( $bytes ){ return '<span style="display:none;">'.sprintf('%030d',$bytes).'</span><abbr title="'. new Html(Language::FormatNumber($bytes).' '.Lemma::Pick('unit:byte')).'" class="nowrap">'.Language::FormatBytes($bytes).'</abbr>'; }



	//
	//
	// Interface
	//
	//
	/** @return LoginControl */
	public static function GetLoginControl(){ return new LoginControl(); }


}
