<?php

require_once SPLASHY_DIR . "/helpers/ViewController.php";
require_once SPLASHY_DIR . "/helpers/Template.php";

class PersonView extends ViewController {

    public function showProfile($id) {
        global $tedx_manager;
        $aPersonMessage = $tedx_manager->getPerson($id);
        
        // Message
        if (!$aPersonMessage->getStatus())
          
            echo 'Could not find person! ' . $aPersonMessage->getMessage();


        Template::render("profile.tpl", array(
            'personMessage' => $aPersonMessage,
            'person' => $aPersonMessage->getContent()
        ));
    }
    
    
    public function register() {
    	Template::render('register.tpl');
    }
    
    public function showAll() {
    	global $tedx_manager;
    	$persons = $tedx_manager->getPersons()->getContent();
    	Template::render('persons.tpl', array('persons' => $persons));
    }
    
    public function show($id) {
   		global $tedx_manager;
   		$person = $tedx_manager->getPerson($id)->getContent();
   		Template::render('profile.tpl', array(
   			'person' => $person
   		));
    }
    
    public function registerSubmit() {
    	$args = array(
    	    'name'        => $_POST['firstname'],
    	    'firstname'   => $_POST['lastname'],
    	    'dateOfBirth' => $_POST['dob_year']."-".$_POST['dob_month']."-".$_POST['dob_day'],
    	    'address'     => $_POST['address'],
    	    'city'        => $_POST['city'],
    	    'country'     => $_POST['country'],
    	    'phoneNumber' => $_POST['telephone'],
    	    'email'       => $_POST['email'],
    	    'idmember'    => $_POST['username'],
    	    'password'    => $_POST['password'],
    	);
    	
    	$aRegisteredVisitor = ASFree::registerVisitor( $args );
    	Template::flash($aRegisteredVisitor->getMessage());
    	
    	if($aRegisteredVisitor->getStatus()) {
    		Template::redirect("persons");
    	} else {
    		Template::redirect('register');
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

?>
