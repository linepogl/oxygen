<?php
class oxy extends ResourceManager {
	//
	// 000 - Basic
	//
	public static function GlyphSpacer            (){ return new Glyph('oxy-icon',0xE000); }
	public static function GlyphBlock             (){ return new Glyph('oxy-icon',0xE001); }
	public static function GlyphItem              (){ return new Glyph('oxy-icon',0xE001); }
	public static function GlyphItems             (){ return new Glyph('oxy-icon',0xE002); }
	public static function GlyphUser              (){ return new Glyph('oxy-icon',0xE003); }
	public static function GlyphUsers             (){ return new Glyph('oxy-icon',0xE004); }
	public static function GlyphSettings          (){ return new Glyph('oxy-icon',0xE005); }
	public static function GlyphEmail             (){ return new Glyph('oxy-icon',0xE006); }
	public static function GlyphPrint             (){ return new Glyph('oxy-icon',0xE007); }
	public static function GlyphComment           (){ return new Glyph('oxy-icon',0xE008); }
	public static function GlyphKey               (){ return new Glyph('oxy-icon',0xE009); }
	public static function GlyphHeart             (){ return new Glyph('oxy-icon',0xE00A); }
	public static function GlyphBrokenHeart       (){ return new Glyph('oxy-icon',0xE00B); }

	//
	// 100 - Messages
	//
	public static function GlyphInfo              (){ return new Glyph('oxy-icon',0xE101); }
	public static function GlyphSuccess           (){ return new Glyph('oxy-icon',0xE102); }
	public static function GlyphQuestion          (){ return new Glyph('oxy-icon',0xE103); }
	public static function GlyphWarning           (){ return new Glyph('oxy-icon',0xE104); }
	public static function GlyphError             (){ return new Glyph('oxy-icon',0xE105); }
	public static function GlyphBug               (){ return new Glyph('oxy-icon',0xE106); }

	//
	// 200 - Basic Actions
	//
	public static function GlyphView              (){ return new Glyph('oxy-icon',0xE200); }
	public static function GlyphModify            (){ return new Glyph('oxy-icon',0xE201); }
	public static function GlyphRename            (){ return new Glyph('oxy-icon',0xE202); }
	public static function GlyphRefresh           (){ return new Glyph('oxy-icon',0xE203); }
	public static function GlyphUndo              (){ return new Glyph('oxy-icon',0xE204); }
	public static function GlyphRedo              (){ return new Glyph('oxy-icon',0xE205); }
	public static function GlyphLogin             (){ return new Glyph('oxy-icon',0xE206); }
	public static function GlyphLogoff            (){ return new Glyph('oxy-icon',0xE207); }


	//
	// 500/600 - Circle/Simple Actions
	//
	public static function GlyphBrowse            (){ return new Glyph('oxy-icon',0xE500); }
	public static function GlyphList              (){ return new Glyph('oxy-icon',0xE600); }
	public static function GlyphAdd               (){ return new Glyph('oxy-icon',0xE501); }
	public static function GlyphCreate            (){ return new Glyph('oxy-icon',0xE501); }
	public static function GlyphPlus              (){ return new Glyph('oxy-icon',0xE601); }
	public static function GlyphRemove            (){ return new Glyph('oxy-icon',0xE502); }
	public static function GlyphMinus             (){ return new Glyph('oxy-icon',0xE602); }
	public static function GlyphCancel            (){ return new Glyph('oxy-icon',0xE503); }
	public static function GlyphDelete            (){ return new Glyph('oxy-icon',0xE503); }
	public static function GlyphX                 (){ return new Glyph('oxy-icon',0xE603); }
	public static function GlyphNo                (){ return new Glyph('oxy-icon',0xE603); }
	public static function GlyphAccept            (){ return new Glyph('oxy-icon',0xE504); }
	public static function GlyphOK                (){ return new Glyph('oxy-icon',0xE504); }
	public static function GlyphTick              (){ return new Glyph('oxy-icon',0xE604); }
	public static function GlyphYes               (){ return new Glyph('oxy-icon',0xE604); }
	public static function GlyphHelp              (){ return new Glyph('oxy-icon',0xE505); }
	public static function GlyphQuestionMark      (){ return new Glyph('oxy-icon',0xE605); }
	public static function GlyphSearch            (){ return new Glyph('oxy-icon',0xE506); }
	public static function GlyphSearchGlass       (){ return new Glyph('oxy-icon',0xE606); }
	public static function GlyphGoToParent        (){ return new Glyph('oxy-icon',0xE507); }
	public static function GlyphParent            (){ return new Glyph('oxy-icon',0xE607); }
	public static function GlyphMoveUp            (){ return new Glyph('oxy-icon',0xE508); }
	public static function GlyphUpload            (){ return new Glyph('oxy-icon',0xE508); }
	public static function GlyphUp                (){ return new Glyph('oxy-icon',0xE608); }
	public static function GlyphMoveDown          (){ return new Glyph('oxy-icon',0xE509); }
	public static function GlyphDownload          (){ return new Glyph('oxy-icon',0xE509); }
	public static function GlyphDown              (){ return new Glyph('oxy-icon',0xE609); }
	public static function GlyphMoveLeft          (){ return new Glyph('oxy-icon',0xE50A); }
	public static function GlyphBack              (){ return new Glyph('oxy-icon',0xE50A); }
	public static function GlyphLeft              (){ return new Glyph('oxy-icon',0xE60A); }
	public static function GlyphMove              (){ return new Glyph('oxy-icon',0xE50B); }
	public static function GlyphMoveRight         (){ return new Glyph('oxy-icon',0xE50B); }
	public static function GlyphForward           (){ return new Glyph('oxy-icon',0xE50B); }
	public static function GlyphRight             (){ return new Glyph('oxy-icon',0xE60B); }
	public static function GlyphDuplicate         (){ return new Glyph('oxy-icon',0xE50C); }
	public static function GlyphDouble            (){ return new Glyph('oxy-icon',0xE60C); }
	public static function GlyphLock              (){ return new Glyph('oxy-icon',0xE50D); }
	public static function GlyphLocked            (){ return new Glyph('oxy-icon',0xE60D); }
	public static function GlyphFree              (){ return new Glyph('oxy-icon',0xE50E); }
	public static function GlyphUnlock            (){ return new Glyph('oxy-icon',0xE50E); }
	public static function GlyphUnlocked          (){ return new Glyph('oxy-icon',0xE60E); }
	public static function GlyphAction            (){ return new Glyph('oxy-icon',0xE50F); }
	public static function GlyphApply             (){ return new Glyph('oxy-icon',0xE50F); }
	public static function GlyphBatch             (){ return new Glyph('oxy-icon',0xE50F); }
	public static function GlyphThunder           (){ return new Glyph('oxy-icon',0xE60F); }


	//
	// 900 - Interface
	//
	public static function GlyphContextMenuAnchor (){ return new Glyph('oxy-icon',0xE900); }
	public static function GlyphMore              (){ return new Glyph('oxy-icon',0xE901); }
	public static function GlyphClear             (){ return new Glyph('oxy-icon',0xE902); }
	public static function GlyphDropTarget        (){ return new Glyph('oxy-icon',0xE903); }
	public static function GlyphMenuUp            (){ return new Glyph('oxy-icon',0xE904); }
	public static function GlyphMenuDown          (){ return new Glyph('oxy-icon',0xE905); }
	public static function GlyphMenuLeft          (){ return new Glyph('oxy-icon',0xE906); }
	public static function GlyphMenuRight         (){ return new Glyph('oxy-icon',0xE907); }
	public static function GlyphOrderAsc          (){ return new Glyph('oxy-icon',0xE908); }
	public static function GlyphOrderDesc         (){ return new Glyph('oxy-icon',0xE909); }
	public static function GlyphUnchecked         (){ return new Glyph('oxy-icon',0xE9A0); }
	public static function GlyphChecked           (){ return new Glyph('oxy-icon',0xE9A1); }
	public static function GlyphTreePlus          (){ return new Glyph('oxy-icon',0xE9A2); }
	public static function GlyphTreeMinus         (){ return new Glyph('oxy-icon',0xE9A3); }
}
oxy::__register();





