<?php

// ---------- Setup ----------

require_once('../tedx-config.php');


// ---------- Errors ----------------
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once(SPLASHY_DIR.'/lib/router.php');
require_once(SPLASHY_DIR.'/controllers/Home.php');

$r = new Router();


/* ---------- Routes ---------- */

$r->map("", 
				"Home::index");

$r->map("login", 
				"Home::login");
				
$r->map("login/do",
				"Home::loginDo");
				
$r->map("persons/:id",
				"Home::showPerson");




$r->run();


/* ---------- URLs ---------- 

-	(nothing)
- do
- add
- validate
- update
- remove

/partners
/contact
/about
/about/ted
/about/tedx
/team

/videos
/videos/1

/events
/events/add

/events/1
/events/1/edit
/events/1/remove
/events/1/subscribe
/events/1/subscribe/do


/events/1/slots/add
/events/1/slots/edit
/events/1/slots/remove

/events/1/slots/2/person/6/add
/events/1/slots/2/person/6/remove

/subscribe
/subscribe/do

/login
/login/do



/persons
/persons/add

/persons/1
/persons/1/edit
/persons/1/remove

/persons/1/validate (toujours pour current event)


*/


?>
