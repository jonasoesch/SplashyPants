<?php

// ---------- Errors ----------------
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();


// ---------- Smarty Config ----------
require('/usr/local/lib/php/Smarty/Smarty.class.php');
require 'Slim/Extras/Views/Smarty.php';



\Slim\Extras\Views\Smarty::$smartyDirectory = '/usr/local/lib/php/Smarty';
\Slim\Extras\Views\Smarty::$smartyCompileDirectory = 'templates/templates_c';
\Slim\Extras\Views\Smarty::$smartyCacheDirectory = 'templates/caches';


// Instantiate application
$app = new \Slim\Slim(array(
		'mode' => 'development',
		'debug' => true,
    'view' => new \Slim\Extras\Views\Smarty()
));


$app->get('/hi/:id', function ($id) use ($app) {
    $app->render('home.tpl');
});


$app->run();
/*



// ---------- Setup ----------
$baseURL = "/tedXEventManager/SplashyPants/";
$uri = str_replace($baseURL, "", $_SERVER["REQUEST_URI"]);



echo "Je fonctionne<br/>";

// ---------- Helpers ----------
function path($regex) {
	$match = false;
	
	
	$regex = preg_replace("/:\w+/", "\\w+", $regex);
	$regex = str_replace("/", "\/", $regex);
	
	echo $regex."<br />";
	
	if(preg_match("/".$regex."$/i", $_SERVER["REQUEST_URI"]) == 1) {
		$match = true;
	}

	
	return $match;
}


function dispatch($template, $args=array()) {}


// Maps parts of an url to keys given in the pattern
// Ex.
// $pattern = /events/:eventId
// $url			= /events/3
// =>	array("eventId" => "3");
function parseURL($pattern, $url){
	$urlParts = explode("/", $url);
	$patternParts = explode("/", $pattern);
	
	
	$mapping = array();
	if(count($urlParts) == count($patternParts)) {
		foreach ($patternParts as $num => $patternPart) {
			if(preg_match("/:\w+/", $patternPart) == 1) {
				$mapping[$patternPart] = $urlParts[$num];
			}
		}
	}
	return $mapping;
}

// ---------- Smarty General ----------
//$smarty->assign("baseURL", $baseURL);


/*
 ---------- URLs ---------- 

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



/*
if(path("login")) {
	$smarty->display('login.tpl');
	die();
}

if(path("login/submit")) {
	$smarty->display('profile.tpl');
	die();
}

if(path("events/:eventId")) {
	$arr = parseURL("events/:eventId", $uri);
	echo print_r($arr);
	die();
}

if(path("events/:eventId/slots/:slotId/person/:personId")) {
	echo "Added a Slot";
	die();
}

else {
	$smarty->display('home.tpl');
	die();
}
*/

?>
