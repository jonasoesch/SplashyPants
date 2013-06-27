{include '_header.tpl' }
<div class="offset3">
<form action="allocateTeamRoles" method="post"> 
<select name="organizerSelect">
{foreach from=$organizers item=organizer}
  <option value={$organizer->getNo()}>{$organizer->getName()}</option>
 {/foreach}
</select>
<select name="roleSelect">
{foreach from=$roles item=role}
  <option value={$role->getName()}>{$role->getName()}</option>
 {/foreach}
</select>


</form>
</div>
<div class="row">
	 		<p class="span6 offset5">
	 			<input type="submit" />
	 		</p>
                </div>
{include '_footer.tpl'}