<section>
 {foreach from=$slotsWithSpeakers key=keySlot item=slotData}
 	<article class="row event-slot">
 		{foreach from=$slotData key=key item=data}
 		{if $key == 'slotData'}
 				<div class="span3">
 				 <h3>
					   {$data->getStartingTime()|regex_replace:"/(\d\d:\d\d):\d\d/":"$1" }
					 – {$data->getEndingTime()|regex_replace:"/(\d\d:\d\d):\d\d/":"$1" }
					</h3>
	 				<h4 class="subtitle">
  	 				 {if $slotData@index == 0}1st
  	 				 {elseif $slotData@index == 1}2nd
  	 				 {elseif $slotData@index == 2}3rd	 				 
  	 				 {else}{$slotData@index}th
  	 				 {/if}Slot
	 				</h4>
	 				<p>{$data->getHappeningDate()|date_format:"%d. %B %Y"}</p>

					{if $canEdit}
					<p>
					  <a href="{$baseURL}/event/{$event->getNo()}/editSlot/{$data->getNo()}" class="admin-link">Edit Slot</a>
					</p>
					{/if}
				</div>
				{assign var='slotNo' value=$data->getNo()}
 		{else}
 			<figure class="span3">
				<img class="profil portrait-small" src="{$baseURL}/public/images/speaker/{$data->getNo()}.jpg" />
				<p>
				<a href="/tedxEventManager/SplashyPants/person/{$data->getNo()}" >{$data->getFirstName()} {$data->getName()}</a>
				</p>

			</figure>
 			
 		{/if}
 		
 	{/foreach}
 	{if $canEdit}
 	<p>
				<a href="/tedxEventManager/SplashyPants/event/{$event->getNo()}/Slot/{$slotNo}/addSpeaker" class="admin-link">Add Speaker</a>
	</p>
	{/if}
 	</article>
 	
 </section>
 {/foreach}
 {if $canEdit}
  <div class="row module">
    <p><a href="{$baseURL}/event/{$event->getNo()}/addSlot" class="admin-link">Add a Slot</a></p>
  </div>
{/if}