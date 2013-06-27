<div class="row">
            	<div class="span7">
				
                    	                    	
                 <div class="span11">
                 	<div class="row">
                 		<h3 class="span11 eventTitle">{$event->getMainTopic()}</h3>
                 		 {if $canEdit}
                 		 <p class="span1">
					 	 <a href="{$baseURL}/event/{$event->getNo()}/modify">Edit</a>
					 	 </p>
						
						{/if}
                    	<p class="span12">{$event->getStartingDate()}</p>
                 	</div>
	                 <div class="row">
		                 <h4 class="span11">Program</h4>
		             </div>
		             <div class="row">
		                 <p class="span12">{$event->getDescription()}</p>
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

                </div>
                
                
                
</div>
