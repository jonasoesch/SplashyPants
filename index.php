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
$r->get("index.php", "HomeView::index");

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
$r->get("events",
                                "EventView::showEvents");
				
$r->get("addEvent",
				"EventView::add");
				
$r->post("addEvent",
				"EventView::submitEvent");
				
$r->get("event/:id/editSlot/:idSlot",
				"EventView::editSlot");				
				
$r->post("event/:id/editSlot/:idSlot",
				"EventView::editSlot");

$r->get("event/:id/addSlot",
				"EventView::slot");
				
$r->get("event/:id/Slot/:idSlot/Speaker/:idSpeaker",
				"EventView::editSpeaker");
				
				
				
//$r->get("event/:id/addSlot",
			//	"EventView::submitSlots");				
				
$r->get("modifyEvent/:id",
				"EventView::modify");
				
$r->post("modifyEvent/:id",
				"EventView::submitModifyEvent");

/* ---------- Videos ---------- */
$r->get("video",
        "VideoView::video");

$r->get("videoDescription/event/:eventId/speaker/:speakerId",
"VideoView::videoDescription");

/* ---------- Person ---------- */

$r->get("team","TeamView::team");


$r->get("persons",
        "PersonView::showAll");
        
$r->get("person/:id",
        "PersonView::show");

// ---------- Visitor
$r->get("register",
        "PersonView::registerVisitor");

$r->post("register",
        "PersonView::registerVisitorSubmit");

$r->get("event/:eventId/registerToAnEvent",
        "PersonView::registerToAnEvent");

$r->post("event/:eventId/registerToAnEvent",
        "PersonView::registerToAnEventSubmit");

$r->get("person/:id",
        "PersonView::show");

// ---------- Speaker
$r->get("register/speaker",
        "PersonView::registerSpeaker");

$r->post("register/speaker",
        "PersonView::registerSpeakerSubmit");

// ---------- Organizer
$r->get("register/organizer",
        "PersonView::registerOrganizer");

$r->post("register/organizer",
        "PersonView::registerOrganizerSubmit");
        


         
         
$r->get("person/:id/edit",
        "PersonView::editProfil");
        
$r->post("person/:id/edit",
        "PersonView::editProfilSubmit");
        
        

$r->get("event/:id/validateParticipant",
        "PersonView::showParticipant");

$r->get("event/:eventId/participant/:participantId/accept",
        "PersonView::acceptRegistration");

$r->get("event/:eventId/participant/:participantId/reject",
        "PersonView::rejectRegistration");

$r->get("event/:eventId/participant/:participantId/cancel",
        "PersonView::cancelValidationRegistration");


/* ---------- Admin ---------- */

$r->get("admin",	
        "HomeView::admin");

$r->get("locations",
        "EventView::locations");

$r->post("locations",
        "EventView::locationsSubmit");

$r->get("teamRoles",
        "PersonView::teamRoles");

$r->post("teamRoles",
        "PersonView::teamRolesSubmit");

$r->get("allocateTeamRoles",
        "PersonView::allocateTeamRoles");

$r->post("teamRoles",
        "PersonView::allocateTeamRolesSubmit");


$r->run();

?>
