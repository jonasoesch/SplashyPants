{include "_header.tpl" title="Our TEDx Events"}

<header class="row">
    <h1 class="span12">Our TEDx Events</h1>
    <p class="span10">TEDxLausanne took place {$numberOfEvents} time{if $numberOfEvents > 1 }s{/if}</p>
    {if $canEdit}<p class="span2"><a class="button" href="{$baseURL}/addEvent">Create Event </a></p>{/if}
</header>
    
{section name=index loop=$arrayEventsLocation step=-1}
  <article class="module row">
    <a href="{$baseURL}/event/{$arrayEventsLocation[index].event->getNo()}">
      <h3 class="span4">{$arrayEventsLocation[index].event->getMainTopic()}</h3>
    </a>
    <h4 class="span3 offset1">{$arrayEventsLocation[index].event->getStartingDate()|date_format:"%d. %B %Y"}</h4>
    <p class="span3 offset1">{$arrayEventsLocation[index].location->getName()} {$arrayEventsLocation[index].location->getDirection()}<br />
    {$arrayEventsLocation[index].location->getAddress()} {$arrayEventsLocation[index].location->getCity()}
    </p>
    {if $canEdit}<a class="admin-link span12" href="{$baseURL}/modifyEvent/{$arrayEventsLocation[index].event->getNo()}">Edit</a>{/if}

  </article>
{/section}

{include "_footer.tpl"}
