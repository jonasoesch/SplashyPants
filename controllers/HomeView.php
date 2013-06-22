<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");

class HomeView extends ViewController {
  
  
  // ""
  public function index() {
   	Template::render('home.tpl');
  }
  
  public function hey($event, $contact) {
  	var_dump($event);
  	var_dump($contact);
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
  		Template::flash("Login successful");
  		Template::redirect('');
  	} else {
  		Template::flash("Wrong password or username");
  		Template::redirect('login');
  	}
  }
  
  // "logout"
  public function logout() {
  	global $tedx_manager;
  	$message = $tedx_manager->logout();
  	Template::flash("logout");
  	Template::redirect('');
  }
  
  // "about"
  public function about() {
    Template::render('about.tpl');
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
