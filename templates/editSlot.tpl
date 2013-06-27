
{include '_header.tpl'}
{include 'eventWithoutSlot.tpl'}
<h2>Speakers</h2>

<div class="row module">
  

  <form action="{$baseURL}/event/{$event->getNo()}/slot/{$slot->getNo()}/submitModifiedSlot" method="post" class="span4 no-margin">
  	<h3>Slot</h3>
  <p>
    <label for="slot_dob_year">Date</label>
			{if isset($slot)}{assign var='slotDate' value='-'|explode:$slot->getHappeningDate()}{/if}
			<input type="text" name="slot_dob_day" placeholder="DD" size="2" maxlength="2" {if isset($slot)}value="{$slotDate[2]}"{/if} /> .
			<input type="text" name="slot_dob_month" placeholder="MM"  size="2" maxlength="2" {if isset($slot)}value="{$slotDate[1]}"{/if} /> .
			<input type="text" name="slot_dob_year" placeholder="YYYY" size="4"
				maxlength="4" {if isset($slot)}value="{$slotDate[0]}"{/if}
			/>
			
			<label for="slot_hob">Starting Time</label>
      <input type="text" name="slot_hob" placeholder="17:00" size="5"
				{if isset($slot)}value="{$slot->getStartingTime()}"{/if}
        />
        
      <label for="slot_hoe">Ending Time</label>
      <input type="text" name="slot_hoe" placeholder="17:00" size="5"
				{if isset($slot)}value="{$slot->getEndingTime()}"{/if}
      />
  </p>
   <input type="Submit" /> 
  </form>
  
  {if $someSpeakers!=false}
  
  {foreach from=$someSpeakers key=keySpeaker item=speaker}

   <figure class="span2">
		  <img class="profil portrait-small" src="{$baseURL}/public/images/speaker/{rand(1,3)}.jpg" />
      <p>
        <a href="{$baseURL}/{$speaker->getNo()}">{$speaker->getFirstName()} {$speaker->getName()}</a>
      </p>
	</figure>
	
{/foreach}
 {/if}

</div>
	 				


 		
</div>

{include "_footer.tpl"}