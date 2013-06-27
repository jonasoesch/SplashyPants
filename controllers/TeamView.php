<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");

class TeamView extends ViewController {
  
  
   /**
    * this function gets the organizers and their roles from the
    * $tedxclass and sends it to the team template
    * @global type $tedx_manager
    */
  public function team() {
        global $tedx_manager;

        $someOrganizers = $tedx_manager->getOrganizers();
        
        $aOrganizerMessage="";
        $roles=array();
        // flashes the message if the operation was successful or not
        Template::flash($someOrganizers->getMessage());
        
        $someOrganizers=$someOrganizers->getContent();
        foreach($someOrganizers as $organizer){
            //for each organizer, put its roles in the array $roles
        array_push($roles ,$tedx_manager->getRolesByOrganizer($organizer)->getContent());
        }
        
        Template::render("team.tpl", array(
            'organizerMessage' => $aOrganizerMessage,
            'organizers' => $someOrganizers,
                'roles' => $roles
        ));
    }

    

   
  
  
}

?>
