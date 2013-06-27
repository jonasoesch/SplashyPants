
{include '_header.tpl'}
{include 'eventWithoutSlot.tpl'}
<h2>Speakers</h2>

		<article class="row event-slot">
 				<div class="span3">
	 				<h3>
  	 				{$slot->getStartingTime()|regex_replace:"/(\d\d:\d\d):\d\d/":"$1" }
					 - {$slot->getEndingTime()|regex_replace:"/(\d\d:\d\d):\d\d/":"$1" }
	 				</h3>
	 				<p>Slot</p>
					<p class="subtitle">
					  {$slot->getHappeningDate()|date_format:"%d. %B %Y"}
					</p>

				</div>
				
				
<form action="{$baseURL}/event/{$event->getNo()}/Slot/{$slot->getNo()}/addSpeaker" method="post">

 		<div class="span3">
				<label for="speakerNo">Select a speaker</label>
					<select name="speakerNo">

			  					{foreach from=$someSpeakers item=speaker}	
			  						<option value="{$speaker->getNo()}">{$speaker->getFirstName()} {$speaker->getName()} </option>
							  	{/foreach}
					</select>
					
			</div>
 	
	<div class="row"> 
         	<p class="span3"> 
           <input type="Submit" value="Add" />  
           </p> 
		</div>
</form>


{include "_footer.tpl"}