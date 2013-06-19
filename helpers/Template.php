<?php

require(SPLASHY_DIR.'/lib/Smarty/Smarty.class.php');

class Template {

	private static $smarty;
	
	
	private static function setup() {
		$smarty = new Smarty();
		$smarty->setTemplateDir('templates');
		$smarty->setCompileDir('templates/templates_c');
		$smarty->setCacheDir('templates/cache');
		$smarty->setConfigDir('templates/configs');
		
		// ---------- Global Assigns ----------
		$smarty->assign('baseURL', 'http://'.$_SERVER['HTTP_HOST'].'/tedxEventManager/SplashyPants');
		$smarty->assign('debug', 'Nothing to debug');
		
		self::$smarty = $smarty;
	}


	public static function render($template, $args=array()) {
		self::setup();
		self::assignArgs($args);
		self::$smarty->display($template);
	}
	
	private static function assignArgs($args) {
		foreach($args as $key=>$value) {
			self::$smarty->assign($key, $value);
		}
	}
}




?>
