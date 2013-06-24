<?php

require_once SPLASHY_DIR . "/helpers/ViewController.php";
require_once SPLASHY_DIR . "/helpers/Template.php";

class PersonView extends ViewController {

		/**
		* Shows a profile page for any kind of person
		* 
		*/
		public function show($id) {
				global $tedx_manager;
				$personMsg = $tedx_manager->getPerson($id);
				
				if($personMsg->getStatus()) {
		 		Template::render('profile.tpl', array(
		 			'person' => $personMsg->getContent()
		 		));
		 	} else {
		 		Template::flash($personMsg->getMessage());
		 		Template::redirect('');
		 	}
		}

		/*
		* Displays a list of all the persons
		*
		*/
		public function showAll() {
			global $tedx_manager;
			$persons = $tedx_manager->getPersons()->getContent();
			Template::render('persons.tpl', array('persons' => $persons));
		}
    
    
    /**
    * Displays the form to allow subscription with TEDx
    * but only if you're not logged in 
    */
    public function register() {
    	global $tedx_manager;
    	
    	if(!$tedx_manager->isLogged()) {
    		Template::render('register.tpl');
    	} else {
    		Template::flash("Can't register when you already have an account");
    		Template::redirect('');
    	}
    }

    
    /*
    * Adds the Person to the database.
    *
    */
    public function registerSubmit() {
    	global $tedx_manager;
    	
    	$args = array(
    	    'name'        => $_POST['lastname'],
    	    'firstname'   => $_POST['firstname'],
    	    'dateOfBirth' => $_POST['dob_year']."-".$_POST['dob_month'].'-'.$_POST['dob_day'],
    	    'address'     => $_POST['address'],
    	    'city'        => $_POST['city'],
    	    'country'     => $_POST['country'],
    	    'phoneNumber' => $_POST['telephone'],
    	    'email'       => $_POST['email'],
    	    'idmember'    => isset($_POST['username']) ? $_POST['username'] : "",
    	    'password'    => isset($_POST['password']) ? $_POST['password'] : ""
    	);
    	
    	$aRegisteredVisitor = $tedx_manager->registerVisitor( $args );
    	Template::flash($aRegisteredVisitor->getMessage());
    	
    	if($aRegisteredVisitor->getStatus()) {
    		Template::redirect("persons");
    	} else {
    	  // Only functions when E-Mail not valid?
    		Template::render('register.tpl', array(
    			"person" => $aRegisteredVisitor->getContent()
    			)
    		);
    	}
    }


		/*
		*	
		*/
		public function editProfil($id) {
			global $tedx_manager;
			$personMsg = $tedx_manager->getPerson($id);
			
			Template::render('register.tpl', array(
				"person" => $personMsg->getContent(),
				"personId" => $id
			));
		}
		
		public function editProfilSubmit($id) {
			global $tedx_manager;
			
			$args = array(
					'no'					=> $id,
			    'name'        => $_POST['lastname'],
			    'firstName'   => $_POST['firstname'],
			    'dateOfBirth' => $_POST['dob_year']."-".$_POST['dob_month']."-".$_POST['dob_day'],
			    'address'     => $_POST['address'],
			    'city'        => $_POST['city'],
			    'country'     => $_POST['country'],
			    'phoneNumber' => $_POST['telephone'],
			    'email'       => $_POST['email']
			);
			
			$aChangedProfil= $tedx_manager->changeProfil( $args );
		
			if($aChangedProfil->getStatus()) {
				Template::redirect("person/$id");
			} else {
				Template::redirect("person/$id/edit");
			}
			
			
		}
	/*
    * Gets the participants with their motivations and keywords for an Event
    * and shows the registrations List for an Event
    */	

    public function showParticipant($id){
        global $tedx_manager;
        $tedx_manager->login('admin','admin');
        //get the messageGetEvent to get the object anEvent with the specified id for using the function getRegistrationsByEvents()
        $messageGetEvent = $tedx_manager->getEvent($id);
        //test if messageGetEven exists
        
        if($messageGetEvent->getStatus()){
            //get the object anEvent with the specified id
            $anEvent = $messageGetEvent->getContent();

            //call to the function to get all the registrations of the anEvent
            $messageGetRegistrationsByEvent = $tedx_manager->getRegistrationsByEvent($anEvent);
            //test if there are some registrations or not

            if($messageGetRegistrationsByEvent->getStatus()){

                //creation of the array of RegistrationParticipantwithMotivations and keywords
                $registrationsParticipantsWithMotivations = array();


                //get all the registrations (array)
                $registrations = $messageGetRegistrationsByEvent->getContent();

                //for each registration, get the participant and his motivations related to anEvent
                foreach ($registrations as $aRegistration) {

                    $aParticipant = $tedx_manager->getParticipant($aRegistration->getParticipantPersonNo())->getContent();
                    //work on the motivations
                    //parameters for the function getMotivationsByParticipantForEvent($args);
                    $args = array(
                            'participant' => $aParticipant,
                            'event'  => $anEvent
                            );
                    $messageGetMotivationsByParticipantForEvent = $tedx_manager->getMotivationsByParticipantForEvent($args);
                    
                    //test if there are some motivations for $aParticipant related to the anEvent
                    if($messageGetMotivationsByParticipantForEvent->getStatus()){
                        //creation of an array of motivations
                        $motivations = $messageGetMotivationsByParticipantForEvent->getContent();

                        
                    }else{
                        //no motivations, array empty
                        $motivations = array();
                    }//else

                    
                    //work on the Keywords
                    //parameters for the function getKeywordsByPersonForEvent($args);
                     $args = array(
                            'person' => $aParticipant,
                            'event'  => $anEvent
                            );
                    $messageGetKeywordsByPersonForEvent = $tedx_manager->getKeywordsByPersonForEvent($args);
                    
                    //test if there are some keywords for $aParticipant related to the anEvent
                    if($messageGetKeywordsByPersonForEvent->getStatus()){
                        //creation of an array of keywords
                        $keywords = $messageGetKeywordsByPersonForEvent->getContent();

                        
                    }else{
                        //no keywords, array empty
                        $keywords = array();
                    }//else

                     //fill the array $registrationsParticipantswithMotivations[] with the registration, the participant, his motivations and his keywords, related to anEvent
                    $registrationsParticipantswithMotivations[] = array(
                        'registration' => $aRegistration,
                        'participant' => $aParticipant,
                        'motivations' => $motivations,
                        'keywords' => $keywords
                        );
                    

                }//foreach
                //apply of the template validateParticipant.tpl and add of the var we need to use it
                Template::render('validateParticipant.tpl', array(
                            'event' => $anEvent,
                            'registrationsParticipantsWithMotivations' => $registrationsParticipantswithMotivations
                            ));
            }else{
                //error message: no registrations found
                Template::flash('Could not find registrations ' . $messageGetRegistrationsByEvent->getMessage());
            }//else
        }else{
            //error message: no event found
            Template::flash('Could not find event ' . $messageGetEvent->getMessage());
        }//else

    }//function


    /*
    * validates the inscription of a participant to anEvent
    */

    public function validateParticipantSubmit($idEvent, $idParticipant){
        global $tedx_manager;
        $tedx_manager->login('admin','admin');
        //get the messageGetEvent to get the object anEvent with the specified id for using the function getRegistrationsByEvents()
        $messageGetEvent = $tedx_manager->getEvent($idEvent);
        //test if messageGetEven exists
        
        if($messageGetEvent->getStatus()){
            //get the object anEvent with the specified id
            $anEvent = $messageGetEvent->getContent();

            //call to the function to get all the registrations of the anEvent
            $messageGetRegistrationsByEvent = $tedx_manager->getRegistrationsByEvent($anEvent);
            //test if there are some registrations or not

            if($messageGetRegistrationsByEvent->getStatus()){

                //get all the registrations (array)
                $registrations = $messageGetRegistrationsByEvent->getContent();

                //for each registration, get the participant, test the id of the participant and accept the registration if it's ok
                foreach ($registrations as $aRegistration) {

                    $aParticipant = $tedx_manager->getParticipant($aRegistration->getParticipantPersonNo())->getContent();

                    if($aParticipant->getPersonNo() == $idParticipant){
                        $aWaitingRegistration = $tedx_manager->getRegistration(array(
                            'status' =>$aRegistration->getStatus(), 
                            'event' => $anEvent, 
                            'participant' => $aParticipant))->getContent();
                        $anAcceptedRegistration= $tedx_manager->acceptRegistration($aWaitingRegistration);
                        //redirect on the same page and show a flash message "registration accepted"
                        Template::redirect('addParticipant.tpl');
                        Template::flash('The inscription of the participant number ' . $aParticipant->getPersonNo(). 'has been accepted');    
                    }                   

                }//foreach

            }else{
                //error message: no registrations found
                Template::flash('Could not find registrations ' . $messageGetRegistrationsByEvent->getMessage());
            }//else
        }else{
            //error message: no event found
            Template::flash('Could not find event ' . $messageGetEvent->getMessage());
            
        }//else



    }

    /*
    * rejects the inscription of a participant to anEvent
    */

    public function rejectParticipantSubmit($idEvent, $idParticipant){
        global $tedx_manager;
        $tedx_manager->login('admin','admin');
        //get the messageGetEvent to get the object anEvent with the specified id for using the function getRegistrationsByEvents()
        $messageGetEvent = $tedx_manager->getEvent($idEvent);
        //test if messageGetEven exists
        
        if($messageGetEvent->getStatus()){
            //get the object anEvent with the specified id
            $anEvent = $messageGetEvent->getContent();

            //call to the function to get all the registrations of the anEvent
            $messageGetRegistrationsByEvent = $tedx_manager->getRegistrationsByEvent($anEvent);
            //test if there are some registrations or not

            if($messageGetRegistrationsByEvent->getStatus()){

                //get all the registrations (array)
                $registrations = $messageGetRegistrationsByEvent->getContent();

                //for each registration, get the participant, test the id of the participant and reject the registration if it's not ok
                foreach ($registrations as $aRegistration) {

                    $aParticipant = $tedx_manager->getParticipant($aRegistration->getParticipantPersonNo())->getContent();

                    if($aParticipant->getPersonNo() == $idParticipant){
                        $aWaitingRegistration = $tedx_manager->getRegistration(array(
                            'status' =>$aRegistration->getStatus(), 
                            'event' => $anEvent, 
                            'participant' => $aParticipant))->getContent();
                        $aRejectedRegistration= $tedx_manager->acceptRegistration($aWaitingRegistration);
                        //redirect on the same page and show a flash message "registration rejected"
                        Template::redirect('addParticipant.tpl');
                        Template::flash('The inscription of the participant number ' . $aParticipant->getPersonNo(). 'has been rejected');    
                    }                   

                }//foreach

            }else{
                //error message: no registrations found
                Template::flash('Could not find registrations ' . $messageGetRegistrationsByEvent->getMessage());
            }//else
        }else{
            //error message: no event found
            Template::flash('Could not find event ' . $messageGetEvent->getMessage());
            
        }//else



    }



}//class


/*
$args = array(
    'name'        => isset($_POST['lastname']) ? $_POST['lastname'] : "",
    'firstname'   => isset($_POST['firstname']) ? $_POST['firstname'] : "",
    'dateOfBirth' => $_POST['dob_year']."-".$_POST['dob_month'].'-'.$_POST['dob_day'],
    'address'     => isset($_POST['address']) ? $_POST['address'] : "",
    'city'        => isset($_POST['city']) ? $_POST['city'] : "",
    'country'     => isset($_POST['country']) ? $_POST['country'] : "",
    'phoneNumber' => isset($_POST['telephone']) ? $_POST['telephone'] : "",
    'email'       => isset($_POST['email']) ? $_POST['email'] : "",
    'idmember'    => isset($_POST['username']) ? $_POST['username'] : "",
    'password'    => isset($_POST['password']) ? $_POST['password'] : ""
);
*/

?>
