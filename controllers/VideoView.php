<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");

class VideoView extends ViewController {
  
  
  // "Permet d'afficher le video wall"
  public function video() {
   	Template::render('video.tpl');
  }
  
 
}

?>
