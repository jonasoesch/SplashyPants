<?php

require_once SPLASHY_DIR."/helpers/ViewController.php";
require_once SPLASHY_DIR."/helpers/Template.php";

class EventView extends ViewController {
  
 
	public function show($id) {
		

		Template::render('event.tpl',
			$this->getEventData($id) 
		);
	}

	/**------------------------------------------------------------------------------------------
	* Shows a list of all the events
	*/
	public function showEvents(){
		global $tedx_manager;

		$messageGetEvents = $tedx_manager->getEvents();
		$numberOfEvents = 0;
		if($messageGetEvents->getStatus()){
			$someEvents = $messageGetEvents->getContent();

			$arrayEventsLocation = array();

			foreach ($someEvents as $anEvent) {
				$messageLocation = $tedx_manager->getLocationFromEvent($anEvent);
				if($messageLocation->getStatus()){
					$LocationOfanEvent = $messageLocation->getContent();

					$arrayEventsLocation[] = array(
			          'event' => $anEvent,
			          'location' => $LocationOfanEvent);
					$numberOfEvents++;
				}else{
					Template::flash('Could not find location of the event no ' . $anEvent->getNo());
				}
			}
				Template::render('listEvents.tpl', array(
					'arrayEventsLocation' => $arrayEventsLocation,
					'numberOfEvents' => $numberOfEvents));

		}else{

			Template::flash('Could not find events ' . $messageGetEvents->getMessage());
		}


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
		    'locationName'  => $_POST['locationName2']  // ligne � enlever si pas de Location !
			);
			
			// 1..* arrays pour cr�ation des Slots
			// Note: pas de r�f�rence � l'Event !(Event.No ind�termin�)
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
			 
			// Cr�ation de l'Event !
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
		    'locationName'  => $_POST['locationName2']  // ligne � enlever si pas de Location !
			);
			
			// 1..* arrays pour cr�ation des Slots
			// Note: pas de r�f�rence � l'Event !(Event.No ind�termin�)
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
			 
			// Cr�ation de l'Event !
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
    
    
    	public function slot($id) {
		global $tedx_manager;
					
		echo "<pre>";
		echo $this->getSpeakerAndLocationData();
		echo "</pre>";
		
		$untableau= array_merge($this->getEventData($id), $this->getSpeakerAndLocationData());
		
		Template::render('addSlot.tpl',$untableau);
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
		

//class

public function locations() {
        Template::render('locations.tpl');
    }

    public function locationsSubmit() {
        global $tedx_manager;
        $args = array(
            'Name' => $_POST['name'],
            'Address' => $_POST['address'],
            'City' => $_POST['city'],
            'Country' => $_POST['country'],
            'Direction' => $_POST['direction']
        );

        $messageAddLocation = $tedx_manager->addLocation($args);

        // Message
        if ($messageAddLocation->getStatus()){
            
         Template::flash('Congrats! ' . $messageAddLocation->getMessage());
            Template::redirect("locations");}
        else{
          Template::flash($messageAddLocation->getMessage());
          Template::redirect("locations");}
        }
    }


?>
