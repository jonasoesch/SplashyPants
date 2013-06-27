{include '_header.tpl' }

                        
<section>
	<h1 class="span12">Create Location</h1>
	<form action="{$baseURL}/locations" method="post"> 
		  	<div class="row">
		  		<p class="span6 offset 5 address">
		  			<input type="text" name="name" placeholder="Name" size="30" maxlength="25" /><br />
		  			<input type="text" name="direction" placeholder="Direction" size="30" maxlength="5" />
	                <input type="text" name="address" placeholder="Address" size="30" maxlength="30" />
		  			<input type="text" name="city" placeholder="City" size="30" maxlength="25" /> <br />
		  			<input type="text" name="country" placeholder="Country" size="20" maxlength="25" />
		  		</p>
		  	</div>
		  	
	        <div class="row">
		 		<p class="span6 offset6"><input type="submit"/></p>
	        </div>
	</form>
</section>

{include '_footer.tpl'}
