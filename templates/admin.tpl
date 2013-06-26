{include '_header.tpl' }
{if $tedx->isAdministrator()|| $tedx->isSuperAdmin() || $tedx->isOrganizer() }
<div class="row">
<ul class="offset4">
                <li class="span3"><a href="{$baseURL}/teamRoles">Team Roles </a></li>
                <li class="span3"><a href="{$baseURL}/locations">Locations </a></li>
                
    </ul>
</div>
{/if}

<h2> You don't have the permission to view this page </h2>

{include '_footer.tpl'}
