<?php

require_once SPLASHY_DIR."/helpers/ViewController.php";
require_once SPLASHY_DIR."/helpers/Template.php";

class EventView extends ViewController {
  
  
  // ""
  public function index() {
   	Template::render('home.tpl');
  }
  
  // "login"
  public function login() {
  	Template::render('login.tpl');
  }
  
  // "login/do"
  public function loginDo() {
  	Template::render('home.tpl');
  }

	public function show($id) {
		global $tedx_manager;
		
		$messageGetEvent = $tedx_manager->getEvent($id);
		if( $messageGetEvent->getStatus()){
							
			$anEvent = $messageGetEvent->getContent($id);
			$locationName = $anEvent->getLocationName();
			$messageGetLocation = $tedx_manager->getLocation($locationName);
			$aLocation = $messageGetLocation->getContent();
			
			$messageGetSlotsFromEvent = $tedx_manager->getSlotsFromEvent($anEvent);
			
		}
		
		else{}
		
		
		Template::render('event.tpl', array(
			'event' => $anEvent,
			'location' => $aLocation,
			'code' => '1077',
			'city' => 'Servion',
			'country' => 'Suisse'
		));
	}
	

  public function event() {
  	Template::render('event.tpl');
  }
  
  
  public function listEvents() {
  	global $tedx_manager;
  	
  	$events = $tedx_manager->getEvents()->getContent();
  	Template::render('events.tpl', array(
  		'events' => $events
  	));
  }
}

?>
