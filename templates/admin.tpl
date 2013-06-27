{include '_header.tpl' title="Admin Area"}

<section>
	<ul class="row">
					<li class="span2"><a class="button" href="{$baseURL}/addEvent">Create Event </a></li>
					<li class="span2"><a class="button" href="{$baseURL}/events">Modify Event </a></li>
	                <li class="span2"><a class="button" href="{$baseURL}/locations">Create Location </a></li>
	                <li class="span2"><a class="button" href="{$baseURL}/register/speaker">Create Speaker </a></li>
	                <li class="span2"><a class="button" href="{$baseURL}/register/organizer">Create Organizer </a></li>
	                <li class="span2"><a class="button" href="{$baseURL}/teamRoles">Team Roles </a></li>
	                <li class="span2"><a class="button" href="{$baseURL}/allocateTeamRoles">Allocate Team Roles </a></li>
                        <li class="span2"><a class="button" href="{$baseURL}/persons">Modify Persons </a></li>
	</ul>
</section>

{include '_footer.tpl'}
