<?php include 'header.php' ?>
<link href="css/profile.css" rel="stylesheet" />

<form action="register.php" method="post"> 
<div class="row profile-details">
	  <figure class="span2 offset1" >
	  	<img src="images/profile.jpeg" alt="cristo" class="portrait" />
	  </figure>
	  

	  	<h1 class="offset4">
	  	  <span class="prenom">
	  	  	<input type="text" name="firstname" placeholder="First name" size="20" maxlength="25" />
	  	  </span>
	  	  <span class="nom">
	  	  	<input type="text" name="lastname" placeholder="Last name" size="20" maxlength="25" />
	  	  </span>
	  	</h1>
	  
	  <div class="offset1 span8 contact profile-table">
			
			<div class="row">
	  		<p class="span6 email">
	  			<input type="text" name="email" placeholder="E-Mail" size="20" maxlength="100" />
	  		</p>
	  		<p class="span6 phone">
	  			<input type="text" name="telephone" placeholder="Telephone" size="20" maxlength="25" />
	  		</p>
	  	</div>
	  	
	  	<div class="row">
	  		<p class="span6 address">
	  			<input type="text" name="address" placeholder="Address" size="30" maxlength="25" /><br />
	  			<input type="text" name="zipcode" placeholder="Zipcode" size="5" maxlength="5" />
	  			<input type="text" name="city" placeholder="City" size="20" maxlength="25" /> <br />
	  			<input type="text" name="country" placeholder="Country" size="20" maxlength="25" />
	  		</p>
	  		<p class="span6 birthday">
	  			<input type="text" name="dob_year" placeholder="<?php echo "YYYY"; ?>" size="4" maxlength="4" />  /
	  			<input type="text" name="dob_monat" placeholder="<?php echo "MM"; ?>"  size="2" maxlength="2" /> /
	  			<input type="text" name="dob_day" placeholder="<?php echo "DD"; ?>" size="2" maxlength="2" />
	  		</p>
	  	</div>
	  	
	 
	 <div class="row">
	 	<p class="span6">
	 		<input type="password" name="password" placeholder="Password" />
	 	</p>
	 	<p class="span6">
	 		<input type="submit" class="offset2" />
	 	</p>
	 </div>
	 	 </div>
</div>

</form>

<?php include 'footer.php' ?>
