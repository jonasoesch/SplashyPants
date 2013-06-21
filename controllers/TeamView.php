<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");

class TeamView extends ViewController {
  
  
   // "Team"
  public function team() {
        global $tedx_manager;

        $someOrganizers = $tedx_manager->getOrganizers();
        $someOrganizers=$someOrganizers->getContent();
        $aOrganizerMessage="";
        $roles=array();
        // Message
       
        
        if ($someOrganizers->getStatus())
            echo 'Congrats! ' . $someOrganizers->getMessage();
        else
            echo 'Error! ' . $someOrganizers->getMessage();
        
        foreach($someOrganizers as $organizer){
        $roles = array_push(getRolesByOrganizer($organizer)->getContent());
        }
        var_dump( $roles);
        Template::render("team.tpl", array(
            'organizerMessage' => $aOrganizerMessage,
            'organizers' => $someOrganizers,
                'roles' => $roles
        ));
    }

    

   
  
  
}

?>
