<?php

/**
* EventView retrieval, treatment and display of pages
* in relation to an event
**/

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
				}
				else{
					Template::flash('Could not find location of the event no ' . $anEvent->getNo());
				}
			}//foreach
		
				Template::render('listEvents.tpl', array(
					'arrayEventsLocation' => $arrayEventsLocation,
					'numberOfEvents' => $numberOfEvents,
					'canEdit' => $this->canEditEvent()
					));
					
		}//if getEvents
		
		else{
			Template::flash('Could not find events ' . $messageGetEvents->getMessage());
			Template::redirect('');
		}

	}//end function showEvents


	/** ----------------------------------------------------------------------------------------------------
     * This methode gets speakers and locations data and sends it to the modifyEvent template.
     * It's helping the modify process
     * @param:$id identifiant de l'event
     */
	public function modify($id){
		
		$someSpeakers = $this->getSpeakersData();
		$someLocations = $this->getLocationsData();
		
		$arraySpeakersAndLocation = array('someSpeakers' => $someSpeakers,'someLocations' => $someLocations);
		$arrayModify= array_merge($this->getEventData($id), $arraySpeakersAndLocation);
		
		Template::render('modifyEvent.tpl',$arrayModify);
		
	}
	

   
	
	/**------------------------------------------------------------------------------------------
	* Get the data from the persistence
	* render a form for event with existing location
	* If not, there is a redirect to the homepage
	*/
	public function add() {
		global $tedx_manager;
		
		$messageGetLocations = $tedx_manager->getLocations();
						
		//message
		if( $messageGetLocations->getStatus()){
				
			$someLocations = $messageGetLocations->getContent();
			
			
			$searchArgs = array(
			'personType' => 'speaker');
			
			// exec the search
			$messageSearchPersons = $tedx_manager->searchPersons($searchArgs);

			// test answer
			if($messageSearchPersons ->getStatus()){
				$someSpeakers = $messageSearchPersons->getContent();
			}
			
			else{
				Template::flash('No Speaker matched your criterias');
				Template::redirect('');
			}
			
			$arraySpeakersAndLocation=array(
			'someLocations' => $someLocations,
			'someSpeakers' => $someSpeakers);
		
			Template::render('addEvent.tpl',$arraySpeakersAndLocation);
		
		}//if getLocations
			
		else{		
			Template::flash('Could not find locations! ' . $messageGetLocations->getMessage());
			Template::redirect('');
		}
		
	}//end function add()
	
        
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
		    'locationName'  => $_POST['locationName']
			);
			
			// 1..* array with the firts slot informations
			$slot1 = array (
			    'happeningDate' => $_POST['slot_dob_year']."-".$_POST['slot_dob_month']."-".$_POST['slot_dob_day'],
			    'startingTime'  => $_POST['slot_hob'].":00",
			    'endingTime'    => $_POST['slot_hoe'].":00",
			);
			
			// a array with the slot
			$argsSlots = array($slot1);
			 
			// final array for the function
			$megaArgsAddEvent = array (
			    'event'   => $argsCreateEvent,
			    'slots'   => $argsSlots
			);
			 
			// Event creation !
			$messageAddEvent = $tedx_manager->addEvent($megaArgsAddEvent);
			
			//get the informations the eventNo of the created slot 
			$idEvents = $messageAddEvent->getContent();
			$idEvent = $idEvents[0]->getNo();
			
    	//if the event is created redirect to this one   	
    	if($messageAddEvent->getStatus()) {
    		Template::redirect("event/$idEvent");
    	} 
    	
    	else {
    		Template::redirect('addEvent');
    	}
    }
    
    
		/**------------------------------------------------------------------------------------------
		* Submit the data of a modified event to the persistence
		* when it's done, redirect to the event modified
		* If not, there is a redirect to the form to add an event
		*/    
    	public function submitModifiedEvent($id) {
			global $tedx_manager;
			
			//array received from the form modifyEvent
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
			if( $messageChangeEvent->getStatus()){
			    Template::flash('Congrats! ' . $messageChangeEvent->getMessage());
			}
			else {
			    Template::flash('Error! ' . $messageChangeEvent->getMessage());
			}
			
			//get the eventNo in back
			$idEvents = $messageChangeEvent->getContent();
				
			
				
			//part two: changeLocationToAnEvent()		
			$messageGetEvent = $tedx_manager->getEvent($id);
		
			
			//message
			if( $messageGetEvent->getStatus()){
			
				$anEvent = $messageGetEvent->getContent();
			}
			
			//an array for the final function
			$argsLocation = array(
				'event'        => $tedx_manager->getEvent($id)->getContent(),
				'locationName' => $_POST['locationName2']
			);
			
			// Change the location
			$messageChangeEventLocation = $tedx_manager->changeEventLocation($argsLocation);
			
			// Message
			if( $messageChangeEventLocation->getStatus()) {
				Template::flash('Congrats! A location name changed in the event' . $messageChangeEventLocation->getMessage());
			}
			else {
				Template::flash('Error! ' . $messageChangeEventLocation->getMessage());
			}
			    	
    	if($messageChangeEvent->getStatus()) {
    		Template::redirect("event/$id");
    	} 
    	else {
    		Template::redirect('addEvent');
    	}
    	
    }
    
    
    
   		 /**------------------------------------------------------------------------------------------
		* get information of an event from the persistence
		* when it's done, render the template event
		* If not, there is a redirect to the homepage
		*/ 
		public function show($id) {
			global $tedx_manager;
		
			//check if the user can edit event
			$canEdit = $this->canEditEvent();
			$logArray=array('canEdit'=>$canEdit);

			//if the can edit give an array with the informations
			if ($canEdit==true){
			$someSpeakers = $this->getSpeakersData();
			
			$speaker = array('someSpeakers' => $someSpeakers, );
			
				$untableau= array_merge($this->getEventData($id), $speaker, $logArray);
			}
			
			//otherwise don't give the information of the speaker
			else{
				$untableau=array_merge($this->getEventData($id), $logArray);
			}
			
				Template::render('event.tpl',$untableau);
		
		}
		
		
		/**------------------------------------------------------------------------------------------
		* get information of a slot from the persistence
		* when it's done, render the template of the form
		* If not, there is a redirect to the homepage
		* id: the eventNo
		* idSlot: the slotNo
		*/ 
		public function editSlot($id,$idSlot) {
		global $tedx_manager;
		
			//check if the user can edit
			$canEdit = $this->canEditEvent();
			
			$messageGetEvent = $tedx_manager->getEvent($id);
		
			//check the message getEvent
			if( $messageGetEvent->getStatus()){
			
				$eventData = $this->getEventData($id);

				$anEvent = $messageGetEvent->getContent();
		
				//array of for the function getSlot
				$args=array(
					'no'	=>	$idSlot,
					'event' =>	$anEvent);		
		
				$messageGetSlot = $tedx_manager->getSlot($args);
						
				//check the message getSlot
				if( $messageGetSlot->getStatus()){
				
					$slot = $messageGetSlot->getContent();

					$messageGetPlacesBySlot = $tedx_manager->getPlacesBySlot($slot);
				
					//$someSpeakers=array();
				
					if ($messageGetPlacesBySlot->getStatus()){
						$places = $messageGetPlacesBySlot->getContent();
			
						//assign a place
						foreach($places as $place){
		
							$messageGetSpeakerByPlace = $tedx_manager->getSpeakerByPlace($place);
							
							$speaker = $messageGetSpeakerByPlace->getContent();
							
							//check the message getSpeakerByPlace
							if ($messageGetSpeakerByPlace->getStatus()){
						
								$someSpeakers[]=$speaker;

								
							}
							else
							{
								$someSpeakers=false;
							}
						}// foreach place
						
						
							}//if getPlaceBySpot
					
					else{
							$someSpeakers=false;
							
					}	
								$untableau= array(
									'event' => $eventData['event'],
									'location' => $eventData['location'],
									'someSpeakers' => $someSpeakers, 
									'slot' => $slot,
									'canEdit'=>$canEdit				
								);
					
								Template::render('editSlot.tpl',$untableau);
										
				}//if getSlot
			
				else{
					Template::flash('Could not find this slot! ' . $messageGetSlot->getMessage());
					Template::redirect('');
				}//else getslot
			
			}//if getEvent
			
			else
			
			{
				Template::flash('Error! ' . $messageGetEvent->getMessage());
				Template::redirect('');
			}
			
		}//end function editslot()
		

		/**------------------------------------------------------------------------------------------
		* send the information to change a slot to the persistence
		* when it's done, redirect to the event of the modified slot
		* If not, there is a redirect to the homepage with a error message
		* id: the eventNo
		* idSlot: the slotNo
		*/ 
		public function submitModifiedSlot($id,$idSlot) {
			global $tedx_manager;
			
			$canEdit = $this->canEditEvent();
	
			$messageGetEvent = $tedx_manager->getEvent($id);
			
			//check message getEvent
			if( $messageGetEvent->getStatus()){
				
				$anEvent = $messageGetEvent->getContent();
			
				//array for the function changeSlot
		        $args = array(
		                    'no'            => $idSlot,
		                    'event'       	=> $anEvent,
		                    'happeningDate' => $_POST['slot_dob_year']."-".$_POST['slot_dob_month']."-".$_POST['slot_dob_day'],
							'startingTime'  => $_POST['slot_hob'],
							'endingTime'    => $_POST['slot_hoe'],
							);
							
						// Changing the Slot
						$messageChangeSlot = $tedx_manager->changeSlot( $args );
		
						// if the change is done
						if( $messageChangeSlot->getStatus()){
							Template::flash($messageChangeSlot->getMessage());
						}
						else{
							Template::flash('Error! ' . $messageChangeSlot->getMessage());
						}
						
				Template::redirect("event/$id");
			
			}//if message getEvent
			
			else {
				Template::flash('Could not find the event! ' . $messageGetEvent->getMessage());
				Template::redirect('');
			}
							
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
					'event' => $eventData['event'],
					'location' => $eventData['location'],
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
		
			$canEdit = $this->canEditEvent();

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
					$untableau= array(
					'event' => $eventData['event'],
					'location' => $eventData['location'],
					'someSpeakers' => $this->getSpeakersData(),
					//'speakers' => $speakers, 
					'slot' => $slot,
					'canEdit' => $canEdit
					
					
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
			    Template::flash('Speaker not found, see error '. $messageGetSpeaker->getMessage());
			}// else
			
			$messageGetPlacesBySlot = $tedx_manager->getPlacesBySlot($slot);
		
			if ($messageGetPlacesBySlot->getStatus()){
				$places = $messageGetPlacesBySlot->getContent();
				
				//compte le nombre de places existantes dans le slot				
				$nbrPlaces = count($places)+1;
				
			}
			else{
				$nbrPlaces=1;
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
				Template::flash('Speaker Added' . $messageSpeakerAddedToPlace->getMessage());
			    }
			    
			else{
			    Template::flash('Error' . $$messageSpeakerAddedToPlace->getMessage());
			    }

			
				Template::redirect("event/$id");
			
			}
			
		public function addSlot($id) {
			global $tedx_manager;
		
			$canEdit = $this->canEditEvent();
			$logArray=array('canEdit'=>$canEdit);
			
			
			$someSpeakers = $this->getSpeakersData();
			
			$speaker = array('someSpeakers' => $someSpeakers);
			
				$untableau= array_merge($this->getEventData($id), $speaker, $logArray);
			
				Template::render('addSlotToAnEvent.tpl',$untableau);
			
		}	
		
		public function submitAddSlot($id){
			global $tedx_manager;

			$messageGetEvent = $tedx_manager->getEvent($id);
			
			$canEdit = $this->canEditEvent();
		
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
			
				// Add slot to an event
				$messageAddSlotToEvent = $tedx_manager->addSlotToEvent( $args );
				 
				//if Slot added successfully
				if( $messageAddSlotToEvent->getStatus() ){
					Template::redirect("event/$id");
					}
					 
				else{
				    Template::flash('Error'. $messageAddSlotToEvent->getMessage());
				    }
			}//if getEvent
			
			else{
					
				Template::flash('Could not find this event! ' . $messageGetEvent->getMessage());
			}//else getEvebt
				
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
				Template::flash('Could not find speaker ');
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
          
  				if( 		$tedx_manager->isOrganizer() ||
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
