<?php

require(SPLASHY_DIR.'/lib/Smarty/Smarty.class.php');

class Template {

	private static $smarty;
	
	
	public static function setup() {
		$smarty = new Smarty();
		$smarty->setTemplateDir('templates');
		$smarty->setCompileDir('templates/templates_c');
		$smarty->setCacheDir('templates/cache');
		$smarty->setConfigDir('templates/configs');
		$smarty->assign('baseURL', 'http://localhost:8888/tedxEventManager/SplashyPants');
		$smarty->assign('debug', 'Nothing to debug');
		
		self::$smarty = $smarty;
	}


	public static function render($template) {
		self::setup();
		self::$smarty->display($template);
	}
}



?>
