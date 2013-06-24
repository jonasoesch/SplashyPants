<?php

// ---------- Setup ----------
ob_start(); // No headers get sent before everything is rendered
require_once('../tedx-config.php');


// ---------- Errors ----------------
error_reporting(E_ALL);
ini_set('display_errors', 'On');


require_once(SPLASHY_DIR.'/lib/Router.php');
require_once(SPLASHY_DIR.'/controllers/HomeView.php');
require_once(SPLASHY_DIR.'/controllers/EventView.php');
require_once(SPLASHY_DIR.'/controllers/PersonView.php');
require_once(SPLASHY_DIR.'/controllers/VideoView.php');
require_once(SPLASHY_DIR.'/controllers/TeamView.php');

$r = new Router();


/* ######### Routes #################### */


/* ---------- Home and Static ---------- */
$r->get("",	"HomeView::index");

/*
* Pour Mickael :-)
* Exemple pour comment plusiers variables avec une URL
* Va sur http://localhost:8888/tedxEventManager/SplashyPants/hey/22/ho/33
* et regarde la methode 'hey' dans HomeView
*/
$r->get("hey/:event/ho/:contact", "HomeView::hey");

$r->get("contact",
        "HomeView::contact");
        

$r->get("partners",
        "HomeView::partners");
        
        
$r->get("about",
        "HomeView::about");
        
   
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
				
$r->get("addEvent",
				"EventView::add");
				
$r->post("addEvent",
				"EventView::submitEvent");

$r->get("addSlot",
				"EventView::slot");

/* ---------- Videos ---------- */
$r->get("video",
        "VideoView::video");


/* ---------- Person ---------- */

$r->get("team",
        "TeamView::team");


$r->get("persons",
        "PersonView::showAll");
        
$r->get("person/:id",
        "PersonView::show");

// ---------- Visitor
$r->get("register",
        "PersonView::registerVisitor");

$r->post("register",
        "PersonView::registerVisitorSubmit");

// ---------- Speaker
$r->get("register/speaker",
        "PersonView::registerSpeaker");

$r->post("register/speaker",
        "PersonView::registerSpeakerSubmit");

// ---------- Organizer
$r->get("register/organizer",
        "PersonView::registerOrganizer");

$r->get("register/organizer",
        "PersonView::registerOrganizerSubmit");
        


         
         
$r->get("person/:id/edit",
        "PersonView::editProfil");
        
$r->post("person/:id/edit",
        "PersonView::editProfilSubmit");
        
        

$r->get("event/:id/validateParticipant",
        "PersonView::showParticipant");

$r->get("event/:eventId/participant/:participantId/validate",
        "PersonView::validateParticipant");

$r->get("event/:eventId/participant/:participantId/reject",
        "PersonView::rejectParticipant");


/* ---------- Admin ---------- */
$r->get("events",
				"EventView::listEvents");

$r->run();

?>
