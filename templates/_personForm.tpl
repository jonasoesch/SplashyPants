<div class="row profile-details">
	  <figure class="span2" >
	  	<img src="{$baseURL}/public/images/profile.jpeg" alt="cristo" class="portrait-big" />
	  </figure>
	  

	  	  <div class="prenom offset1 span4">
	  	    <label for="firstname">First name</label>
	  	  	<input type="text" name="firstname" placeholder="Edward" size="20" maxlength="25" 
	  	  	{if isset($person)}value="{$person->getFirstName()}"{/if}
	  	  	/>
	  	  </div>
	  	  <div class="nom span5">
	  	    <label for="lastname">Last name</label>
	  	  	<input type="text" name="lastname" placeholder="Teach" size="20" maxlength="25" 
	  	  	{if isset($person)}value="{$person->getName()}"{/if}
	  	  	/>
	  	  </div>
	  	</h1>
	  
	  <div class="offset1 span8 contact profile-table">
			
			<div class="row">
	  		<p class="span6 email">
	  		  <label for="email">E-Mail</label>
	  			<input type="text" name="email" placeholder="teach@blackbeard.com" size="30" maxlength="100" 
	  			{if isset($person)}value="{$person->getEmail()}"{/if}
	  			/>
	  		</p>
	  		<p class="span6 phone">
	  		  <label for="phone">Phone</label>
	  			<input type="text" name="telephone" placeholder="+411234567 " size="20" maxlength="25" 
	  			{if isset($person)}value="{$person->getPhoneNumber()}"{/if}
	  			/>
	  		</p>
	  	</div>
	  	
	  	<div class="row">
	  		<p class="span6 address">
	  		  <label for="address">Address</label>
	  			<input type="text" name="address" placeholder="Beafort Av. 17" size="30" maxlength="25" 
	  				{if isset($person)}value="{$person->getAddress()}"{/if}
	  			/><br />
	  			<label for="city">City</label>
	  			<input type="text" name="city" placeholder="Ocracoke" size="20" maxlength="25" 
	  				{if isset($person)}value="{$person->getCity()}"{/if}
	  			/> <br />
	  			<label for="country">Country</label>
	  			<input type="text" name="country" placeholder="Switzerland" size="20" maxlength="25" 
	  				{if isset($person)}value="{$person->getCountry()}"{/if}
	  			/>
	  		</p>
	  		<p class="span6 birthday">
	  		  <label for="dob_year">Date of birth</label>
	  			{if isset($person)}{assign var='date' value='-'|explode:$person->getDateOfBirth()}{/if}
	  			<input type="text" name="dob_day" placeholder="22" size="2" maxlength="2" 
	  				{if isset($person)}value="{$date[2]}"{/if}
	  			/>
	  			<input type="text" name="dob_month" placeholder="11"  size="2" maxlength="2" 
	  				{if isset($person)}value="{$date[1]}"{/if}
	  			/> 
	  			<input type="text" name="dob_year" placeholder="1718" size="4" maxlength="4" 
	  				{if isset($person)}value="{$date[0]}"{/if}
	  			/>  
	  		</p>
	  	</div>
	  </div>
</div>

{if !isset($personId) && ($mode != "edit")}
	 <div class="row">
		 <p class="offset3 span3">
		  <label for="username">Username</label>
		 	<input type="text" name="username" placeholder="SplashyPants" />
		 </p>
	 	<p class="span3">
	 	   <label for="password">Password</label>
	 		<input type="password" name="password" placeholder="Top secret" />
	 	</p>
	 </div>
{/if}