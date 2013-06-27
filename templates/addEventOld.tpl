{include '_header.tpl' title="Add an Event"}
<scriptsrc="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">

</script>
<form action="{$baseURL}/addEvent" method="post">
<div class="row">
            	<div class="span7">
                   <div class="span11">
                 	<div class="row">
	       	 			<p class="span6 eventTitle">
							<input type="text" name="mainTopic" placeholder="Title" size="70"
							{if isset($event)}value="{$event->getMainTopic()}"{/if}
							/>
						</p>
                 	</div>
                 	<div class="row">
                 		<p class="span12">Starting Date</p>
                 	</div>
	                 <div class="row">
	       	 			<p class="span6">
							{if isset($event)}{assign var='startingDate' value='-'|explode:$event->getStartingDate()}{/if}
							<input type="text" name="event_dob_day" placeholder="DD" size="2" maxlength="2" {if isset($event)}value="{$startingDate[2]}"{/if} /> / 
							<input type="text" name="event_dob_month" placeholder="MM"  size="2" maxlength="2" {if isset($event)}value="{$startingDate[1]}"{/if} /> /

	  						
	  						<input type="text" name="event_dob_year" placeholder="YYYY" size="4"
	  						maxlength="4" {if isset($event)}value="{$startingDate[0]}"{/if}
	  						/>

	  					</p>
		             </div>
		             <div class="row">
		                 <p class="span3"><input type="text" name="event_hob" placeholder="17:00" size="5"
		                 {if isset($event)}value="{$event->getStartingTime()}"{/if}
		                 /></p>
		             </div>
		             <div class="row">
                 		<p class="span12">Ending Date</p>
                 	</div>
		             <div class="row">
	       	 				       	 			<p class="span6">
							{if isset($event)}{assign var='endingDate' value='-'|explode:$event->getEndingDate()}{/if}
							<input type="text" name="event_doe_day" placeholder="DD" size="2" maxlength="2" {if isset($event)}value="{$endingDate[2]}"{/if} /> / 
							<input type="text" name="event_doe_month" placeholder="MM"  size="2" maxlength="2" {if isset($event)}value="{$endingDate[1]}"{/if} /> /

	  						
	  						<input type="text" name="event_doe_year" placeholder="YYYY" size="4"
	  						maxlength="4" {if isset($event)}value="{$endingDate[0]}"{/if}
	  						/>

	  					</p>
		             </div>
		             <div class="row">
		                 <p class="span3"><input type="text" name="event_hoe" placeholder="21:00" size="5"
					     {if isset($event)}value="{$event->getEndingTime()}"{/if}
					     /></p>
		             </div>
		             <div class="row">
		             	<p class="span6">
		             		<TEXTAREA name="description" placeholder="Enter a description" cols="70"
		             		>{if isset($event)}{$event->getDescription()}{/if}</TEXTAREA>
		                </p>
		             </div>

	  	
			      </div>
                 </div> 
            
               <div class="span5">
               		<div class="row">
	                	<p class="address" span="12">
	                		<input type="text" name="locationName1" placeholder="Name" size="35" maxlength="25" /><br />
				  			<input type="text" name="address" placeholder="Address" size="35" maxlength="25" /><br />
				  			<input type="text" name="zipcode" placeholder="Zipcode" size="5" maxlength="5" />
				  			<input type="text" name="city" placeholder="City" size="22" maxlength="25" /> <br />
				  			<input type="text" name="country" placeholder="Country" size="20" maxlength="25" />
		  				</p>        
		  			</div>
		  			<div class="row">
		  				<p span="12">Existing Location</p>
		  					<select name="locationName2">
			  					{foreach from=$someLocations item=alocation}	
			  											  
			  						<option name="locationName" value="{$alocation->getName()}">{$alocation->getName()}</option>
							  	{/foreach}
							</select>
		  			</div>
	  			</div> 
                
                
                
</div>

<h2>Speakers</h2>


	<div class="row event-slot">
		<div class="span3">
			<h3>Slot One</h3>
				<div class="row">
	            	<p class="span12">Date</p>
	            </div>
	            
		        <div class="row">
	       	 			<p class="span12">
							{if isset($slotsWithSpeakers)}{assign var='slotDate' value='-'|explode:$slotsWithSpeakers->getStartingDate()}{/if}
							<input type="text" name="slot_dob_day" placeholder="DD" size="2" maxlength="2" {if isset($slot)}value="{$slotDate[2]}"{/if} /> / 
							<input type="text" name="slot_dob_month" placeholder="MM"  size="2" maxlength="2" {if isset($event)}value="{$slotDate[1]}"{/if} /> /

	  						
	  						<input type="text" name="slot_dob_year" placeholder="YYYY" size="4"
	  						maxlength="4" {if isset($event)}value="{$slotDate[0]}"{/if}
	  						/>

	  					</p>
		        </div>
		        
		        <div class="row">
	            	<p class="span12">Starting Time</p>
	            </div>
		        <div class="row">
					<p class="span12">
						<input type="text" name="slot_hob" placeholder="17:00" size="5"/>
					</p>
			    </div>
	
				<div class="row">
	            	<p class="span12">Ending Time</p>
	            </div>
		        
		        <div class="row">
					<p class="span12">
						<input type="text" name="slot_hoe" placeholder="17:00" size="5"/>
					</p>
			    </div>
		</div>

		<div span="9">
			<div class="row">
				<p class="span3">
				Select a speaker
				<select>
			  					{foreach from=$speakers item=speaker}	
			  											  
			  						<option value="{$speaker->getNo()}">{$speaker->getFirstName()} {$speaker->getName()} </option>
							  	{/foreach}
				</select>
				</p>
				
				<p class="span3">
				Select a speaker
				<select>
			  					{foreach from=$speakers item=speaker}	
			  											  
			  						<option value="{$speaker->getNo()}">{$speaker->getFirstName()} {$speaker->getName()} </option>
							  	{/foreach}
				</select>
				</p>
			</div>
		</div>
	</div>
	<div class="row"> 
         	<p class="span6"> 
           <input type="Submit" />  
           </p> 
		</div>
</form>


{include "_footer.tpl"}