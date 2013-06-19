<?php

// ---------- Setup ----------
ob_start(); // No headers get sent before everything is rendered
require_once('../tedx-config.php');


// ---------- Errors ----------------
error_reporting(E_ALL);
ini_set('display_errors', 'On');


require_once(SPLASHY_DIR.'/lib/router.php');
require_once(SPLASHY_DIR.'/controllers/Home.php');
require_once(SPLASHY_DIR.'/controllers/Event.php');
require_once(SPLASHY_DIR.'/controllers/About.php');


$r = new Router();


/* ---------- Routes ---------- */

$r->map("",	"Home::index");

$r->map("login",	
        "Home::login");
				
$r->map("login/do",	
        "Home::loginDo");

$r->map("logout",
        "Home::logout");

$r->map("persons/:id",
				"Home::showPerson");
				
$r->map("event/:id",
				"Event::show");

$r->map("about",
        "About::ted");




$r->run();

?>
