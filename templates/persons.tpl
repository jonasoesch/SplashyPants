{include '_header.tpl' title="Persons"}


<h2>Speakers</h2>
{foreach from=$speakers item=person}
	<div class="row event-slot">

		<h2 class="span4">
		 <a href="{$baseURL}/person/{$person->getNo()}">
		  {$person->getNo()} {$person->getFirstName()} {$person->getName()}
		 </a>
		</h2>
		<p class="span4">{$person->getEmail()}</p>
		<p class="span4">
			{$person->getDescription()}
		</p>
	
		<span class="admin-bar">
			<a class="edit" href="{$baseURL}/person/{$person->getNo()}/edit">Edit</a>
		</span>
	</div> 	
{/foreach}

<h2>Organizers</h2>
{foreach from=$organizers item=person}
	<div class="row event-slot">

		<h2 class="span4">
		 <a href="{$baseURL}/person/{$person->getNo()}">
		  {$person->getNo()} {$person->getFirstName()} {$person->getName()}
		 </a>
		</h2>
		<p class="span4">{$person->getEmail()}</p>
		<p class="span4">
			{$person->getDescription()}
		</p>

			<a class="admin-link span1" href="{$baseURL}/person/{$person->getNo()}/edit">Edit</a>

	</div> 	
{/foreach}
      
{include '_footer.tpl'}
