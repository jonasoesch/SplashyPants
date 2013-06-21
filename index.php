<?php

// ---------- Setup ----------
ob_start(); // No headers get sent before everything is rendered
require_once('../tedx-config.php');


// ---------- Errors ----------------
error_reporting(E_ALL);
ini_set('display_errors', 'On');


require_once(SPLASHY_DIR.'/lib/router.php');
require_once(SPLASHY_DIR.'/controllers/HomeView.php');
require_once(SPLASHY_DIR.'/controllers/EventView.php');
require_once(SPLASHY_DIR.'/controllers/PersonView.php');
require_once(SPLASHY_DIR.'/controllers/VideoView.php');
require_once(SPLASHY_DIR.'/controllers/TeamView.php');

$r = new Router();


/* ######### Routes #################### */


/* ---------- Home and Static ---------- */
$r->get("",	"HomeView::index");


$r->get("contact",
        "HomeView::contact");
        

$r->get("partners",
        "HomeView::partners");
        
        
$r->get("about",
        "HomeView::tedxLausanne");
        
   
/* ---------- Login ---------- */     
        
$r->get("login",	
        "HomeView::login");
				
$r->post("login",	
        "HomeView::loginDo");

$r->get("logout",
        "HomeView::logout");
        

/* ---------- Events ---------- */
        
$r->get("event/:id",
				"EventView::show");


/* ---------- Videos ---------- */
$r->get("video",
        "VideoView::video");


/* ---------- Person ---------- */

$r->get("team","TeamView::team");


$r->get("persons",
        "PersonView::showAll");

$r->get("register",
        "PersonView::register");
        
$r->post("register",
        "PersonView::registerSubmit");

$r->get("person/:id",
        "PersonView::show");




/* ---------- Admin ---------- */
$r->get("events",
				"EventView::listEvents");

$r->run();

?>
