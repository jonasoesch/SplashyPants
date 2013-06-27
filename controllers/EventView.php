<?php

require_once SPLASHY_DIR."/helpers/ViewController.php";
require_once SPLASHY_DIR."/helpers/Template.php";

class EventView extends ViewController {
  
 /** ----------------------------------------------------------------------------------------------------
     * Cette mŽthode affiche l'event ˆ partir de l'id reu.
     * @param:$id identifiant de l'event
     */
	public function show($id) {
		

		Template::render('event.tpl',
			$this->getEventData($id) 
		);
	}

	/**------------------------------------------------------------------------------------------
	* Show a list of all events with help from the getEvents and the getLocations from Events methodes.
         * After that he gives the arrays to the template listEvents
         * 
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
					'numberOfEvents' => $numberOfEvents,
					'canEdit' => $this->canEditEvent()
					));
					
		}else{

			Template::flash('Could not find events ' . $messageGetEvents->getMessage());
		}


	}

	/** ----------------------------------------------------------------------------------------------------
     * This methode gets speakers and locations data and sends it to the modifyEvent template.
     * It's helping the modify process
     * @param:$id identifiant de l'event
     */
	public function modify($id){
		
		$someSpeakers = $this->getSpeakersData();
		$someLocations = $this->getLocationsData();
		
		$unautretableau = array('someSpeakers' => $someSpeakers,'someLocations' => $someLocations);
		$untableau= array_merge($this->getEventData($id), $unautretableau);
		
		Template::render('modifyEvent.tpl',$untableau);
		
	}
	
        /** ----------------------------------------------------------------------------------------------------
     * This methode adds all the locations and speakers to the addEvent template with the templates
         * searchPersons and getLocation methodes from the tedxmanager class
     * @param:$id identifiant de l'event
     */
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
        
        /** ----------------------------------------------------------------------------------------------------
     * If you click on submit on the event template, this  method will be executed. It takes all the parameters
         * from the $_POST class. After, he puts the three main arrays ($argsCreateEvent,$slots,$argSlots) in 
         * the $megaArgsAddEvent array. This array will be sent to the addEvent method from the $tedxmanagerclass
         * 
     */
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
			    'startingTime'  => $_POST['slot_hob'].":00",
			    'endingTime'    => $_POST['slot_hoe'].":00",
			);
			$slot2 = array (
			    'happeningDate' => $_POST['slot_dob_year']."-".$_POST['slot_dob_month']."-".$_POST['slot_dob_day'],
			    'startingTime'  => $_POST['slot_hob'].":00",
			    'endingTime'    => $_POST['slot_hoe'].":00",
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
        
        /** ----------------------------------------------------------------------------------------------------
     * After clicking on submit on modify event this method will be executed.
         * It takes all the $_POST parameters and sends it to the changeEvent or changeLocation method.
         * (similar to the submitEvent method)
         * 
     * @param:$id identifiant de l'event
     */
    	public function submitModifiedEvent($id) {
			global $tedx_manager;
			
			$args = array(
			    'no'           => $id,
			    'mainTopic'    => $_POST['mainTopic'],
			    'description'  => $_POST['description'],
			    'startingDate' => $_POST['event_dob_year']."-".$_POST['event_dob_month']."-".$_POST['event_dob_day'],
			    'endingDate'   => $_POST['event_doe_year']."-".$_POST['event_doe_month']."-".$_POST['event_doe_day'],
			    'startingTime' => $_POST['event_hob'],
			    'endingTime'   => $_POST['event_hoe'],
			);
			// Changing the Event
			$messageChangeEvent = $tedx_manager->changeEvent( $args );
			// if the change is done
			if( $messageChangeEvent->getStatus())
			    echo 'Congrats! ' . $messageChangeEvent->getMessage();
			else
			    echo 'Error! ' . $messageChangeEvent->getMessage();
			
			$idEvents = $messageChangeEvent->getContent();
						
			$messageGetEvent = $tedx_manager->getEvent($id);
		
			//message
			if( $messageGetEvent->getStatus()){
			
				$anEvent = $messageGetEvent->getContent();
			}
			
			$argsLocation = array(
			'event'        => $tedx_manager->getEvent($id)->getContent(),
			'locationName' => $_POST['locationName2']
			);
			
			
			
			// Change the location
			$messageChangeEventLocation = $tedx_manager->changeEventLocation($argsLocation);
			
			// Message
			if( $messageChangeEventLocation->getStatus()) {
			 echo 'Congrats! A location name changed in the event' . $messageChangeEventLocation->getMessage();
			}
			else {
			 echo 'Error! ' . $messageChangeEventLocation->getMessage();
			}
			
    	//Template::flash($messageAddEvent->getMessage());
    	
    	if($messageChangeEvent->getStatus()) {
    		//$idEvent->getNo();
    		Template::redirect("event/$id");
    	} else {
    		//Template::redirect('addEvent');
    	}
    	
    }
    
    
        /** ----------------------------------------------------------------------------------------------------
     * If 
     * @param:$id identifiant de l'event
     */
    	public function slot($id) {
		global $tedx_manager;
		
			if($this->canEditEvent()) {
			
			$someSpeakers = $this->getSpeakersData();
			
			$speaker = array('someSpeakers' => $someSpeakers);
			
				$untableau= array_merge($this->getEventData($id), $speaker);
			
				Template::render('addSlot.tpl',$untableau);
			}
		}
		
		public function editSlot($id,$idSlot) {
		global $tedx_manager;
		
			$messageGetEvent = $tedx_manager->getEvent($id);
		
			//message
			if( $messageGetEvent->getStatus()){
			
				$anEvent = $messageGetEvent->getContent();
		
				$args=array(
				'no'	=>	$idSlot,
				'event' =>	$anEvent);		
		
				$messageGetSlot = $tedx_manager->getSlot($args);
						
				//message
				if( $messageGetSlot->getStatus()){
				
					$slot = $messageGetSlot->getContent();
					}//if getSlot
			
				else{
				
					Template::flash('Could not find this slot! ' . $messageGetSlot->getMessage());

					}//else getslot
					
				$messageGetPlacesBySlot = $tedx_manager->getPlacesBySlot($slot);
				
				$someSpeakers;
				
				if ($messageGetPlacesBySlot->getStatus()){
					$places = $messageGetPlacesBySlot->getContent();
			
							
					foreach($places as $place){
		
						$messageGetSpeakerByPlace = $tedx_manager->getSpeakerByPlace($place);
						//faire if
						$speaker = $messageGetSpeakerByPlace->getContent();
						
						if ($messageGetSpeakerByPlace->getStatus()){
						
							$someSpeakers[]=$speaker;
							
						}
						
						else{
						
							Template::flash('Could not find speaker ' . $messageGetSpeakerByPlace->getMessage());	
						}
						
					}// foreach place
		
				}//if status	
	

						
				if($this->canEditEvent()) {
						
					
					
				
					$untableau= array(
					'event' => $this->getEventData($id)['event'],
					'location' => $this->getEventData($id)['location'],
					'someSpeakers' => $someSpeakers, 
					'slot' => $slot
					
					);
					
					
			
					Template::render('editSlot.tpl',$untableau);
					
			}//if editEvent
			
			}//if getEvent
			
		}//end function editslot()
		
		public function submitModifiedSlot($id,$idSlot) {
		global $tedx_manager;
		
		// Args change profil
		$messageGetEvent = $tedx_manager->getEvent($id);
		
			//message
		if( $messageGetEvent->getStatus()){
			
		$anEvent = $messageGetEvent->getContent();
		}
		
        $args = array(
                    'no'            => $idSlot,
                    'event'       	=> $anEvent,
                    'happeningDate' => $_POST['slot_dob_year']."-".$_POST['slot_dob_month']."-".$_POST['slot_dob_day'],
					'startingTime'  => $_POST['slot_hob'],
					'endingTime'    => $_POST['slot_hoe'],
                );
                echo var_dump($args);
				// Changing the Slot
				$messageChangeSlot = $tedx_manager->changeSlot( $args );

				// if the change is done
				if( $messageChangeSlot->getStatus()){
				echo 'Congrats! ' . $messageChangeSlot->getMessage();
				}
				else{
				echo 'Error! ' . $messageChangeSlot->getMessage();
				}
				
		Template::redirect('');
						
		}//end function editslot()
		
		
		
		public function editSpeaker($id,$idSlot,$idSpeaker) {
		global $tedx_manager;
		
			$messageGetEvent = $tedx_manager->getEvent($id);
		
			//message
			if( $messageGetEvent->getStatus()){
			
				$anEvent = $messageGetEvent->getContent();
		
				$args=array(
				'no'	=>	$idSlot,
				'event' =>	$anEvent);		
		
				$messageGetSlot = $tedx_manager->getSlot($args);
						
				//message
				if( $messageGetSlot->getStatus()){
				
					$slot = $messageGetSlot->getContent();
					}//if getSlot
			
				else{
				
					Template::flash('Could not find this slot! ' . $messageGetSlot->getMessage());

					}//else getslot
					
				$messageGetPlacesBySlot = $tedx_manager->getPlacesBySlot($slot);
				
				$speakers;
				
				if ($messageGetPlacesBySlot->getStatus()){
					$places = $messageGetPlacesBySlot->getContent();
			
							
					foreach($places as $place){
		
						$messageGetSpeakerByPlace = $tedx_manager->getSpeakerByPlace($place);
						//faire if
						$speaker = $messageGetSpeakerByPlace->getContent();
						
						if ($messageGetSpeakerByPlace->getStatus()){
						
							$speakers[]=$speaker;
							
						}
						
						else{
						
							Template::flash('Could not find speaker ' . $messageGetSpeakerByPlace->getMessage());	
						}
						
					}// foreach place
		
				}//if status	
	

						
				if($this->canEditEvent()) {
						
          $eventData = $this->getEventData($id);
          $speakerAndLocation = $this->getSpeakerAndLocationData();
          
					$untableau= array(
					'event' => $this->getEventData($id)['event'],
					'location' => $this->getEventData($id)['location'],
					'someSpeakers' => $this->getSpeakersData(),
					'someSpeakers' => $speakers, 
					'event' => $eventData['event'],
					'location' => $eventData['location'],
					'someSpeakers' => $speakerAndLocation['someSpeakers'],
					//'someSpeakers' => $someSpeakers, 
					'slot' => $slot
					);
			
				Template::render('editSlotWithSpeakers.tpl',$untableau);
				}//if editEvent
			
			}//if getEvent
			
		}//end function editslot()
		
		public function addSpeaker($id,$idSlot) {
		global $tedx_manager;
		
			$messageGetEvent = $tedx_manager->getEvent($id);
		
			//message
			if( $messageGetEvent->getStatus()){
			
				$anEvent = $messageGetEvent->getContent();
		
				$args=array(
				'no'	=>	$idSlot,
				'event' =>	$anEvent);		
		
				$messageGetSlot = $tedx_manager->getSlot($args);
						
				//message
				if( $messageGetSlot->getStatus()){
				
					$slot = $messageGetSlot->getContent();
					}//if getSlot
			
				else{
				
					Template::flash('Could not find this slot! ' . $messageGetSlot->getMessage());

					}//else getslot
					
				$messageGetPlacesBySlot = $tedx_manager->getPlacesBySlot($slot);
				
				$speakers;
				
				if ($messageGetPlacesBySlot->getStatus()){
					$places = $messageGetPlacesBySlot->getContent();
			
							
					foreach($places as $place){
		
						$messageGetSpeakerByPlace = $tedx_manager->getSpeakerByPlace($place);
						//faire if
						$speaker = $messageGetSpeakerByPlace->getContent();
						
						if ($messageGetSpeakerByPlace->getStatus()){
						
							$speakers[]=$speaker;
							
						}
						
						else{
						
							Template::flash('Could not find speaker ' . $messageGetSpeakerByPlace->getMessage());	
						}
						
					}// foreach place
		
				}//if status	
	

						
				if($this->canEditEvent()) {
						
	
					$untableau= array(
					'event' => $this->getEventData($id)['event'],
					'location' => $this->getEventData($id)['location'],
					'someSpeakers' => $this->getSpeakersData(),
					//'speakers' => $speakers, 
					'slot' => $slot
					
					
					);
			
				Template::render('addSpeakers.tpl',$untableau);
				}//if editEvent
			
			}//if getEvent
			
		}//end function editslot()

		public function submitAddSpeaker($id,$idSlot) {
		global $tedx_manager;
		
			
			$messageGetEvent = $tedx_manager->getEvent($id);
		
			//message
			if( $messageGetEvent->getStatus()){
			
				$anEvent = $messageGetEvent->getContent();
		
				$args=array(
				'no'	=>	$idSlot,
				'event' =>	$anEvent);		
		
				$messageGetSlot = $tedx_manager->getSlot($args);
						
				//message
				if( $messageGetSlot->getStatus()){
				
					$slot = $messageGetSlot->getContent();
					}//if getSlot
			
				else{
				
					Template::flash('Could not find this slot! ' . $messageGetSlot->getMessage());

					}//else getslot
			}
			
			// speaker numero
			$aSpeakerPersonNo = $_POST['speakerNo'];
			// getting the speaker with numero
			$messageGetSpeaker = $tedx_manager->getSpeaker( $aSpeakerPersonNo );
			
			if($messageGetSpeaker->getStatus()){
			    // getting the speaker from the message
			    $aSpeaker = $messageGetSpeaker->getContent();
			 
			 
			}// if
			else {
			    echo 'Speaker not found, see error '. $messageGetSpeaker->getMessage();
			}// else
			
			$messageGetPlacesBySlot = $tedx_manager->getPlacesBySlot($slot);
		
			if ($messageGetPlacesBySlot->getStatus()){
				$places = $messageGetPlacesBySlot->getContent();
				
				
				//compte le nombre de places existantes dans le slot				
				$nbrPlaces = count($places)+1;
			}
			
			
			// Args addSpeakerToPlace
			
			$argsAddSpeakerToPlace = array(
			    'no'                => $nbrPlaces,
			    'event'             => $anEvent,
			    'slot'              => $slot,
			    'speaker'           => $aSpeaker,
			    'videoTitle'        => "Super Video Title",
			    'videoDescription'  => "Super video Description",
			    'videoURL'          => "http://www.youtube.com/watch?v=u5obDMFMFxQ"
			);
			 
			$messageSpeakerAddedToPlace = $tedx_manager->addSpeakerToPlace($argsAddSpeakerToPlace);
			 
			// Message
			if( $messageSpeakerAddedToPlace->getStatus() ){
			    echo 'Congrats! ' . $messageSpeakerAddedToPlace->getMessage();
			    }
			    
			else{
			    echo 'Error! ' . $messageSpeakerAddedToPlace->getMessage();
			    }
			
			$someSpeakers = $this->getSpeakersData();
			
			$speaker = array('someSpeakers' => $someSpeakers);
			
				$untableau= array_merge($this->getEventData($id), $speaker);
			
				Template::render('addSlot.tpl',$untableau);
			
			}
			
		public function addSlot($id) {
			global $tedx_manager;
		
			if($this->canEditEvent()) {
			
			$someSpeakers = $this->getSpeakersData();
			
			$speaker = array('someSpeakers' => $someSpeakers);
			
				$untableau= array_merge($this->getEventData($id), $speaker);
			
				Template::render('addSlotToAnEvent.tpl',$untableau);
			}
		}	
		
		public function submitAddSlot($id){
			global $tedx_manager;

			$messageGetEvent = $tedx_manager->getEvent($id);
		
			//message
			if( $messageGetEvent->getStatus()){
			
				$anEvent = $messageGetEvent->getContent();
				
			
			// Args addSlotToEvent
			$args = array(
				'happeningDate' => $_POST['slot_dob_year']."-".$_POST['slot_dob_month']."-".$_POST['slot_dob_day'],
			    'startingTime'  => $_POST['slot_hob'],
			    'endingTime'    => $_POST['slot_hoe'],
			    'event'         => $anEvent
			);
			
			echo var_dump($args);
			// Add slot to an event
			$messageAddSlotToEvent = $tedx_manager->addSlotToEvent( $args );
			 
			//if Slot added successfully
			if( $messageAddSlotToEvent->getStatus() ){
				Template::redirect("event/$id");
				}
				 
			else{
			    echo 'Error! ' . $messageAddSlotToEvent->getMessage();
			    }
			}
			else{
				
			Template::flash('Could not find locations! ' . $messageGetLocations->getMessage());

			}
			

		
			
		}//end function addsubmitSlot

		public function getLocationsData(){
			global $tedx_manager;

			$messageGetLocations = $tedx_manager->getLocations();
						
			//message
			if( $messageGetLocations->getStatus()){
				
				$someLocations = $messageGetLocations->getContent();
			}
			
			else{
				
			Template::flash('Could not find locations! ' . $messageGetLocations->getMessage());

			}
		
			return $someLocations;
		}//end function locations
		
		
		public function getSpeakersData(){
			global $tedx_manager;
		
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
			
			return $someSpeakers;
			
		}//end function speakers
		
		
		
	public function getEventData($id){
		
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
			
					$i=0; // compter les slots
			
					foreach($someSlot as $aSlot){
					
						$slotsWithSpeakers[$i]['slotData']=$aSlot;
						$messageGetPlacesBySlot = $tedx_manager->getPlacesBySlot($aSlot);
						

						
						if ($messageGetPlacesBySlot->getStatus()){
							$places = $messageGetPlacesBySlot->getContent();
													
														
							foreach($places as $place){
				
								$messageGetSpeakerByPlace = $tedx_manager->getSpeakerByPlace($place);
								//faire if
								
								if ($messageGetSpeakerByPlace->getStatus()){
								
																
									$speaker = $messageGetSpeakerByPlace->getContent();

									// Overwrites if there is already a place with the same No
									// Only the last place with a given No is shown
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
		
		  /** ----------------------------------------------------------------------------------------------------
		    * Check if somebody has the right to change the event with a given id.
		    */
	public function canEditEvent() {
      	global $tedx_manager;
      
	  	$loggedPersonMsg = $tedx_manager->getLoggedPerson();
	  	$canEdit = false;
      
	  	if($loggedPersonMsg->getStatus()) {
          
  				if($tedx_manager->isValidator() || 
  				          $tedx_manager->isOrganizer() ||
  				          $tedx_manager->isAdministrator() ||
  				          $tedx_manager->isSuperadmin()
  				 ) 	{	
	  				$canEdit = true; 
					}
		}
        return $canEdit;
	}
		
		  /**
  * Can return null
  **/
  public static function getLatestEvent() {
    global $tedx_manager;
    
    $theLastEvent = null;
    
    //get the events
    $messageGetEvents = $tedx_manager->getEvents();
    //test if the messageGetEvents isn't empty
    if($messageGetEvents->getStatus()){
      $someEvents = $messageGetEvents->getContent();
      //reference event for the test
      $eventTest = $someEvents[0];
      //for each event, try to catch the last event (sort by Starting date) by comparison with the reference Event
      foreach ($someEvents as $anEvent) {
        $resultOfComparisonDate = strcmp($anEvent->getStartingDate(), $eventTest->getStartingDate());
        //comparison on the StartingDate, if the StartingDate is before the $eventTest's StartingDate, the lastEvent is $anEvent
        if($resultOfComparisonDate <=0){
          //asignment
          $theLastEvent = $anEvent;
        }else{
          //the lastEvent is the reference Event ($eventTest)
          $theLastEvent = $eventTest;
        }        
      }
    }else{
      //error message: no event found
      Template::flash('Could not find events ' . $messageGetEvents->getMessage());
    }
    return  $theLastEvent;
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

            Template::flash($messageAddLocation->getMessage());
            Template::redirect("locations");}
     
    }


?>
