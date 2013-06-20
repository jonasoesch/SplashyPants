<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");

class RegisterView extends ViewController {
  
  
  // "Permet la page d'inscription"
  public function register() {
   	Template::render('register.tpl');
  }
  
 
}

?>
