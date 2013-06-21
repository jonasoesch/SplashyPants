<?php

require_once(SPLASHY_DIR.'/lib/Smarty/Smarty.class.php');

class Template {

	private static $smarty;
	
	
	private static function setup() {
		global $tedx_manager;
		
		$smarty = new Smarty();
		$smarty->setTemplateDir('templates');
		$smarty->setCompileDir('templates/templates_c');
		$smarty->setCacheDir('templates/cache');
		$smarty->setConfigDir('templates/configs');

		function pop_flash_message($params, $template) {
		    $msg = "";
		    if (isset($_SESSION['flash'])) {
		        $msg = $_SESSION['flash'];
		        $_SESSION['flash'] = "";
		    }
		    return $msg;
		}
		$smarty->registerPlugin("function", "pop_flash_message", "pop_flash_message");

			
		// ---------- Global Assigns ----------
		$smarty->assign('baseURL', 'http://'.$_SERVER['HTTP_HOST'].'/tedxEventManager/SplashyPants');
		$smarty->assign('tedx', $tedx_manager);
		
	
		self::$smarty = $smarty;
	}

	public static function render($template, $args=array()) {
		self::setup();
		self::assignArgs($args);
		self::$smarty->display($template);
	}
	
	
	public static function redirect($url) {
		header("Location: ".self::getBaseURL().$url); /* Redirect browser */
		exit();

    // Some possibilities to pass variables -> use  $_SESSION['param'];
    // {$smarty.session.param}
	}
	
	private static function assignArgs($args) {
		foreach($args as $key=>$value) {
			self::$smarty->assign($key, $value);
		}
	}
	
	public static function getBaseURL() {
		return 'http://'.$_SERVER['HTTP_HOST'].'/tedxEventManager/SplashyPants/';
	}
	
	public static function flash($message) {
		$_SESSION['flash'] = $message;
	}
	
	public static function debug($var) {
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
		die();
	}
}

?>
