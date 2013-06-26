{include "_header.tpl"}
<link href="{$baseURL}/public/css/profile.css" rel="stylesheet" />
<!--<div class="row">
    foreach from=$roles item=role}        
	<p class="span4 offset1"><a href="">$role[0]->getName()}</a></p>
         /foreach}
</div>-->

{assign var=val value=1}
 {foreach from=$organizers item=organizer}
    
	<div class="row event-slot">

		<figure class="span2" >
	  		<img src="{$baseURL}/public/images/clot.jpg" alt="jerome" class="portrait" />
	  	</figure>
	  	
	  	<h1 class="span8 offset2">
                    <span class="prenom">{$organizer->getFirstName()}</span>
	  	  <span class="nom">{$organizer->getName()}</span>
	  	  </h1>
                  <h4 class="span8 offset2">
                  <span class="role"> (
                   {foreach from=$roles[$organizer@index] item=role}
                  {$role->getName()}
                  {/foreach}
                  )</span>
	  	</h4>
	  	<p class="span8 offset2 ">{$organizer->getDescription()}</p><br />
		<p class="span8 offset2 "><a href="mailto:{$organizer->getEmail()}">{$organizer->getEmail()}</a></p>
     </div>

                        {/foreach}
      
{include "_footer.tpl"}
