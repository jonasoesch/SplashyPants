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



	<div class="row event-slot">

		<figure class="span2" >
	  		<img src="{$baseURL}/public/images/clot.jpg" alt="jerome" class="portrait" />
	  	</figure>
	  	
	  	<h1 class="span9 offset1">
                    <span class="prenom">{$person->getFirstName()}</span>
	  	  <span class="nom">{$person->getName()}</span>
	  	  <span class="role">(Bitches coordinator)</span>
	  	</h1>
	  	<p class="span9 offset1 ">role<br />
		<a href="mailto:{$person->getEmail()}">{$person->getEmail()}</a></p>
     </div>


      
{include "_footer.tpl"}
