{include "_header.tpl"}
<link href="{$baseURL}/public/css/profile.css" rel="stylesheet" />
<h1 class="offset3">Organizer</h1>
<form
	{if $mode == "edit"} action="{$baseURL}/person/{$person->getNo()}/edit"
		{else} action="{$baseURL}/register/organizer"{/if}
		method="post">
		
{include "_personForm.tpl"}

<div class="row">
  <h3 class="span3">Description</h3>
  <textarea name="description" placeholder="Description" cols="50" rows="50" class="span8">{if isset($person)}{$person->getDescription()}{/if}</textarea>
</div>

	 <div class="row">
	 		<p class="span3 offset9">
	 			<input type="submit" name="validate" />
	 		</p>
	 </div>

	 	 </div>
</div>

</form>

{include "_footer.tpl"}

 