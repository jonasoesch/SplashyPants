<!-- template validation -->

{include "_header.tpl"}
<link href="css/profile.css" rel="stylesheet" />

<section id="row">
    <h1>Events List</h1>
    {if $numberOfEvents == 1 || $numberOfEvents == 0}
    <p>TEDxLausanne counts {$numberOfEvents} event</p>
    {else}
    <p>TEDxLausanne counts {$numberOfEvents} events</p>
    {/if}

    {section name=index loop=$arrayEventsLocation step=-1}
      <article class="row event-slot">
        <a href="{$baseURL}/event/{$arrayEventsLocation[index].event->getNo()}">
          <h3 class="row span12 offset1">{$arrayEventsLocation[index].event->getMainTopic()}</h3>
        </a>
        <h4 class="row span12 offset1">{$arrayEventsLocation[index].event->getStartingDate()}</h4>
        <p class="row span12 offset1">{$arrayEventsLocation[index].location->getName()} {$arrayEventsLocation[index].location->getDirection()}</p>
        <p class="row span12 offset1">{$arrayEventsLocation[index].location->getAddress()} {$arrayEventsLocation[index].location->getCity()}</p>
        <span class="admin-bar">
            <a class="edit" href="{$baseURL}/modifyEvent/{$arrayEventsLocation[index].event->getNo()}">Edit</a>
            <a class="edit" href="{$baseURL}/archiveEvent/{$arrayEventsLocation[index].event->getNo()}">Remove</a>
        </span>
      </article>
    {/section}
</section>
{include "_footer.tpl"}
