{include "_header.tpl" title="Register with TEDx"}
<link href="{$baseURL}/public/css/profile.css" rel="stylesheet" />
<h1>Participant</h1>
<form 
	{if $mode == "edit"} action="{$baseURL}/person/{$person->getNo()}/edit"
		{else} action="{$baseURL}/register"{/if}
		method="post">
		
{include "_personForm.tpl"}


	 <div class="row">
	 		<p class="span3 offset9">
	 			<input type="submit" name="validate" />
	 		</p>
	 </div>

	 	 </div>
</div>

</form>

{include "_footer.tpl"}

 