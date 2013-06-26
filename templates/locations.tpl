{include '_header.tpl' }

                        

<form action="locations" method="post"> 
	  
	
	  	
	  	<div class="row">
	  		<p class="span6 address">
	  			<input type="text" name="name" placeholder="Name" size="30" maxlength="25" /><br />
	  			<input type="text" name="direction" placeholder="Direction" size="5" maxlength="5" />
                                <input type="text" name="address" placeholder="Address" size="5" maxlength="5" />
	  			<input type="text" name="city" placeholder="City" size="20" maxlength="25" /> <br />
	  			<input type="text" name="country" placeholder="Country" size="20" maxlength="25" />
	  		</p>

	  	</div>
	  	
                <div class="row">
	 		<p class="span6 offset6">
	 			<input type="submit" />
	 		</p>
                </div>



</form>


{include '_footer.tpl'}
