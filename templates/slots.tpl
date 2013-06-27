<section>
 {foreach from=$slotsWithSpeakers key=keySlot item=slotData}
 	<article class="row event-slot">
 		{foreach from=$slotData key=key item=data}
 		{if $key == 'slotData'}
 				<div class="span3">
	 				<h3><h3>Slot {$keySlot+1}</h3></h3>
	 				<p>{if isset($data)}{assign var='slotDate' value='-'|explode:$data->getHappeningDate()}{/if}
	 					{if isset($data)}{$slotDate[2]}{/if}.
	 					{if isset($data)}{$slotDate[1]}{/if}.
	 					{if isset($data)}{$slotDate[0]}{/if}
					</p>
					<p class="offset0">{$data->getStartingTime()|regex_replace:"/(\d\d:\d\d):\d\d/":"$1" }
					 - {$data->getEndingTime()|regex_replace:"/(\d\d:\d\d):\d\d/":"$1" }
					</p>
					<p>
					<a href="{$baseURL}/event/{$event->getNo()}/editSlot/{$data->getNo()}">edit slot</a>
					</p>
				</div>
				{assign var='slotNo' value=$data->getNo()}
 		{else}
 			<figure class="span3">
				<img class="profil portrait" src="{$baseURL}/public/images/speaker/{$data->getNo()}.jpg" />
				<p>
				<a href="/tedxEventManager/SplashyPants/person/{$data->getNo()}" >{$data->getFirstName()} {$data->getName()}</a>
				</p>

			</figure>
 			
 		{/if}
 		
 	{/foreach}
 	<p>
				<a href="/tedxEventManager/SplashyPants/event/{$event->getNo()}/Slot/{$slotNo}/addSpeaker" >add speaker</a>
	</p>
 	</article>
 	
 </section>
 {/foreach}