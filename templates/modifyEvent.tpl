
{include '_header.tpl'}
<form action="{$baseURL}/event/{$event->getNo()}/submitModifiedEvent" method="post">
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
		  				<p span="12">Existing Location</p>
		  					<select name="locationName2">
		  						<option name="locationName" value="{$location->getName()}" selected>{$location->getName()}</option>
			  					{foreach from=$someLocations item=alocation}
			  						{if $alocation->getName()!=$location->getName()}	
			  						<option name="locationName" value="{$alocation->getName()}">{$alocation->getName()}</option>
			  						{/if}
			  						
							  	{/foreach}
							</select>
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