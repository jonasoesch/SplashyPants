{include "_header.tpl"}
<link href="{$baseURL}/public/css/profile.css" rel="stylesheet" />
<h1>Speaker</h1>
<form 
	{if isset($personId)} action="{$baseURL}/person/{$personId}/edit"
		{else} action="{$baseURL}/register"{/if}
		method="post">
		
{include "_personForm.tpl"}

<div class="row">
  <textarea name="description" placeholder="Description" cols="50" rows="10"
  {if isset($person)}value="{$person->getDescription()}"{/if} 
  ></textarea>
</div>

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
	 			<input type="submit" />
	 		</p>
	 </div>

	 	 </div>
</div>

</form>

{include "_footer.tpl"}

 