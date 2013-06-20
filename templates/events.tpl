{include '_header.tpl' }


{foreach from=$events item=event}
	<div class="row event-slot">

		<h2 class="span4">{$event->getMainTopic()}</h2>
		<p class="span4">{$event->getDescription()}</p>
		<p class="span4">
			{$event->getStartingDate()} – {$event->getEndingDate()}
		</p>
	
		<span>
			<a class="edit" href="{$baseURL}/event/{$event->getNo()}/edit">Edit</a>
		</span>
	</div> 	
{/foreach}
      
{include '_footer.tpl'}
