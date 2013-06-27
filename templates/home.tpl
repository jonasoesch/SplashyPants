{include "_header.tpl" title="TEDx Lausanne"}

<section class="row">
    <section class="row event span6">
        <article>
            <h1 class="span12">Next Event</h1>
            <h2 class="span12"> {$event->getMainTopic()}</h2>
            <h3 class="span12 subtitle">{$event->getStartingDate()|date_format:"%d. %B %Y"}</h3>
            <p class="span12">
              <figure class="float">
                <a href="{$baseURL}/event/{$event->getNo()}">
                  <!-- <img src="{$baseURL}/public/images/event/event{$event->getNo()}.png" width="270" alt="TEDxLausanne | {$event->getMainTopic()} | {$event->getStartingDate()}" title="TEDxLausanne | {$event->getMainTopic()}" /> -->
                  <img src="{$baseURL}/public/images/event/event1.png" width="270" alt="TEDxLausanne | {$event->getMainTopic()} | {$event->getStartingDate()}" title="TEDxLausanne | {$event->getMainTopic()}" />
                </a>
            </figure>
              {$event->getDescription()}
            </p>
            <p class="span4 offset8"><a class="button" href="{$baseURL}/event/{$event->getNo()}">See more</a></p>
        </article>
    </section>

    <aside id="video" class="span5 offset1">
        <h1 class="span10 offeset1">Latest Talks</h1><br />
        <!-- shows only the three latest videos added in the database-->
        {section name=index loop=$arraySpeakerTalks max=6 step=-1} 
            <article class="row thumbVideo">
                <figure>
                <a href="{$baseURL}/videoDescription/event/{$arraySpeakerTalks[index].talk->getEventNo()}/speaker/{$arraySpeakerTalks[index].talk->getSpeakerPersonNo()}" class="speakerImage span6">
                  <img src="{$baseURL}/public/images/Thumbnails/{rand(1,10)}.PNG" width="225" alt="{$arraySpeakerTalks[index].talk->getVideoTitle()}" title="{$arraySpeakerTalks[index].speaker->getName()} {$arraySpeakerTalks[index].speaker->getFirstName()} | {$arraySpeakerTalks[index].talk->getVideoTitle()}" />
                  
                  </a>
                </figure> 
                <h5 class="speakerText span6">
                  <a href="{$baseURL}/person/{$arraySpeakerTalks[index].speaker->getNo()}">{$arraySpeakerTalks[index].speaker->getName()} {$arraySpeakerTalks[index].speaker->getFirstName()}</a>
                </h5>
                <p class="speakerText span6"> {$arraySpeakerTalks[index].talk->getVideoTitle()}</p>
            </article>   
        {/section}

    </aside>
</section>


{include "_footer.tpl"}

