{include '_header.tpl' title="Admin Area"}

<section>
  <h2>Creation</h2>
	<ul class="row">
		<li class="span2"><a class="button" href="{$baseURL}/addEvent">Create Event</a></li>
    <li class="span2"><a class="button" href="{$baseURL}/locations">Create Location </a></li>
    <li class="span2"><a class="button" href="{$baseURL}/register/speaker">Create Speaker </a></li>
    <li class="span2"><a class="button" href="{$baseURL}/register/organizer">Create Organizer </a></li>
    <li class="span2"><a class="button" href="{$baseURL}/teamRoles">Create TeamRole </a></li>
	</ul>
	<h2 class="v-medium">Modification</h2>
	<ul class="row">
    <li class="span2"><a class="button" href="{$baseURL}/events">Validate Visitors</a></li>	  
    <li class="span2"><a class="button" href="{$baseURL}/events">Modify Event </a></li>
    <li class="span2"><a class="button" href="{$baseURL}/persons">Modify Persons </a></li>
    <li class="span2"><a class="button" href="{$baseURL}/allocateTeamRoles">Allocate TeamRoles </a></li>
	</ul>
</section>

{include '_footer.tpl'}
