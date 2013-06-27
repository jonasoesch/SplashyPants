{include '_header.tpl' }
<form action="allocateTeamRoles" method="post"> 
<div class="offset3">

<select name="organizerSelect">
{foreach from=$organizers item=organizer}
  <option value={$organizer->getNo()}>{$organizer->getName()} {$organizer->getFirstname()}</option>
 {/foreach}
</select>
<select name="roleSelect">
{foreach from=$roles item=role}
  <option value={$role->getName()}>{$role->getName()}</option>
 {/foreach}
</select>



</div>
<div class="row">
	 		<p class="span6 offset5">
	 			<input type="submit" />
	 		</p>
                </div>
</form>
{include '_footer.tpl'}