{include '_header.tpl' }

<form action="allocateTeamRoles" method="post"> 

<select name="rowSelect">
{foreach from=$roles item=role}
  <option value={$role->getNom()}>{$role->getNom()}</option>
 {/foreach}
</select>
</form>
{include '_footer.tpl'}