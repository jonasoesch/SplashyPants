
{include '_header.tpl'}
{include 'eventWithoutSlot.tpl'}
<h2>Speakers</h2>

<form action="{$baseURL}/event/{$event->getNo()}/slot/{$slot->getNo()}/submitModifiedSlot" method="post" >
 	<div class="row event-slot">
 				<div class="span4">
	 				<h3>Slot</h3>
  

	 			<div class="row">
	       	 			<p class="span12">
							{if isset($slot)}{assign var='slotDate' value='-'|explode:$slot->getHappeningDate()}{/if}
							<input type="text" name="slot_dob_day" placeholder="DD" size="2" maxlength="2" {if isset($slot)}value="{$slotDate[2]}"{/if} /> / 
							<input type="text" name="slot_dob_month" placeholder="MM"  size="2" maxlength="2" {if isset($slot)}value="{$slotDate[1]}"{/if} /> /

	  						
	  						<input type="text" name="slot_dob_year" placeholder="YYYY" size="4"
	  						maxlength="4" {if isset($slot)}value="{$slotDate[0]}"{/if}
	  						/>

	  					</p>
		        </div>
	 				
	 			<div class=" row">
	            	<p class="span12">Starting Time</p>
	            </div>
		        <div class="row">
					<p class="span12">
						<input type="text" name="slot_hob" placeholder="17:00" size="5"
						{if isset($slot)}value="{$slot->getStartingTime()}"{/if}
						/>
						
					</p>
			    </div>
	
				<div class="row">
	            	<p class="span12">Ending Time</p>
	            </div>
		        
		        <div class="row">
					<p class="span12">
						<input type="text" name="slot_hoe" placeholder="17:00" size="5"
						{if isset($slot)}value="{$slot->getEndingTime()}"{/if}

						/>
					</p>
			    </div>

	 			</div>

 				
	 		{foreach from=$someSpeakers key=keySpeaker item=speaker}
 
 			<figure class="span2">
				<img class="profil portrait" src="{$baseURL}/public/images/speaker/{$speaker->getNo()}.jpg" />
				<p>
				<a href="/tedxEventManager/SplashyPants/person/{$speaker->getNo()}">{$speaker->getFirstName()} {$speaker->getName()}</a>
				</p>
			</figure>
			
 			{/foreach}
 		

 	
 	</div>


	
	<div class="row"> 
         	<p class="span6"> 
           <input type="Submit" />  
           </p> 
		</div>
</form>


{include "_footer.tpl"}