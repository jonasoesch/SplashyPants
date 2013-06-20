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
			//faire test
			
			$aLocation = $messageGetLocation->getContent();
			
			$messageGetSlotsFromEvent = $tedx_manager->getSlotsFromEvent($anEvent);
			//faire test
			
			$someSlot = $messageGetSlotsFromEvent->getContent();
			
						
			
			$slotsWithSpeakers = array();
			
			$i=0;
			
			foreach($someSlot as $aSlot){
				$slotsWithSpeakers[$i]['slotData']=$aSlot;
				$messageGetPlacesBySlot = $tedx_manager->getPlacesBySlot($aSlot);
				if ($messageGetPlacesBySlot->getStatus()){
					$places = $messageGetPlacesBySlot->getContent();
					
									
						foreach($places as $place){
				
							$messageGetSpeakerByPlace = $tedx_manager->getSpeakerByPlace($place);
							//faire if
							$speaker = $messageGetSpeakerByPlace->getContent();
							
							$slotsWithSpeakers[$i][$place->getNo()]=$speaker;
					
					
						}// foreach
				
				}//if status	
				
			
				$i++;
			}// foreach
			echo "<pre>";
			var_dump($slotsWithSpeakers);
			echo"</pre>";
		}//if
		
		else{}
		
		
		Template::render('event.tpl', array(
			'event' => $anEvent,
			'location' => $aLocation,
			'slots' => $someSlot,
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
