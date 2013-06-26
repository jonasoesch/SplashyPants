{include "_header.tpl"}
<link href="{$baseURL}/public/css/profile.css" rel="stylesheet" />
<h1>Participant</h1>
<form 
	{if $mode == "edit"} action="{$baseURL}/person/{$person->getNo()}/edit"
		{else} action="{$baseURL}/register"{/if}
		method="post">
		
{include "_personForm.tpl"}

{if !isset($personId)}
	 <div class="row">
		 <p class="span6">
		 	<input type="text" name="username" placeholder="Username" />
		 </p>
	 	<p class="span6">
	 		<input type="password" name="password" placeholder="Password" />
	 	</p>
	 </div>
{/if}
	 <div class="row">
	 		<p class="span6 offset6">
	 			<input type="submit" name="validate"value="validate" />
	 		</p>
	 </div>

	 	 </div>
</div>

</form>

{include "_footer.tpl"}

 