<?php

require_once SPLASHY_DIR . "/helpers/ViewController.php";
require_once SPLASHY_DIR . "/helpers/Template.php";

class PersonView extends ViewController {

    public function showProfile($id) {
        global $tedx_manager;
        //cherche la personne avec son nummŽro ($id)
        $aPersonMessage = $tedx_manager->getPerson($id);

        // Si la personne cherchŽe n'existe pas alors gŽnre un message d'erreur
        if (!$aPersonMessage->getStatus())
            echo 'Could not find person! ' . $aPersonMessage->getMessage();

        //affiche le template profile en passant le message et la personne en paramtre
        Template::render("profile.tpl", array(
            'personMessage' => $aPersonMessage,
            'person' => $aPersonMessage->getContent()
        ));
    }
  
    


    //fonction qui affiche le template teamRoles
    public function teamRoles() {
        Template::render('teamRoles.tpl');
    }
    
    //fonction qui affiche toute les personnes
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
    
      //fonction qui affiche le template register
    public function register() {
    Template::render('register.tpl');}
    
    public function registerSubmit() {
        global $tedx_manager;
        $args = array(
            'name' => $_POST['firstname'],
            'firstname' => $_POST['lastname'],
            'dateOfBirth' => $_POST['dob_year'] . "-" . $_POST['dob_month'] . "-" . $_POST['dob_day'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'country' => $_POST['country'],
            'phoneNumber' => $_POST['telephone'],
            'email' => $_POST['email'],
            'idmember' => $_POST['username'],
            'password' => $_POST['password'],
        );

        $aRegisteredVisitor = $tedx_manager->registerVisitor($args);
        Template::flash($aRegisteredVisitor->getMessage());

        if ($aRegisteredVisitor->getStatus()) {
            Template::redirect("persons");
        } else {
            Template::redirect('register');
        }
    }
    
    public function locations() {
    Template::render('locations.tpl');}
    
    public function locationsSubmit() {
        global $tedx_manager;
        $args = array(
            'name' => $_POST['Name'],
            'direction' => $_POST['Direction'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'country' => $_POST['country'],
            
        );

        $aRegisteredVisitor = $tedx_manager->registerVisitor($args);
        Template::flash($aRegisteredVisitor->getMessage());

        if ($aRegisteredVisitor->getStatus()) {
            Template::redirect("persons");
        } else {
            Template::redirect('register');
        }
    }

    public function registerToAnEvent($eventId) {
        global $tedx_manager;
        if ($tedx_manager->isLogged()) {
            if($tedx_manager->isParticipant()){
              
               Template::flash("You are already participating on this event!"); 
                 Template::redirect("event/$eventId");
               
            }else{
            Template::render('registerToAnEvent.tpl');
            
            
            $event = $tedx_manager->getEvent($eventId)->getContent();
            Template::render('registerToAnEvent.tpl', array(
                'Event' => $event
            ));}
        } else {
            Template::render('register.tpl');
        }
    }

    public function registerToAnEventSubmit($eventId) {

        global $tedx_manager;
        $currentEvent = $tedx_manager->getEvent($eventId)->getContent();

        // RŽcupre le message contenant une personne loggŽe
        $messagePersonLogged = $tedx_manager->getLoggedPerson();
        $loggedPerson = "";
        // Si on a bien reu une personne, on la var_dump
        if ($messagePersonLogged->getStatus()) {
            $loggedPerson = $messagePersonLogged->getContent();
        }
        // Sinon affichage du message d'erreur
        else {
            echo $messagePersonLogged->getMessage();
        }


        $args1 = array(
            'person' => $loggedPerson, // object Person
            'event' => $tedx_manager->getEvent($eventId)->getContent(), // object Event
            //'slots' => $aListOfSlots, // List of objects Slot OPTIONNAL
            'type' => 'Presse', // String
            'typeDescription' => 'Redacteur chez Edipresse SA'
        );

        $messageRegisteredParticipant = $tedx_manager->registerToAnEvent($args1);
        $aRegisteredParticipant="";


        if ($messageRegisteredParticipant->getStatus()) {
            $aRegisteredParticipant = $messageRegisteredParticipant->getContent();
            echo 'Congrats! ' .  $messageRegisteredParticipant->getMessage();
        }
        else {
            Template::flash($messageRegisteredParticipant->getMessage());
            Template::render('registerToAnEvent.tpl');
        }
        
        
        $aMotivation = array(
            'text' => $_POST['motivation'],
            'event' => $tedx_manager->getEvent($eventId)->getContent(),
            'participant' => $aRegisteredParticipant
        );


        $aMotivationAddedToAnEvent = $tedx_manager->addMotivationToAnEvent($aMotivation);
        Template::flash( $messageRegisteredParticipant->getMessage());

        if ($messageRegisteredParticipant->getStatus()) {
            Template::redirect("persons");
        } else {
            Template::redirect('register');
        }

        if ($aMotivationAddedToAnEvent->getStatus())
            echo 'Congrats!' . $aMotivationAddedToAnEvent->getMessage();
        else
            echo 'Error!' . $aMotivationAddedToAnEvent->getMessage();


        // Args addKeywordsToAnEvent
        $args2 = array(
            'listOfValues' => array($_POST['keyword1'], $_POST['keyword2'], $_POST['keyword3']), //List of object values
            'person' => $aRegisteredParticipant, // object Person,
            'event' => $currentEvent // object Event
        );
        // Add keyword to an event
        $anAddedKeywords = $tedx_manager->addKeywordsToAnEvent($args2);

        // Message
        if ($anAddedKeywords->getStatus())
            echo 'Congrats!' . $anAddedKeywords->getMessage();
        else
            echo 'Error!' . $anAddedKeywords->getMessage();
    }
    

}

?>
