<?php

require_once SPLASHY_DIR."/helpers/ViewController.php";
require_once SPLASHY_DIR."/helpers/Template.php";

class EventView extends ViewController {
  
 
	public function show($id) {
		

		Template::render('event.tpl',
			$this->getEventData($id) 
		);
	}
	
	public function modify($id){
		

		
		$untableau= array_merge($this->getEventData($id), $this->getSpeakerAndLocationData());
		
		Template::render('modifyEvent.tpl',
			$untableau
		);
		
	}
	
	public function add() {
		global $tedx_manager;
		
			$messageGetLocations = $tedx_manager->getLocations();
						
			//message
			if( $messageGetLocations->getStatus()){
				
				$someLocations = $messageGetLocations->getContent();
			}
			
			else{
				
			Template::flash('Could not find locations! ' . $messageGetLocations->getMessage());

			}
			
			$searchArgs = array(
			'personType' => 'speaker');
						// exec the search
			$messageSearchPersons = $tedx_manager->searchPersons($searchArgs);

			// test answer
			if($messageSearchPersons ->getStatus()){
			$someSpeakers = $messageSearchPersons->getContent();
			}
			else{
			echo 'No Speaker matched your crit(erias';
			}
			
			$untableau=array(
			'someLocations' => $someLocations,
			'someSpeakers' => $someSpeakers);
		
		Template::render('addEvent.tpl',$untableau);
	}

	public function submitEvent() {
			global $tedx_manager;
			
			$argsCreateEvent = array(
			'mainTopic'     => $_POST['mainTopic'],
			'startingDate'  => $_POST['event_dob_year']."-".$_POST['event_dob_month']."-".$_POST['event_dob_day'],
		    'endingDate'    => $_POST['event_doe_year']."-".$_POST['event_doe_month']."-".$_POST['event_doe_day'],
		    'startingTime'  => $_POST['event_hob'],
		    'endingTime'    => $_POST['event_hoe'],
		    'description'   => $_POST['description'],
		    'locationName'  => $_POST['locationName2']  // ligne à enlever si pas de Location !
			);
			
			// 1..* arrays pour création des Slots
			// Note: pas de référence à l'Event !(Event.No indéterminé)
			$slot1 = array (
			    'happeningDate' => $_POST['slot_dob_year']."-".$_POST['slot_dob_month']."-".$_POST['slot_dob_day'],
			    'startingTime'  => $_POST['slot_hob'],
			    'endingTime'    => $_POST['slot_hoe'],
			);
			$slot2 = array (
			    'happeningDate' => $_POST['slot_dob_year']."-".$_POST['slot_dob_month']."-".$_POST['slot_dob_day'],
			    'startingTime'  => $_POST['slot_hob'],
			    'endingTime'    => $_POST['slot_hoe'],
			);
			// Un array de Slots
			$argsSlots = array($slot1, $slot2);
			 
			// L'array final pour la fonction addEvent
			$megaArgsAddEvent = array (
			    'event'   => $argsCreateEvent,
			    'slots'   => $argsSlots
			);
			 
			// Création de l'Event !
			$messageAddEvent = $tedx_manager->addEvent($megaArgsAddEvent);
			
			/*echo "<pre>";
			var_dump($messageAddEvent->getContent());
			echo "</pre>";*/
			$idEvents = $messageAddEvent->getContent();
			$idEvent = $idEvents[0]->getNo();
    	
    	//Template::flash($messageAddEvent->getMessage());
    	
    	if($messageAddEvent->getStatus()) {
    		//$idEvent->getNo();
    		Template::redirect("event/$idEvent");
    	} else {
    		//Template::redirect('addEvent');
    	}
    }
    
    	public function submitModifyEvent($id) {
			global $tedx_manager;
			
			$argsCreateEvent = array(
			'mainTopic'     => $_POST['mainTopic'],
			'startingDate'  => $_POST['event_dob_year']."-".$_POST['event_dob_month']."-".$_POST['event_dob_day'],
		    'endingDate'    => $_POST['event_doe_year']."-".$_POST['event_doe_month']."-".$_POST['event_doe_day'],
		    'startingTime'  => $_POST['event_hob'],
		    'endingTime'    => $_POST['event_hoe'],
		    'description'   => $_POST['description'],
		    'locationName'  => $_POST['locationName2']  // ligne à enlever si pas de Location !
			);
			
			// 1..* arrays pour création des Slots
			// Note: pas de référence à l'Event !(Event.No indéterminé)
			$slot1 = array (
			    'happeningDate' => $_POST['slot_dob_year']."-".$_POST['slot_dob_month']."-".$_POST['slot_dob_day'],
			    'startingTime'  => $_POST['slot_hob'],
			    'endingTime'    => $_POST['slot_hoe'],
			);
			$slot2 = array (
			    'happeningDate' => $_POST['slot_dob_year']."-".$_POST['slot_dob_month']."-".$_POST['slot_dob_day'],
			    'startingTime'  => $_POST['slot_hob'],
			    'endingTime'    => $_POST['slot_hoe'],
			);
			// Un array de Slots
			$argsSlots = array($slot1, $slot2);
			 
			// L'array final pour la fonction addEvent
			$megaArgsAddEvent = array (
			    'event'   => $argsCreateEvent,
			    'slots'   => $argsSlots
			);
			 
			// Création de l'Event !
			$messageAddEvent = $tedx_manager->addEvent($megaArgsAddEvent);
			
			/*echo "<pre>";
			var_dump($messageAddEvent->getContent());
			echo "</pre>";*/
			$idEvents = $messageAddEvent->getContent();
			$idEvent = $idEvents[0]->getNo();
    	
    	//Template::flash($messageAddEvent->getMessage());
    	
    	if($messageAddEvent->getStatus()) {
    		//$idEvent->getNo();
    		Template::redirect("event/$idEvent");
    	} else {
    		//Template::redirect('addEvent');
    	}
    }
    
    
    	public function slot() {
		global $tedx_manager;
		
			$messageGetLocations = $tedx_manager->getLocations();
						
			//message
			if( $messageGetLocations->getStatus()){
				
				$someLocations = $messageGetLocations->getContent();
			}
			
			else{
				
			Template::flash('Could not find locations! ' . $messageGetLocations->getMessage());

			}
			
			$searchArgs = array(
			'personType' => 'speaker');
			// exec the search
			$messageSearchPersons = $tedx_manager->searchPersons($searchArgs);

			// test answer
			if($messageSearchPersons ->getStatus()){
			$someSpeakers = $messageSearchPersons->getContent();
			}
			else{
			echo 'No Speaker matched your criterias';
			}
			
			
		
		Template::render('addSlot.tpl',array(
			'someLocations' => $someLocations,
			'someSpeakers' => $someSpeakers));
	}
	
	
		//

		public function getSpeakerAndLocationData(){
			global $tedx_manager;

			$messageGetLocations = $tedx_manager->getLocations();
						
			//message
			if( $messageGetLocations->getStatus()){
				
				$someLocations = $messageGetLocations->getContent();
			}
			
			else{
				
			Template::flash('Could not find locations! ' . $messageGetLocations->getMessage());

			}
		
			$searchArgs = array(
			'personType' => 'speaker');
			// exec the search
			$messageSearchPersons = $tedx_manager->searchPersons($searchArgs);

			// test answer
			if($messageSearchPersons ->getStatus()){
			$someSpeakers = $messageSearchPersons->getContent();
			}
			
			else{
			echo 'No Speaker matched your criterias';
			}
			
			
		
		return array(
			'someLocations' => $someLocations,
			'someSpeakers' => $someSpeakers);
			
		}
		
		public function getEventData($id){
			global $tedx_manager;
		
		global $tedx_manager;
		$messageGetEvent = $tedx_manager->getEvent($id);
		
		//message
		if( $messageGetEvent->getStatus()){
							
			$anEvent = $messageGetEvent->getContent($id);
			
			$locationName = $anEvent->getLocationName();
			
			$messageGetLocation = $tedx_manager->getLocation($locationName);
			
			//message
			if( $messageGetLocation->getStatus()){
			
				$aLocation = $messageGetLocation->getContent();
			
				$messageGetSlotsFromEvent = $tedx_manager->getSlotsFromEvent($anEvent);
				//faire test
				if( $messageGetSlotsFromEvent->getStatus()){
				
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
								
								if ($messageGetSpeakerByPlace->getStatus()){
								
									$slotsWithSpeakers[$i][$place->getNo()]=$speaker;
									
								}
								
								else{
								
									Template::flash('Could not find speaker ' . $messageGetSpeakerByPlace->getMessage());	
								}
								
							}// foreach place
				
						}//if status	
			
						$i++;
					}// foreach slot
			
				}//if messageGetSlotsFromEvent
				
				else{
				
					Template::flash('Could not find slots ' . $messageGetSlotsFromEvent->getMessage());

				}//else messageGetSlotsFromEvent
					
			
			}//if messageGetLocation
			
			else{
			
				Template::flash('Could not find the associated location! ' . $messageGetLocation->getMessage());

			}//else

		}//if messageGetEvent
		
		else{
	
			Template::flash('Could not find this event! ' . $messageGetEvent->getMessage());
			Template::redirect("");
			
		}//else
		
		return array(
			'event' => $anEvent,
			'location' => $aLocation,
			'slotsWithSpeakers' => $slotsWithSpeakers

		);
			
		}
		

}//class


?>
