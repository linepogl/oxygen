<?php

class Console {

	private static $margin = 20;

	private static function RenderStyle(){
		echo '<style>';
		echo '.console-top a              {background-image:url(oxy/img/console_tab_bg.png);text-shadow:#000000 1px 1px 0;color:#888888;font:10px/10px Trebuchet MS, sans-serif;text-transform:uppercase;text-decoration:none;text-align:center;float:left;width:100px;height:100px;}';
		echo '.console-top a:hover        {background-image:url(oxy/img/console_tab_hover_bg.png);color:#aaaaaa;text-decoration:none;}';
		echo '.console-top a.active       {background-image:url(oxy/img/console_tab_active_bg.png);color:#444444;text-shadow:#759eb0 1px 1px 0;text-decoration:none;}';
		echo '.console-top a.active:hover {background-image:url(oxy/img/console_tab_active_bg.png);color:#444444;text-shadow:#759eb0 1px 1px 0;text-decoration:none;}';
		echo '.console-top a img {margin-top:15px;margin-bottom:10px;text-align:center;}';
		echo '.console-top a .badge { position:relative; top:10px; left:58px; height:10px; width:20px; margin-bottom:-20px; padding:2px; border:2px solid #bbbbbb; border-radius:40px; background:#801a1a; color:#bbbbbb; text-shadow:none;}';
		echo '.console-top a.active .badge { background:#b30000; color:#eeeeee; border:2px solid #eeeeee; }';

		echo 'div.console, div.console td, div.console * { font-size:12px; line-heihgt:14px; font-family:Courier New, Courier, monospace; }';
		echo 'div.console h1 { font:bold 18px/20px Courier New, Courier, monospace; margin:0 0 20px 0;}';
		echo 'div.console a { color:#6666aa; text-decoration:underline; }';
		echo 'div.console a:hover { color:#000000; text-decoration:underline; }';
		echo 'div.console .label { float:left; width:180px; text-align:right; color:#888888; clear:both; padding:3px 6px;  }';
		echo 'div.console .value { float:left; text-align:left; color:#222222; padding:3px 6px; border-left:1px solid #dddddd; white-space:pre; }';

		echo 'table.console td, table.console th { font:11px/12px monospace; padding:2px 24px 2px 4px; border-bottom:1px solid #cccccc; color:#333333; }';
		echo 'table.console th { background:#e4e4e4; }';
		echo 'table.console tr.alt td { background:#eeeeee; }';
		echo 'table.console tr.alt th { background:#dddddd; }';
		echo '</style>';
	}

	private static function BeginHeader($margin=20){
		echo '<div style="position:fixed;z-index:50;top:0;left:0;width:'.(20+$margin).'px;height:'.(20+$margin).'px;background:url(oxy/img/console_1.png) '.($margin-40).'px '.($margin-40).'px no-repeat;"></div>';
		echo '<div style="position:fixed;z-index:50;top:0;right:0;width:'.(20+$margin).'px;height:'.(20+$margin).'px;background:url(oxy/img/console_3.png) 0 '.($margin-40).'px no-repeat;"></div>';
		echo '<div style="position:fixed;z-index:50;top:0;left:'.(20+$margin).'px;right:'.(20+$margin).'px;height:'.(20+$margin).'px;background:url(oxy/img/console_2.png) 0 '.($margin-40).'px repeat-x;"></div>';
		echo '<div style="position:fixed;z-index:50;left:0;top:'.(20+$margin).'px;bottom:'.(20+$margin).'px;width:'.(20+$margin).'px;background:url(oxy/img/console_4.png) '.($margin-40).'px 0 repeat-y;"></div>';
		echo '<div style="position:fixed;z-index:50;right:0;top:'.(20+$margin).'px;bottom:'.(20+$margin).'px;width:'.(20+$margin).'px;background:url(oxy/img/console_6.png) 0 0 repeat-y;"></div>';
		echo '<div style="position:fixed;z-index:50;bottom:0;left:0;width:'.(20+$margin).'px;height:'.(20+$margin).'px;background:url(oxy/img/console_7.png) '.($margin-40).'px 0 no-repeat;"></div>';
		echo '<div style="position:fixed;z-index:50;bottom:0;right:0;width:'.(20+$margin).'px;height:'.(20+$margin).'px;background:url(oxy/img/console_9.png) 0 0 no-repeat;"></div>';
		echo '<div style="position:fixed;z-index:50;bottom:0;left:'.(20+$margin).'px;right:'.(20+$margin).'px;height:'.(20+$margin).'px;background:url(oxy/img/console_8.png) 0 0 repeat-x;"></div>';
		echo '<div class="console-top" style="position:fixed;z-index:50;top:'.$margin.'px;left:'.$margin.'px;right:'.$margin.'px;height:100px;background:url(oxy/img/console_top_bg.png) 0 0 repeat-x;border-top-left-radius:10px;border-top-right-radius:10px;">';
	}

	private static function EndHeader($margin=20){
		echo '</div>';
		echo '<div style="position:fixed;z-index:50;bottom:'.$margin.'px;left:'.$margin.'px;right:'.$margin.'px;height:17px;background:url(oxy/img/console_bottom_bg.png) 0 0 repeat-x;border-bottom-left-radius:10px;border-bottom-right-radius:10px;text-shadow:#000000 1px 1px 0;color:#888888;font:10px/10px Trebuchet MS, sans-serif;text-transform:uppercase;padding-left:12px;padding-top:6px;">Oxygen</div>';
		echo '<div class="console overflow" style="position:fixed;z-index:50;top:'.(100+$margin).'px;left:'.$margin.'px;bottom:'.($margin+23).'px;right:'.$margin.'px;background:#f3f3f3;padding:15px;">';
	}

	public static function BeginModal(){
		self::RenderStyle();
		self::BeginHeader(self::$margin);

		$i = 0;
		/** @var $act ConsoleAction */
		foreach (new ConsoleMenu() as $act){
			$is_active = $act->IsActive();
			echo '<a href="'.new Html($act).'"';
			if ($is_active) echo ' class="active"';
			if ($i == 0) echo ' style="width:99px;background-position:-1px 0;border-top-left-radius:10px;"';
			echo '>';
			$b = $act->GetBadgeText(); if (!empty($b)) echo '<div class="badge">'.$b.'</div>';
			if ($is_active) echo '<img src="'.$act->GetActiveTabIconSrc().'" />'; else echo '<img src="'.$act->GetNormalTabIconSrc().'" />';
			echo '<br/>';
			echo $act->GetTabTitle();
			echo '</a>';
			$i++;
		}
		echo '<div style="float:left;height:100px;background:url(oxy/img/console_tab_hilight.png);">'.new Spacer().'</div>';

		echo '<a href="'.new Html(Oxygen::MakeHref(array('action'=>null))).'" style="float:right;width:99px;border-top-right-radius:10px;">';
		echo '<img src="oxy/img/console_tab_home.png" /><br/>';
		echo 'App Home';
		echo '</a>';
		echo '<a href="oxy/hlp" target="_blank" style="float:right;">';
		echo '<img src="oxy/img/console_tab_docs.png" /><br/>';
		echo 'Docs';
		echo '</a>';
		echo '<a href="'.new Html(new ActionOxygenResetCache()).'" style="float:right;">';
		echo '<img src="oxy/img/console_tab_reset.png" /><br/>';
		echo 'Reset cache';
		echo '</a>';
		echo '<a href="'.new Html(new ActionOxygenReset()).'" style="float:right;">';
		echo '<img src="oxy/img/console_tab_reset.png" /><br/>';
		echo 'Reset all';
		echo '</a>';
		echo '<a href="'.new Html(new ActionOxygenUpgrade()).'" style="float:right;">';
		echo '<img src="oxy/img/console_tab_upgrade.png" /><br/>';
		echo 'Upgrade';
		echo '</a>';
		echo '<div style="float:right;height:100px;background:url(oxy/img/console_tab_shadow.png);">'.new Spacer().'</div>';

		self::EndHeader(self::$margin);
		self::$margin += 10;
	}
	public static function EndModal(){
		echo '</div>';
	}





	public static function RenderInfo( $info ){
		echo '<div class="overflow" style="height:120px;border:1px dotted #888888;background:#eeeeee;margin-bottom:10px;padding:5px;">';
		echo Oxygen::GetInfoAsHtml( $info );
		echo '</div>';
	}
	
	public static function BeginPopup($tab_icon_src,$tab_title,$title){
		$name = 'x'.ID::Random()->AsHex();
		echo '<div id="'.$name.'">';
		self::RenderStyle();
		self::BeginHeader(self::$margin);

		echo '<a href="javascript:"';
		echo ' class="active"';
		echo ' style="width:99px;background-position:-1px 0;border-top-left-radius:10px;"';
		echo '>';
		echo '<img src="'.new Html($tab_icon_src).'" />';
		echo '<br/>';
		echo new Html($tab_title);
		echo '</a>';
		echo '<div style="float:left;height:100px;background:url(oxy/img/console_tab_hilight.png);">'.new Spacer().'</div>';


		$i = 0;
		/** @var $act ConsoleAction */
		foreach (new ConsoleMenu() as $act){
			if ($i++ == 0) continue;
			echo '<a href="'.new Html($act->GetHref(array('oxy_debug'=>null,'oxy_profile'=>null))).'">';
			$b = $act->GetBadgeText(); if (!empty($b)) echo '<div class="badge">'.$b.'</div>';
			echo '<img src="'.$act->GetNormalTabIconSrc().'" />';
			echo '<br/>';
			echo $act->GetTabTitle();
			echo '</a>';
		}


		echo '<div style="float:left;height:100px;background:url(oxy/img/console_tab_hilight.png);">'.new Spacer().'</div>';
		echo '<a href="javascript:(function(){$('.new Js($name).').hide();})();" style="float:right;width:99px;border-top-right-radius:10px;">';
		echo '<img src="oxy/img/console_tab_hide.png" /><br/>';
		echo 'Hide';
		echo '</a>';
		echo '<a href="oxy/hlp" target="_blank" style="float:right;">';
		echo '<img src="oxy/img/console_tab_docs.png" /><br/>';
		echo 'Docs';
		echo '</a>';
		echo '<a href="'.new Html(new ActionOxygenResetCache()).'" style="float:right;">';
		echo '<img src="oxy/img/console_tab_reset.png" /><br/>';
		echo 'Reset cache';
		echo '</a>';
		echo '<a href="'.new Html(new ActionOxygenReset()).'" style="float:right;">';
		echo '<img src="oxy/img/console_tab_reset.png" /><br/>';
		echo 'Reset all';
		echo '</a>';
		echo '<div style="float:right;height:100px;background:url(oxy/img/console_tab_shadow.png);">'.new Spacer().'</div>';

		self::EndHeader(self::$margin);
		echo '<h1>'.$title.'</h1>';
		self::$margin += 10;
	}

	public static function EndPopup(){
		echo '</div>';
		echo '</div>';
	}


}