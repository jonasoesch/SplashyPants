<?php
require_once(SPLASHY_DIR.'/lib/Smarty/Smarty.class.php');

/**
* The Template class is setting up the environment for the Smarty templates
* and providing static helper methods
*/
class Template {

  // The smarty instance
	private static $smarty;
	
	
	/**
	* Setting up smarty, loading smarty-pugins and assigning $baseURL and $tedx to the templates
	* $baseURL is the root application URL coming from the 'tedx-config.php' file. 
	* It can be used to construct links in a template
	* $tedx is the $tedx_manager object also coming from the 'tedx-config.php' file
	*/
	
	private static function setup() {
		global $tedx_manager;
		
		$smarty = new Smarty();
		$smarty->setTemplateDir('templates');
		$smarty->setCompileDir('templates/templates_c');
		$smarty->setCacheDir('templates/cache');
		$smarty->setConfigDir('templates/configs');

    // Smarty plugin to display a flash message
		function pop_flash_message($params, $template) {
		    $msg = "";
		    if (isset($_SESSION['flash'])) {
		        $msg = $_SESSION['flash'];
		        $_SESSION['flash'] = "";
		    }
		    return $msg;
		}
		$smarty->registerPlugin("function", "pop_flash_message", "pop_flash_message");

			
		// ---------- Global Assigns ---------- //
		$smarty->assign('baseURL', 'http://'.$_SERVER['HTTP_HOST'].SPLASHY_URL);
		$smarty->assign('tedx', $tedx_manager);
		
	
		self::$smarty = $smarty;
	}

  /*
  * Renders a template and passes it a list of variables
  * @param: 
  * $tempplate: A string with the name of the template to display
  * $args: A named array. 
  * The values will be assigned to a variable with the keys name in the template;
  */
	public static function render($template, $args=array()) {
		self::setup();
		self::assignArgs($args);
		self::$smarty->display($template);
	}
	
	/*
	* Redirects to a given URL
	* @param:
	* $url: The URL to redirect to as a string
	*/
	public static function redirect($url) {
		header("Location: ".self::getBaseURL().$url); /* Redirect browser */
		exit();

    // Some possibilities to pass variables -> use  $_SESSION['param'];
    // {$smarty.session.param}
	}
	
	// Assigns all the entries passed to smarty
	private static function assignArgs($args) {
		foreach($args as $key=>$value) {
			self::$smarty->assign($key, $value);
		}
	}
	
	/*
	* Return the URL of the application
	*/
	public static function getBaseURL() {
		return 'http://'.$_SERVER['HTTP_HOST'].SPLASHY_URL.'/';
	}
	
	/*
	* Will display a message in the next completely rendered template.
	* sets the message in the session as 'flash'
	* as soon as a template is rendered the smarty plugin 'pop_flash_message' 
	* removes the message from the session.
	* @param
	* $message: The message to display as a string
	*/
	public static function flash($message) {
		$_SESSION['flash'] = $message;
	}
	
	/*
	* Does a nicely formated var_dump of the argument passed
	* @param
	* $var: anything
	*/
	public static function debug($var) {
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
		die();
	}
}

?>
