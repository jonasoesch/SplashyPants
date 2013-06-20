<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");

class TeamView extends ViewController {
  
  
   // "Team"
  public function team() {
        global $tedx_manager;

        $someOrganizers = $tedx_manager->getOrganizers();
        $aOrganizerMessage="";
        // Message
        if ($someOrganizers->getStatus())
            echo 'Congrats! ' . $someOrganizers->getMessage();
        else
            echo 'Error! ' . $someOrganizers->getMessage();
        $organizers = Array();
        foreach ($someOrganizers as $organizer) {
            $aOrganizerMessage = $tedx_manager->getOrganizer($organizer->getId());
            // Message
            if (!$aOrganizerMessage->getStatus())
                echo 'Could not find person! '. $aOrganizerMessage->getMessage();
            else
                $organizers->add($tedx_manager->getOrganizer($organizer->getId()));
        }
 
        Template::render("team.tpl", array(
            'organizerMessage' => $aOrganizerMessage,
            'organizers' => $organizers
        ));
    }

    

   
  
  
}

?>
