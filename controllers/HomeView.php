<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");

class HomeView extends ViewController {
  
  
  // ""
  public function index() {
   	Template::render('home.tpl');
  }
  
  
  // "login"
  public function login() {
  	Template::render('login.tpl');
  }
  
  // "login/do"
  public function loginDo() {
  	global $tedx_manager;
  	
  	$message = $tedx_manager->login( $_POST['username'], $_POST['password'] );
  	
  	if($message->getStatus()) {
  		Template::flash("Login success!!!");
  		Template::redirect('');
  	} else {
  		Template::flash("Login fail!!!");
  		Template::redirect('login');
  	}
  }
  
  // "logout"
  public function logout() {

  	global $tedx_manager;
  	$message = $tedx_manager->logout();
  	Template::redirect('');
  }
  
  
 // "TEDxLausanne"
  public function tedxLausanne() {
    Template::render('aboutTEDxLausanne.tpl');
  }

  // "TEDx"
  public function tedx() {
  	Template::render('aboutTEDx.tpl');
  }
  
   // "TED"
  public function ted() {
    Template::render('aboutTED.tpl');
  }
  
  
  // "contact"
  public function contact() {
  	Template::render('contact.tpl');
  }
  
  // "partners"
  public function partners() {
    Template::render('partners.tpl');
  }
  
}

?>
