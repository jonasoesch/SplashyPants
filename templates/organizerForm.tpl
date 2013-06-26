{include "_header.tpl"}
<link href="{$baseURL}/public/css/profile.css" rel="stylesheet" />
<h1>Organizer</h1>
<form
	{if $mode == "edit"} action="{$baseURL}/person/{$person->getNo()}/edit"
		{else} action="{$baseURL}/register/organizer"{/if}
		method="post">
		
{include "_personForm.tpl"}

<div class="row">
  <textarea name="description" placeholder="Description" cols="50" rows="10">{if isset($person)}{$person->getDescription()}{/if}</textarea>
</div>

{if !isset($personId) && ($mode != "edit")}
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

 