<h1>{$event->getMainTopic()}        
  {if $canEdit}
    <a href="{$baseURL}/event/{$event->getNo()}/modify" class="admin-link">Edit</a>
  {/if}
</h1>
<h2 class="subtitle">{$event->getStartingDate()|date_format:"%d. %B %Y"}</h2>
<div class="row">  	                    	
    <article class="span6">
      <h4>Program</h4>
      <p>
        <figure class="float">
          <a href="{$baseURL}/event/{$event->getNo()}">
            <!-- <img src="{$baseURL}/public/images/event/event{$event->getNo()}.png" width="270" alt="TEDxLausanne | {$event->getMainTopic()} | {$event->getStartingDate()}" title="TEDxLausanne | {$event->getMainTopic()}" /> -->
            <img src="{$baseURL}/public/images/event/event1.png" width="270" alt="TEDxLausanne | {$event->getMainTopic()} | {$event->getStartingDate()}" title="TEDxLausanne | {$event->getMainTopic()}" />
          </a>
        </figure>
      {$event->getDescription()}
        </p>
    </article>
    <div class="offset1 span5">
      <iframe width="332" height="332" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="{$baseURL}/public/map.php?street={$location->getAddress()}&city={$location->getCity()}&country={$location->getCountry()}"></iframe>
       <p class="span12">{$location->getName()}<br />{$location->getAddress()}<br />{$location->getCity()}<br />{$location->getCountry()}</p>
    </div>
</div>

