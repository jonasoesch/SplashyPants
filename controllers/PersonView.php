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

}

?>
