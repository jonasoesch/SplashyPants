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

$r = new Router();


/* ---------- Routes ---------- */

$r->map("",	"HomeView::index");

$r->map("login",	
        "HomeView::login");
				
$r->map("login/do",	
        "HomeView::loginDo");

$r->map("logout",
        "HomeView::logout");

$r->map("persons/:id",
				"HomeView::showPerson");
				
$r->map("event/:id",
				"EventView::show");

$r->map("about",
        "AboutView::tedxLausanne");


$r->map("partners",
        "PartnersView::partners");

$r->map("video",
        "VideoView::video");

$r->map("team",
        "TeamView::team");



$r->run();

?>
