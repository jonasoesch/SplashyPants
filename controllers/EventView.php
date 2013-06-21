<?php

require_once SPLASHY_DIR."/helpers/ViewController.php";
require_once SPLASHY_DIR."/helpers/Template.php";

class EventView extends ViewController {
  
 
	public function show($id) {
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
		
		
		Template::render('event.tpl', array(
			'event' => $anEvent,
			'location' => $aLocation,
			'slotsWithSpeakers' => $slotsWithSpeakers,
			'code' => '1077',
			'city' => 'Servion',
			'country' => 'Suisse'
		));
	}
	

}

?>
