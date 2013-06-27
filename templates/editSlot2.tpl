
{include '_header.tpl'}
{include 'eventWithoutSlot.tpl'}
<h2>Speakers</h2>

<form>
	{$slot->getNo()}
 	<div class="row event-slot">
 		{foreach from=$slotsWithSpeakers[$slot->getNo()] key=keySpeaker item=data}
 		
 		{if $keySpeaker == 'slotData'}
 				<div class="span4">
	 				<h3>Slot</h3>
	 				<input type="hidden" name="slotNumber" size="2" maxlength="2" {if isset($data)}value="{$slotDate[2]}"{/if} />  

	 			<div class="row">
	       	 			<p class="span12">
							{if isset($data)}{assign var='slotDate' value='-'|explode:$data->getHappeningDate()}{/if}
							<input type="text" name="slot_dob_day" placeholder="DD" size="2" maxlength="2" {if isset($data)}value="{$slotDate[2]}"{/if} /> / 
							<input type="text" name="slot_dob_month" placeholder="MM"  size="2" maxlength="2" {if isset($event)}value="{$slotDate[1]}"{/if} /> /

	  						
	  						<input type="text" name="slot_dob_year" placeholder="YYYY" size="4"
	  						maxlength="4" {if isset($data)}value="{$slotDate[0]}"{/if}
	  						/>

	  					</p>
		        </div>
	 				
	 			<div class=" row">
	            	<p class="span12">Starting Time</p>
	            </div>
		        <div class="row">
					<p class="span12">
						<input type="text" name="slot_hob" placeholder="17:00" size="5"
						{if isset($data)}value="{$data->getStartingTime()}"{/if}
						/>
						
					</p>
			    </div>
	
				<div class="row">
	            	<p class="span12">Ending Time</p>
	            </div>
		        
		        <div class="row">
					<p class="span12">
						<input type="text" name="slot_hoe" placeholder="17:00" size="5"
						{if isset($data)}value="{$data->getEndingTime()}"{/if}

						/>
					</p>
			    </div>

	 			</div>

 				{else}

 			<figure class="span3">
				<img class="profil portrait" src="{$baseURL}/public/images/speaker/{$data->getNo()}.jpg" />
				<p>
				<a href="/tedxEventManager/SplashyPants/person/{$data->getNo()}" >{$data->getFirstName()} {$data->getName()}</a>
				</p>
			</figure>
 			
 		{/if}
 	{/foreach}

 	
 	</div>


	
	<div class="row"> 
         	<p class="span6"> 
           <input type="Submit" />  
           </p> 
		</div>
</form>


{include "_footer.tpl"}