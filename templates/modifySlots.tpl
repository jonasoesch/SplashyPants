
{include '_header.tpl'}
{include 'eventWithoutSlot.tpl'}
<h2>Speakers</h2>
{include 'slots.tpl'}

{if $canEdit}
<div class="row">
<p><a href="{$baseURL}/event/{$event->getNo()}/addSlot">add a Slot</a></p>
</div>
{/if}

{include "_footer.tpl"}