<?php

require_once(SPLASHY_DIR."/helpers/ViewController.php");
require_once(SPLASHY_DIR."/helpers/Template.php");


/**
* HomeView does the retrieval, treatment and display of pages
* who are not in relation with any special object
**/
class HomeView extends ViewController {
  
  
  /*
  * Displays the Homepage
  */
  public function index() {
    global $tedx_manager;
    //get some talks for the aside part
    $someTalks=$tedx_manager->getTalks()->getContent();

    $arraySpeakerTalks = array();
    if(!isset($someTalks)) {$someTalks;}

    foreach ($someTalks as $aTalk) {
      $idSpeaker = $aTalk->getSpeakerPersonNo();
      $messageGetPerson = $tedx_manager->getSpeaker($idSpeaker);
      if($messageGetPerson->getStatus()){
        $speaker = $messageGetPerson->getContent();
        
        $arraySpeakerTalks[] = array(
          'talk' => $aTalk,
          'speaker' => $speaker);
      
        
      }else{
        Template::flash('Could not find speaker ' . $messageGetPerson->getMessage());
      }

    }
    
    $theLastEvent = EventView::getLatestEvent();

   	Template::render('home.tpl', array(
      'event' => $theLastEvent,
      'arraySpeakerTalks' => $arraySpeakerTalks));
  }
  

  /*
  * Displays the page which collects common administration functionnality
  * but only when the visitor has the proper rights.
  * Otherwise it redirects to the homepage
  */
  public function admin() {
        global $tedx_manager;
        if ($tedx_manager->isAdministrator()|| $tedx_manager->isSuperAdmin() || $tedx_manager->isOrganizer()){
        Template::render('admin.tpl');
        
        }
        else{
          Template::redirect('');
        }
  }
  
  
  /*
  * Displays the Login form
  */  
  public function login() {
  	Template::render('login.tpl');
  }
  
  /*
  * Executes the login with the data it receives from the login form
  * If the login was successfuk it displays the persons profile (or to the homepage in case of an error)
  * otherwise it re-displays the login form
  */
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
  
  /*
  * Executes the logout process and redirects to the homepage
  */
  public function logout() {
  	global $tedx_manager;
  	$message = $tedx_manager->logout();
  	Template::flash("logout");
  	Template::redirect('');
  }
  
  /*
  * Displays the about TED-Page
  */
  public function about() {
    Template::render('about.tpl');
  }
  
  
  /*
  * Displays the contact form
  * (not implemented)
  */
  public function contact() {
  	Template::render('contact.tpl');
  }
  
  /*
  * Displays the partners page
  */
  public function partners() {
    Template::render('partners.tpl');
  }
  
  
}

?>
