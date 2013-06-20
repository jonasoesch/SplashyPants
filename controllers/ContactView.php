<?php

require_once SPLASHY_DIR."/helpers/ViewController.php";
require_once SPLASHY_DIR."/helpers/Template.php";

class ContactView extends ViewController {
  
  
  // ""
  public function index() {
   	Template::render('home.tpl');
  }
  
  // "contact"
  public function contact() {
  	Template::render('contact.tpl');
  }
  
  
}

?>
