<?php

require_once SPLASHY_DIR."/helpers/ViewController.php";
require_once SPLASHY_DIR."/helpers/Template.php";

class EventView extends ViewController {
  
  
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
			'eventTitle' => 'Schnaby il rigole pas',
			'eventStart' => '28.06.2013',
			'eventEnd' => '28.06.2013',
			'description' => 'Our inspired team, in collaboration with TEDxLausanne, is pleased to announce TEDxLausanneChange 2013. This event, themed “positive disruption”, will feature a live stream of the main TEDxChange program in Seattle, Washington and three presentations by dynamic local speakers. Join us for an event that will challenge preconceived ideas, spark discussion, engage leaders and shed light on new perspectives.',
			'street' => 'Ch. du Moleson',
			'code' => '1077',
			'city' => 'Servion',
			'country' => 'Suisse'
		));
	}
	
	  // "login/do"
  public function event() {
  	Template::render('event.tpl');
  }
}

?>
