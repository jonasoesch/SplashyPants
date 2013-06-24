<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");

class VideoView extends ViewController {
  
  
  // "Permet d'afficher le video wall"
  public function video() {
   	Template::render('video.tpl');
  }

  public function videoDescription($event, $speaker) {
   	
        
           global $tedx_manager;
           $messageGetTalk = $tedx_manager->getTalk();
           
           if($messageGetTalk->getStatus()) {
               
               $aTalk = $messageGetTalk->getContent();
               
           }
           else{
               Template::flash('could not find any video in the DB'.$messageGetTalk);
           }
           var_dump($aTalk);
           
           Template::render('videoDescription.tpl', array (
               'talk' => $aTalk));
          
       }
  
}

?>
