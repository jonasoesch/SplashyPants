<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");

class PartnersView extends ViewController {
  
  
  // ""
  public function index() {
   	Template::render('home.tpl');
  }
  
   // "partners"
  public function partners() {
    Template::render('partners.tpl');
  }

   
  
  
}

?>
