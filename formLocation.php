<?php

if (isset($_POST['street']) && isset($_POST['stNumber']) && isset($_POST['code']) && isset($_POST['city']) ) { 
	$street = $_POST['street'];
	$stNumber = $_POST['stNumber']; 
	$code = $_POST['code']; 
	$city = $_POST['city'];    
	echo $_POST['street'];
	echo $_POST['stNumber'];
	echo $_POST['code'];
	echo $_POST['city'];
}  

else {
	
	  
}



?>
<form method="post" action="formLocation.php">


	                 <div class="row">

		                 <p class="span6"><input type="text" name="street" placeholder="Street" id="street"/></p>
		                 <p class="span1"><input type="text" name="stNumber" placeholder="n°" id="num" size="3"/></p>
		             </div>
	
	                 <div class="row">
		                 <p class="span6"><input type="text" name="additional" placeholder="additional information" id="additional"/></p>
		             </div>
		             <div class="row">
		             	<p class="span3"><input type="text" name="code" placeholder="Code" id="code" size="4"/></p>
		                <p class="span6"><input type="text" name="city" placeholder="City" id="city"/></p>
		             </div>
			<input type="submit" value="Verify Location" />
</form>


