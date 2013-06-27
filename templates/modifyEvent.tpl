
{include '_header.tpl'}
<h1 class="span12">Edit Event</h1>
<form action="{$baseURL}/event/{$event->getNo()}/submitModifiedEvent" method="post">
<div class="row">
    <h1 class="span6">
      <label for="mainTopic">Title</label>
				<input type="text" name="mainTopic" placeholder="Change in …" size="50"
				{if isset($event)}value="{$event->getMainTopic()}"{/if}
				/>
    </h1>
    
    <p class="span6">
    <label for="locationName">Location</label>
    <select name="locationName2">
					<option name="locationName" value="{$location->getName()}" selected>{$location->getName()}</option>
					{foreach from=$someLocations item=alocation}
						{if $alocation->getName()!=$location->getName()}	
						<option name="locationName" value="{$alocation->getName()}">{$alocation->getName()}</option>
						{/if}
						
			  	{/foreach}
     </select>
    </p>
</div>
    
<div class="row">
    <p class="span3">
      <label for="event_dob_year">Starting Date</label>
      {if isset($event)}{assign var='startingDate' value='-'|explode:$event->getStartingDate()}{/if}
			<input type="text" name="event_dob_day" placeholder="DD" size="2" maxlength="2" {if isset($event)}value="{$startingDate[2]}"{/if} /> .
			<input type="text" name="event_dob_month" placeholder="MM"  size="2" maxlength="2" {if isset($event)}value="{$startingDate[1]}"{/if} /> .
			<input type="text" name="event_dob_year" placeholder="YYYY" size="4"
					maxlength="4" {if isset($event)}value="{$startingDate[0]}"{/if}
		</p>
		
		<p class="span3">
      <label for="event_hob">Starting Time</label>
      <input type="text" name="event_hob" placeholder="17:00" size="5"
      {if isset($event)}value="{$event->getStartingTime()}"{/if}
      />
  </p>
</div>

<div class="row">
    <p class="span3">
      <label for="event_doe_year">Ending Date</label>
      {if isset($event)}{assign var='endingDate' value='-'|explode:$event->getEndingDate()}{/if}
				<input type="text" name="event_doe_day" placeholder="DD" size="2" maxlength="2" {if isset($event)}value="{$endingDate[2]}"{/if} /> . 
				<input type="text" name="event_doe_month" placeholder="MM"  size="2" maxlength="2" {if isset($event)}value="{$endingDate[1]}"{/if} /> .
				<input type="text" name="event_doe_year" placeholder="YYYY" size="4"
					maxlength="4" {if isset($event)}value="{$endingDate[0]}"{/if}
					/>
    </p>
    
    <p class="span3">
      <label for="event_hoe">Ending Time</label>
      <input type="text" name="event_hoe" placeholder="21:00" size="5"
		     {if isset($event)}value="{$event->getEndingTime()}"{/if}
		     />
    </p>
</div>

<div class="row">
  <p class="span6">
    <label for="description">Description</label>
    <textarea  name="description" placeholder="Enter a description" cols="50">
      {if isset($event)}{$event->getDescription()}{/if}
    </textarea>
  </p>
          
  <p class="span3"> 
    <input type="Submit" />  
    </p> 
</div>

</form>


{include "_footer.tpl"}