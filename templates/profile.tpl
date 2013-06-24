{include '_header.tpl'}
<link href="css/profile.css" rel="stylesheet" />


<div class="row profile-details">

	  <figure class="span2 offset1" >
	  	<img src="images/profile.jpeg" alt="cristo" class="portrait" />
	  </figure>
	  

	  	<h1 class="offset1">
	  	  <span class="prenom">{$person->getFirstName()}</span>
	  	  <span class="nom">{$person->getName()}</span>
	  	  
	  	  
	  	  {if $tedx->isGranted('changeProfil')->getContent()}
	  	 	 <a href="{$baseURL}/person/{$person->getNo()}/edit">Edit</a>
	  	 	{else}
					<a href="{$baseURL}/person/{$person->getNo()}/edit">Edit</a>
	  	  {/if}
	  	</h1>
	  
	  <div class="offset1 span8 contact profile-table">
			
			<div class="row">
	  		<p class="span6 email">{$person->getEmail()}</p>
	  		<p class="span6 phone">{$person->getPhoneNumber()}</p>
	  	</div>
	  	
	  	<div class="row">
	  		<p class="span6 address">{$person->getAddress()}<br />
	  		{$person->getCity()}<br />
                        {$person->getCountry()}
	  		</p>
	  		<p class="span6 birthday">{$person->getDateOfBirth()}</p><br />
                        
                       
	  	</div>
	  	
	 </div>
	 
</div>
                
<!--
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

<div class="profile-event">
	<h2>TEDx du 11.9.2010</h2>
	<div class="row">
		<h3 class="span4">Registration Status</h3>
		<p class="span8 declined">Declined</p>
	</div>

<div class="row">
  <h3 class="span4">Motivation</h3>
  <p class="span8">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo.
  </p>
</div>

<div class="row">
  <h3 class="span4">Keywords</h3>
  <ul class="span8">
    <li class="pill">Cowboys</li>
    <li class="pill">Pipe Smoking</li>
  </ul>
</div>
-->

{include '_footer.tpl'}
