<div class="row profile-details">
	  <figure class="span2 offset1" >
	  	<img src="{$baseURL}/public/images/profile.jpeg" alt="cristo" class="portrait" />
	  </figure>
	  

	  	<h1 class="offset4">
	  	  <span class="prenom">
	  	  	<input type="text" name="firstname" placeholder="First name" size="20" maxlength="25" 
	  	  	{if isset($person)}value="{$person->getFirstName()}"{/if}
	  	  	/>
	  	  </span>
	  	  <span class="nom">
	  	  	<input type="text" name="lastname" placeholder="Last name" size="20" maxlength="25" 
	  	  	{if isset($person)}value="{$person->getName()}"{/if}
	  	  	/>
	  	  </span>
	  	</h1>
	  
	  <div class="offset1 span8 contact profile-table">
			
			<div class="row">
	  		<p class="span6 email">
	  			<input type="text" name="email" placeholder="E-Mail" size="30" maxlength="100" 
	  			{if isset($person)}value="{$person->getEmail()}"{/if}
	  			/>
	  		</p>
	  		<p class="span6 phone">
	  			<input type="text" name="telephone" placeholder="Telephone" size="20" maxlength="25" 
	  			{if isset($person)}value="{$person->getPhoneNumber()}"{/if}
	  			/>
	  		</p>
	  	</div>
	  	
	  	<div class="row">
	  		<p class="span6 address">
	  			<input type="text" name="address" placeholder="Address" size="30" maxlength="25" 
	  				{if isset($person)}value="{$person->getAddress()}"{/if}
	  			/><br />
	  			<input type="text" name="city" placeholder="City" size="20" maxlength="25" 
	  				{if isset($person)}value="{$person->getCity()}"{/if}
	  			/> <br />
	  			<input type="text" name="country" placeholder="Country" size="20" maxlength="25" 
	  				{if isset($person)}value="{$person->getCountry()}"{/if}
	  			/>
	  		</p>
	  		<p class="span6 birthday">
	  			{if isset($person)}{assign var='date' value='-'|explode:$person->getDateOfBirth()}{/if}
	  			<input type="text" name="dob_day" placeholder="DD" size="2" maxlength="2" 
	  				{if isset($person)}value="{$date[2]}"{/if}
	  			/>
	  			<input type="text" name="dob_month" placeholder="MM"  size="2" maxlength="2" 
	  				{if isset($person)}value="{$date[1]}"{/if}
	  			/> 
	  			<input type="text" name="dob_year" placeholder="YYYY" size="4" maxlength="4" 
	  				{if isset($person)}value="{$date[0]}"{/if}
	  			/>  
	  		</p>
	  	</div>
	  </div>
</div>