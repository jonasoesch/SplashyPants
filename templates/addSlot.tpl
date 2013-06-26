
{include '_header.tpl'}
{include 'eventWithoutSlot.tpl'}
<h2>Speakers</h2>
{include 'slots.tpl'}

<form>
	{foreach from=$slotsWithSpeakers key=keySlot item=slotData}
 	<div class="row event-slot">
 		{foreach from=$slotData key=keySpeaker item=data}
 		{if $keySpeaker == 'slotData'}
 				<div class="span4">
	 				<h3><h3>Slot {$keySlot+1}</h3></h3>
	 				<input type="hidden" name="slotNumber" size="2" maxlength="2" {if isset($data)}value="{$slotDate[2]}"{/if} /> / 

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
 			<div span="9">
				<p class="span2">
				Select a speaker

					<select>
 								<option value="{$data->getNo()}" selected>{$data->getFirstName()} {$data->getName()}</option>

			  					{foreach from=$someSpeakers item=speaker}	
			  						{if $speaker->getNo()!= $data->getNo()}		  
			  						<option value="{$speaker->getNo()}">{$speaker->getFirstName()} {$speaker->getName()} </option>
			  						{/if}
							  	{/foreach}
					</select>
				</p>
			</div>
 
 			
 		{/if}
 	{/foreach}
 	<div span="9">
				<p class="span2">
				Select a speaker

					<select>
								
								<option value="none">---</option>
			  					{foreach from=$someSpeakers item=speaker}	
			  						{if $speaker->getNo()!= $data->getNo()}		  
			  						<option value="{$speaker->getNo()}">{$speaker->getFirstName()} {$speaker->getName()} </option>
			  						{/if}
							  	{/foreach}
					</select>
				</p>
			</div>
 	
 	</div>
 {/foreach}


	
	<div class="row"> 
         	<p class="span6"> 
           <input type="Submit" />  
           </p> 
		</div>
</form>


{include "_footer.tpl"}