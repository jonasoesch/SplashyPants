{include '_header.tpl'}

<section class="row">
            	<section class="span7">
                    	
                    	                    	
                 <article class="span11">
                 	<div class="row">
                 		<h3 class="span12 eventTitle">{$event->getMainTopic()}</h3>
                    	<p class="span12">{$event->getStartingDate()|date_format:"%d %B %Y"}</p>
                 	</div>
                 	<div class="row">
		                 <p class="span12">{$event->getDescription()}</p>
		             </div>
	                 <div class="row">
		                 <h4 class="span11">Program</h4>
		             </div>

	                 <div class="row">
		                 <p class="span3">Starting Time </p>
		                 <p class="span9">{$event->getStartingTime()}</p>
		             </div>
		             <div class="row">
		                 <p class="span3">Ending Time</p>
		                 <p class="span9">{$event->getEndingTime()}</p>
		             </div>

			      </article>

                 </section> 
            
                <section class="span5">
                
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
			        <form action="{$event->getNo()}/registerToAnEvent" method="get">
			        <p class="span5"><input type="Submit" name="submit" value="Participate" /></p>
			        </form>
			        </div>
                </section>
                
                
                
</section>
<h2>Speakers</h2>

<section>
 {foreach from=$slotsWithSpeakers item=slotData}
 	<article class="row event-slot">
 		{foreach from=$slotData key=key item=data}
 		{if $key == 'slotData'}
 				<div class="span4">
	 				<h3>Slot {$data->getNo()}</h3>
	 				<p>{$data->getHappeningDate()}</p>
				</div>

 		{else}
 			<figure class="span2">
				<img class="profil portrait" src="../public/images/speaker/{$data->getNo()}.jpg" />
				<p>
				<a href="/tedxEventManager/SplashyPants/person/{$data->getNo()}" >{$data->getFirstName()} {$data->getName()}</a>
				</p>
			</figure>
 			
 		{/if}
 	{/foreach}
 	</article>
 </section>
 {/foreach}




<?php include 'public/eventFooter.html'; ?>
{include "_footer.tpl"}
