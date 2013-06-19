<?php

require SPLASHY_DIR."/helpers/ViewController.php";
require SPLASHY_DIR."/helpers/Template.php";

class Home extends ViewController {
  
  
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

	public function showPerson($id) {
		var_dump($_REQUEST);
		echo $id;
	}
}

?>