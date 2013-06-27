<?php

/**
* This is the main entry point of the application.
* 
* The router object is responsible for interpreting URL-Patterns
* and compare them to the URL requested from the server.
* 
* For this it offers the three methods 'get', 'post' and 'map'
* get and post respond when the URL is requested with the respective HTTP method
* map is HTTP method agnostic
* 
* When requested URL matches the pattern, the router object will
* call a method.
* 
* Which method is being called is determined by the second argument of get/post/map
* it is passed as a string with the follwing format "Class#method"
* The router will then create an object of the given class and call the method on it.
*
* The URL-Pattern can be defined as having variable parts like so ':variableName'.
* Each variable part has a name and is passed as a variable to the method.
*
**/

// ---------- Setup ----------
ob_start(); // No headers get sent before everything is rendered
require_once('../tedx-config.php');


// ---------- Errors for Developemnt ----------------
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
$r->get("index.php", "HomeView::index"); // just because we're used to it.



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
				
$r->post("event/:id/submitModifiedEvent",
				"EventView::submitModifiedEvent");				
				
$r->get("event/:id/editSlot/:idSlot",
				"EventView::editSlot");				
				
$r->post("event/:id/slot/:idSlot/submitModifiedSlot",
				"EventView::submitModifiedSlot");
				
$r->post("event/:id/editSlot/:idSlot",
				"EventView::sumbitSlot");
				
$r->get("event/:id/addSlot",
				"EventView::addSlot");
				
$r->post("event/:id/submitAddSlot",
				"EventView::submitAddSlot");

$r->get("event/:id/Slot/:idSlot/Speaker/:idSpeaker",
				"EventView::editSpeaker");
				
$r->post("event/:id/Slot/:idSlot/Speaker/:idSpeaker",
				"EventView::editSpeaker");
				
$r->get("event/:id/Slot/:idSlot/addSpeaker",
				"EventView::addSpeaker");
				
$r->post("event/:id/Slot/:idSlot/addSpeaker",
				"EventView::submitAddSpeaker");				
							
				
$r->get("event/:id/modify",
				"EventView::modify");
				
$r->post("modifyEvent/:id",
				"EventView::submitModifyEvent");


/* ---------- Videos ---------- */
$r->get("video",
        "VideoView::video");

$r->get("videoDescription/event/:eventId/speaker/:speakerId",
        "VideoView::videoDescription");


/* ---------- Visitor ------------- */
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

/* ---------- Speaker --------------- */

$r->get("register/speaker",
        "PersonView::registerSpeaker");

$r->post("register/speaker",
        "PersonView::registerSpeakerSubmit");

/* ---------- Organizer --------------- */
$r->get("register/organizer",
        "PersonView::registerOrganizer");

$r->post("register/organizer",
        "PersonView::registerOrganizerSubmit");
        


/* ---------- Person ---------- */

$r->get("team","TeamView::team");


$r->get("persons",
        "PersonView::showAll");
        
$r->get("person/:id",
        "PersonView::show");
              
         
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

/* ---------- Finally, call the method if there was a match ---------- */

$r->run();

?>
