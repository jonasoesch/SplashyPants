{include "_header.tpl"}
<link href="{$baseURL}/public/css/profile.css" rel="stylesheet" />
<div class="row">
	<p class="span4 offset1"><a href="">Curators and hosts</a></p>
	<p class="span4 offset1"><a href="">Design team</a></p>
	<p class="span4 offset1"><a href="">External communications team</a></p>
	<p class="span4 offset1"><a href="">Fundraising & finance team</a></p>
	<p class="span4 offset1"><a href="">Hospitality & events team</a></p>
	<p class="span4 offset1"><a href="">Speakers selection team</a></p>
	<p class="span4 offset1"><a href="">Quality & sustainability team</a></p>
</div>

 {foreach from=$organizers item=organizer}

	<div class="row event-slot">

		<figure class="span2" >
	  		<img src="{$baseURL}/public/images/clot.jpg" alt="jerome" class="portrait" />
	  	</figure>
	  	
	  	<h1 class="span9 offset1">
                    <span class="prenom">{$organizer->getFirstName()}</span>
	  	  <span class="nom">{$organizer->getName()}</span>
	  	  <span class="role">(Bitches coordinator)</span>
               
	  	</h1>
	  	<p class="span9 offset1 ">{$organizer->getDescription()}</p><br />
		<p class="span9 offset1 "><a href="mailto:{$organizer->getEmail()}">{$organizer->getEmail()}</a></p>
     </div>

                        {/foreach}
      
{include "_footer.tpl"}
