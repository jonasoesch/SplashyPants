{include '_header.tpl' title="Persons"}

<section>
<h2>Speakers</h2>
{foreach from=$speakers item=person}
	<div class="row event-slot">

		<h2 class="span4">
		 <a href="{$baseURL}/person/{$person->getNo()}">
		  {$person->getFirstName()} {$person->getName()}
		 </a>
		</h2>
		<p class="span4">{$person->getEmail()}</p>
	
		<div class="admin-bar span4">
			<a class="admin-link" href="{$baseURL}/person/{$person->getNo()}/edit">Edit</a>
		</div>
	</div> 	
{/foreach}
</section>

<section>
<h1>Organizers</h1>
{foreach from=$organizers item=person}
	<div class="row event-slot">

		<h2 class="span4">
		 <a href="{$baseURL}/person/{$person->getNo()}">
		  {$person->getNo()} {$person->getFirstName()} {$person->getName()}
		 </a>
		</h2>
		<p class="span4">{$person->getEmail()}</p>

		<div class="admin-bar span4">
			<a class="admin-link" href="{$baseURL}/person/{$person->getNo()}/edit">Edit</a>
		</div>

	</div> 	
{/foreach}
</section>
      
{include '_footer.tpl'}
