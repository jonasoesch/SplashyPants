<?php

require_once SPLASHY_DIR . "/helpers/ViewController.php";
require_once SPLASHY_DIR . "/helpers/Template.php";

class PersonView extends ViewController {

    public function showProfile($id) {
        global $tedx_manager;
        $aPersonMessage = $tedx_manager->getPerson($id);

        // Message
        if (!$aPersonMessage->getStatus())
            echo 'Could not find person! ' . $aPersonMessage->getMessage();


        Template::render("profile.tpl", array(
            'personMessage' => $aPersonMessage,
            'person' => $aPersonMessage->getContent()
        ));
    }

    
<<<<<<< HEAD
=======
    
    public function register() {
    	Template::render('register.tpl');
    }
    
    public function showAll() {
    	global $tedx_manager;
    	$persons = $tedx_manager->getPersons()->getContent();
    	Template::render('persons.tpl', array('persons' => $persons));
    }
    
    public function show($id) {
   		global $tedx_manager;
   		$person = $tedx_manager->getPerson($id)->getContent();
   		Template::render('profile.tpl', array(
   			'person' => $person
   		));
    }
    
    public function registerSubmit() {
    	$args = array(
    	    'name'        => $_POST['firstname'],
    	    'firstname'   => $_POST['lastname'],
    	    'dateOfBirth' => $_POST['dob_year']."-".$_POST['dob_month']."-".$_POST['dob_day'],
    	    'address'     => $_POST['address'],
    	    'city'        => $_POST['city'],
    	    'country'     => $_POST['country'],
    	    'phoneNumber' => $_POST['telephone'],
    	    'email'       => $_POST['email'],
    	    'idmember'    => $_POST['username'],
    	    'password'    => $_POST['password'],
    	);
    	
    	$aRegisteredVisitor = ASFree::registerVisitor( $args );
    	Template::flash($aRegisteredVisitor->getMessage());
    	
    	if($aRegisteredVisitor->getStatus()) {
    		Template::redirect("persons");
    	} else {
    		Template::redirect('register');
    	}
    }

>>>>>>> a9eb1f2bce5585bc593037d685f0291171c63e4e

}

?>
