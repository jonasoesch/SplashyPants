{include "_header.tpl"}
<link href="{$baseURL}/public/css/profile.css" rel="stylesheet" />

<form action="registerToAnEvent" method="post"> 
<div class="row profile-details">
	  

	  	
	  	  
	  	
			<div class="row">
	  		<span class="offset4">
	  			<textarea name="motivation" cols="50" rows="60">Tell us why do you want to participate?</textarea>
	  		</span>
	  		
	  	</div>
	  	<div class="row">
                    
	  	  <span class="offset4">
	  	  	<input type="text" name="keyword1" placeholder="keyword" size="11" maxlength="25" />
                        <input type="text" name="keyword2" placeholder="keyword" size="11" maxlength="25" />
                        <input type="text" name="keyword3" placeholder="keyword" size="11" maxlength="25" />
                        
	  	  </span>
	  	  
	  
	 <div class="row">
	 		<span class="offset5">
	 			<input type="submit" />
	 		</span>
	 </div>

	 	 </div>
</div>

</form>

{include "_footer.tpl"}

 