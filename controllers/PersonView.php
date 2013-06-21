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
    		Template::redirect("person/$aRegisteredVisitor->getContent()->getNo()");
    	} else {
    		Template::render('register.tpl');
    		/* Not yet implented. Waiting for IT.
    		Template::render('register.tpl', array(
    			"person" => $aRegisteredVisitor->getContent()
    			)
    		);
    		*/
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
		

    public function showParticipant($id){
        global $tedx_manager;
        //récupération du messageGetEvent en vue de récupérer l'objet anEvent pour l'utilisation dans la fonction getRegistrationsByEvents()
        $messageGetEvent = $tedx_manager->getEvent($id);
        //test si l'event existe
        
        if($messageGetEvent->getStatus()){
            //récupération de l'objet anEvent
            $anEvent = $messageGetEvent->getContent();

            //appel de la fonction pour obtenir les registration de l'event
            $messageGetRegistrationsByEvent = $tedx_manager->getRegistrationsByEvent($anEvent);
            //test s'il existe ou non des registrations
            if($messageGetRegistrationsByEvent->getStatus()){

                //array RegistrationParticipantwithMotivations
                $registrationsParticipantsWithMotivations = array();



                //récupération des registrations
                $registrations = $messageGetRegistrationsByEvent->getContent();
                //pour chaque registration, récupération du participant et de ses motivations en lien avec l'event
                foreach ($registrations as $aRegistration) {

                    $aParticipant = $tedx_manager->getParticipant($aRegistration->getParticipantPersonNo())->getContent();
                    
                    $args = array(
                            'participant' => $aParticipant,
                            'event'  => $anEvent
                            );
                    $messageGetMotivationsByParticipantForEvent = $tedx_manager->getMotivationsByParticipantForEvent($args);
                    //test s'il existe des motivations pour le participant et pour l'event
                    if($messageGetMotivationsByParticipantForEvent->getStatus()){
                        //récupération du contenu de la motivation
                        $motivations = $messageGetMotivationsByParticipantForEvent->getContent();

                        
                    }else{
                        //pas de motivation pour la registration en question
                        $motivations = array();
                    }//else

                     //mettre de côt la registration
                    $registrationsParticipantswithMotivations[] = array(
                        'registration' => $aRegistration,
                        'participant' => $aParticipant,
                        'motivations' => $motivations
                        );


                }//foreach
                //renvoi des variable qu'on a besoin
                Template::render('addParticipant.tpl', array(
                            'event' => $anEvent,
                            'registrationsParticipantsWithMotivations' => $registrationsParticipantsWithMotivations
                            ));
            }else{
                Template::flash('Could not find registrations ' . $messageGetRegistrationsByEvent->getMessage());
            }//else
        }else{
            Template::flash('Could not find event ' . $messageGetEvent->getMessage());
            //Template::redirect('');
        }//else


        
        

       


    }//function



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
