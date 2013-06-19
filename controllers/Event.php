<?php

require_once SPLASHY_DIR."/helpers/ViewController.php";
require_once SPLASHY_DIR."/helpers/Template.php";

class Event extends ViewController {
  
  
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
  	Template::render('home.tpl');
  }

	public function show($id) {
		Template::render('event.tpl', array(
			'debug' => 'Hello Debug',
			'id' => $id
		));
	}
}

?>