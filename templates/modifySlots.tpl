
{include '_header.tpl'}
{include 'eventWithoutSlot.tpl'}
<h2>Speakers</h2>
{include 'slots.tpl'}

{if $canEdit}
<div class="row">
<p class="span3"><a href="{$baseURL}/event/{$event->getNo()}/addSlot">Add a Slot</a></p>
</div>
{/if}

{include "_footer.tpl"}