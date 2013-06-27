
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
		<form>

 		
 			
 			<div span="9">
				<p class="span2">

					<select>
 								<option value="{$idSpeaker}" selected>{} {}</option>

			  					{foreach from=$someSpeakers item=speaker}	
			  						{if $speaker->getNo()!= $data->getNo()}		  
			  						<option value="{$speaker->getNo()}">{$speaker->getFirstName()} {$speaker->getName()} </option>
			  						{/if}
							  	{/foreach}
					</select>
				Add a speaker
								<pre>
 								{var_dump($someSpeakers)}
								</pre>

					<select>
 								<option value="{$speaker->getNo()}" selected>{$speaker->getFirstName()} {$speaker->getName()}</option>
			  					{foreach from=$speakers item=data}	
			  						{if $speaker->getNo()!= $data->getNo()}		  
			  						<option value="{$data->getNo()}">{$data->getFirstName()} {$data->getName()} </option>
			  						{/if}
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