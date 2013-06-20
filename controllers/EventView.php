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
				
		$anEvent = $tedx_manager->getEvent($id);
		$locationName=$anEvent->getContent()->getLocationName();
		$aLocation = $tedx_manager->getLocation($locationName);
		$aSlot = $tedx_manager->getSlotsFromEvent($anEvent);		
		
		Template::render('event.tpl', array(
			'event' => $anEvent->getContent(),
			'location' => $aLocation->getContent(),
			'code' => '1077',
			'city' => 'Servion',
			'country' => 'Suisse'
		));
	}
	
	  // "login/do"
  public function event() {
  	Template::render('event.tpl');
  }
}

?>
