<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");

class AboutView extends ViewController {
  
  
  // ""
  public function index() {
   	Template::render('home.tpl');
  }
  
  // "TEDx"
  public function tedx() {
  	Template::render('aboutTEDx.tpl');
  }
  
   // "TED"
  public function ted() {
    Template::render('aboutTED.tpl');
  }
  
  
  
}

?>
