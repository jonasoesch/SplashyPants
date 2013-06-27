{include '_header.tpl' title=$person->getFirstName()|cat:" "|cat:$person->getName()}
<link href="css/profile.css" rel="stylesheet" />


<div class="row profile-details">

	  <figure class="span2" >
	  	<img src="{$baseURL}/public/images/profile.jpeg" alt="cristo" class="portrait-big" />
	  </figure>
	  

	  	<h1 class="offset1 span9">
	  	  <span class="prenom">{$person->getFirstName()}</span>
	  	  <span class="nom">{$person->getName()}</span>
	  	  
	  	  {if $canEdit}
	  	 	 <a href="{$baseURL}/person/{$person->getNo()}/edit" class="admin-link">Edit</a>
	  	  {/if}
	  	</h1>
	  	
	  	{if count($roles) != 0}
	  	<h2 class="offset1 span9 subtitle-fat">
  	  	{foreach from=$roles item=role}{$role->getName()}{if !$role@last} | {/if}{/foreach}
	  	</h2>
	  	{/if}
	  
	  <div class="offset1 span9 contact profile-table">
			
			<div class="row">
	  		<p class="span6 email">
	  		  <a href="mailto:{$person->getEmail()}">{$person->getEmail()}</a></p>
	  		<p class="span6 phone">{$person->getPhoneNumber()}</p>
	  	</div>
	  	
	  	<div class="row">
	  		<p class="span6 address">{$person->getAddress()}<br />
	  		{$person->getCity()}<br />
                        {$person->getCountry()}
	  		</p>
	  		<p class="span6 birthday">{$person->getDateOfBirth()|date_format:"%d. %B %Y"}</p><br />
                        
                       
	  	</div>
	  	
	 </div>
	 
</div>

{if $person->getDescription() != ""}
<div class="row module">
  <h3 class="span3">About {$person->getFirstName()}</h3>
  <p class="span8">{$person->getDescription()}</p>
</div>
{/if}

{if count($talks) != 0}
<section class="row module">
  <h3 class="span3">{$person->getFirstName()} at TEDx</h3>
 {foreach from=$talks item=aTalk}
    <figure class="span3">
            <a href="{$baseURL}/videoDescription/event/{$aTalk->getEventNo()}/speaker/{$aTalk->getSpeakerPersonNo()}">
              <img src="{$baseURL}/public/images/Thumbnails/{$aTalk->getVideoTitle()}.png" width="225"/>
            </a>   
            <p class="subtitle">{$aTalk->getVideoTitle()}</p>   
    </figure>
  {/foreach}
</section>
{/if}
                
{*
<div class="profile-event">
	<h2>TEDx du 21.5.2011</h2>
	<div class="row">
		<h3 class="span4">Registration Status</h3>
		<p class="span8 accepted">Accepted</p>
	</div>

<div class="row">
  <h3 class="span4">Motivation</h3>
  <p class="span8">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.
  </p>
</div>

<div class="row">
  <h3 class="span4">Keywords</h3>
  <ul class="span8">
    <li class="pill">Piscines</li>
    <li class="pill">Baguette</li>
    <li class="pill">90ties Music</li>
  </ul>
</div>
*}
{include '_footer.tpl'}
