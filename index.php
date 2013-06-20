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
require_once(SPLASHY_DIR.'/controllers/AboutView.php');
require_once(SPLASHY_DIR.'/controllers/PartnersView.php');
require_once(SPLASHY_DIR.'/controllers/VideoView.php');
require_once(SPLASHY_DIR.'/controllers/TeamView.php');
require_once(SPLASHY_DIR.'/controllers/ContactView.php');

$r = new Router();


/* ---------- Routes ---------- */

$r->get("",	"HomeView::index");

$r->get("login",	
        "HomeView::login");
				
$r->post("login",	
        "HomeView::loginDo");

$r->get("logout",
        "HomeView::logout");

$r->get("persons/:id",
				"HomeView::showPerson");
				
$r->get("event/:id",
				"EventView::show");

$r->get("about",
        "AboutView::tedxLausanne");


$r->get("partners",
        "PartnersView::partners");

$r->get("video",
        "VideoView::video");

$r->get("team",
        "TeamView::team");

$r->get("contact",
        "ContactView::contact");


$r->run();

?>
