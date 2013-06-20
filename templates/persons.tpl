{include '_header.tpl' }

{foreach from=$persons item=person}
	<div class="row event-slot">

		<h2 class="span4">{$person->getNo()} {$person->getFirstName()} {$person->getName()}</h2>
		<p class="span4">{$person->getEmail()}</p>
		<p class="span4">
			{$person->getDescription()}
		</p>
	
		<span class="admin-bar">
			<a class="edit" href="{$baseURL}/event/{$person->getNo()}/edit">Edit</a>
			<a class="edit" href="{$baseURL}/event/{$person->getNo()}/archive">Remove</a>
		</span>
	</div> 	
{/foreach}
      
{include '_footer.tpl'}
