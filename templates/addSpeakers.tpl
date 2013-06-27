
{include '_header.tpl'}
{include 'eventWithoutSlot.tpl'}
<h2>Speakers</h2>

		<article class="row event-slot">
 				<div class="span3">
	 				<h3><h3>Slot </h3></h3>
	 				<p>{if isset($slot)}{assign var='slotDate' value='-'|explode:$slot->getHappeningDate()}{/if}
	 					{if isset($slot)}{$slotDate[2]}{/if}.
	 					{if isset($slot)}{$slotDate[1]}{/if}.
	 					{if isset($slot)}{$slotDate[0]}{/if}
					</p>
					<p class="offset0">{$slot->getStartingTime()|regex_replace:"/(\d\d:\d\d):\d\d/":"$1" }
					 - {$slot->getEndingTime()|regex_replace:"/(\d\d:\d\d):\d\d/":"$1" }
					</p>

				</div>
				
		<form action="{$baseURL}/event/{$event->getNo()}/Slot/{$slot->getNo()}/addSpeaker" method="post">

 		
 			
 			<div span="9">
								<p class="span2">
				Select a speaker

					<select name="speakerNo">

			  					{foreach from=$someSpeakers item=speaker}	
			  						<option value="{$speaker->getNo()}">{$speaker->getFirstName()} {$speaker->getName()} </option>
							  	{/foreach}
					</select>
				</p>
			</div>
 
 			




	
	<div class="row"> 
         	<p class="span6"> 
           <input type="Submit" />  
           </p> 
		</div>
</form>


{include "_footer.tpl"}