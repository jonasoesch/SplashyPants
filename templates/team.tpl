{include "_header.tpl" title="Our team"}

<h1>The people who shape TEDx</h1>
{assign var=val value=1}
{foreach from=$organizers item=organizer}    
	<div class="row module">

		<figure class="span1" >
		  <a href="{$baseURL}/person/{$organizer->getNo()}">
	  		<img src="{$baseURL}/public/images/clot.jpg" alt="jerome" class="portrait-small" />
		  </a>
	 </figure>
	  	
	<h2 class="span10 offset1">
	  <a href="{$baseURL}/person/{$organizer->getNo()}">
      <span class="firstname">{$organizer->getFirstName()}</span>
      <span class="name">{$organizer->getName()}</span>
	  </a>
	</h2>
  <h3 class="span10 offset1 subtitle-fat">
    {foreach from=$roles[$organizer@index] item=role}
      {$role->getName()}{if !$role@last} | {/if}
    {/foreach}
  </h3>
	<p class="offset1 span7">{$organizer->getDescription()}</p>
  <p class="span3"><a href="mailto:{$organizer->getEmail()}" class="link">{$organizer->getEmail()}</a></p>
 </div>

{/foreach}
      
{include "_footer.tpl"}
