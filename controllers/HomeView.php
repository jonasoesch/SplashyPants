<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");

class HomeView extends ViewController {
  
  
  // ""
  public function index() {
    global $tedx_manager;
    //get some talks for the aside part
    $someTalks=$tedx_manager->getTalks()->getContent();

    $arraySpeakerTalks = array();

    foreach ($someTalks as $aTalk) {
      $idSpeaker = $aTalk->getSpeakerPersonNo();
      $messageGetPerson = $tedx_manager->getSpeaker($idSpeaker);
      if($messageGetPerson->getStatus()){
        $speaker = $messageGetPerson->getContent();
        //$array_push($arraySpeakerTalks, $speaker);
        $arraySpeakerTalks[] = array(
          'talk' => $aTalk,
          'speaker' => $speaker);
        //var_dump($speaker);
        
      }else{
        Template::flash('Could not find speaker ' . $messageGetPerson->getMessage());
      }

    }
    
    $theLastEvent = EventView::getLatestEvent();

   	Template::render('home.tpl', array(
      'event' => $theLastEvent,
      'arraySpeakerTalks' => $arraySpeakerTalks));
  }
  
  public function hey($event, $contact) {
  	var_dump($event);
  	var_dump($contact);
  }
  
  
    public function admin() {
        global $tedx_manager;
        if ($tedx_manager->isAdministrator()|| $tedx_manager->isSuperAdmin() || $tedx_manager->isOrganizer()){
        Template::render('admin.tpl');
        
        }
        else{
            index();
        }
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
  		
  		$personMsg = $tedx_manager->getLoggedPerson();
  		if($personMsg->getStatus()) { 
  		  Template::redirect("person/".$personMsg->getContent()->getNo());
  		} else { 
  		  Template::redirect(''); 
  		}
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
