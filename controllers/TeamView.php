<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");

class TeamView extends ViewController {
  
  
   // "Team"
  public function team() {
        global $tedx_manager;

        $someOrganizers = $tedx_manager->getOrganizers();
        
        $aOrganizerMessage="";
        $roles=array();
        // Message
       
        
        if ($someOrganizers->getStatus()){
        $someOrganizers->getMessage();}
        else{
        echo 'Error! ' . $someOrganizers->getMessage();}
        
        $someOrganizers=$someOrganizers->getContent();
        foreach($someOrganizers as $organizer){
            
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
