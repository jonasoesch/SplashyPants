<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");

class TeamView extends ViewController {
  
  
   // "Team"
  public function team() {
    Template::render('team.tpl');
  }

   
  
  
}

?>
