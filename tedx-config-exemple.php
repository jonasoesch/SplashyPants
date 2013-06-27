<?php
/**
 * tedx-config.php
 * 
 * Author : Quentin Mathey
 * Date : 12.06.2013
 * 
 * Description : Config the app. Provide object $tedx_manager for Interface
 * Modeling.
 * 
 */

/* DATABASE CONFIG */
define('DB_LOCATION'    , 'localhost');
define('DB_NAME'        , 'tedx-dev');
define('DB_USER'        , 'root');
define('DB_PASSWORD'    , 'root');

/* APP CONFIG */
define('APP_DIR', '/Applications/MAMP/htdocs/tedxEventManager'); // Path to the tedxEventManager folder on the server
define('SPLASHY_DIR', APP_DIR.'/SplashyPants'); // Path to the SplasyPants folder on the server
define('SPLASHY_URL', '/tedxEventManager/SplashyPants'); // URL of the SplashyPants application
define('CONFIG_DIR', APP_DIR); // Path to the folder for the configuration files

/* Settings the app  */
require_once(APP_DIR.'/core/controller/Tedx_manager.class.php');
require_once(APP_DIR.'/core/services/Crud.class.php');
// globals vars
$tedx_manager = new Tedx_manager();
$crud = new Crud();

/* SESSION AND COOKIES*/
//session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);
session_start();

?>
