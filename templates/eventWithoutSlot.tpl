<div class="row">
            	<div class="span7">
                    	
                    	                    	
                 <div class="span11">
                 	<div class="row">
                 		<h3 class="span12 eventTitle">{$event->getMainTopic()}</h3>
                    	<p class="span12">{$event->getStartingDate()}</p>
                 	</div>
	                 <div class="row">
		                 <h4 class="span11">Program</h4>
		             </div>
		             <div class="row">
		                 <p class="span12">{$event->getDescription()}</p>
		             </div>
	                 <div class="row">
		                 <p class="span3">17:00</p>
		                 <p class="span9">Registration</p>
		             </div>
		             <div class="row">
		                 <p class="span3">17:30</p>
		                 <p class="span9">The Event</p>
		             </div>
		             <div class="row">
		                 <p class="span9 offset3">Welcome and introduction</p>
		             </div>
		             <div class="row"> 
		                 <p class="span9 offset3">Live presentations</p>
		             </div>

		             
		             <div class="row">
		                 <p class="span3">19:30</p>
		                 <p class="span9">Apéro</p>
		             </div>
	  	
		                 
	  	
			      </div>

                 </div> 
            
                <div class="span5">
                
                	<?php
$street="av des sports 10";
$code="1400";
$city="yverdon";
$country="suisse";

?>
<iframe width="332" height="332" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="{$baseURL}/public/map.php?street={$location->getAddress()}&city={$location->getCity()}&country={$location->getCountry()}"></iframe>

                	<div class="row">
			                 <p class="span12">{$location->getName()}<br />{$location->getAddress()}<br />{$location->getCity()}<br />{$location->getCountry()}</p>
			                 
			        </div>
			        <div class="row">
			        <form action="register.php" method="post">
			        <p class="span5"><input type="Submit" name="submit" value="Participate" /></p>
			        </form>
			        </div>
                </div>
                
                
                
</div>
