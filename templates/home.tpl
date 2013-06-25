{include "_header.tpl"}

<section class="row">
    <section class="row event span6">
        <article>
            <h1 class="span11 offeset1">Next Event</h1><br />
            <h2 class="span11 offset1"> {$event->getMainTopic()}</h2>
            <h3 class="span11 offset1">{$event->getStartingDate()}</h3>
            <a class="span6 offset6" href="{$baseURL}/event/{$event->getNo()}">more info</a>
            <figure class="span11 offset1">
                <a href="{$baseURL}/event/{$event->getNo()}"><img src="{$baseURL}/public/images/event/event{$event->getNo()}.png" width="270" alt="TEDxLausanne | {$event->getMainTopic()} | {$event->getStartingDate()}" title="TEDxLausanne | {$event->getMainTopic()}" /></a>
            </figure>
        </article>
    </section>

    <aside id="video" class="span6">
        <h1 class="span10 offeset1">Latest Talks</h1><br />
        <!-- shows only the three latest videos added in the database-->
        {section name=index loop=$arraySpeakerTalks max=3 step=-1} 
            <article class="row thumbVideo">
                <figure>
                <a href="{$baseURL}/videoDescription/event/{$arraySpeakerTalks[index].talk->getEventNo()}/speaker/{$arraySpeakerTalks[index].talk->getSpeakerPersonNo()}" class="speakerImage span6"><img src="{$baseURL}/public/images/Thumbnails/{$arraySpeakerTalks[index].talk->getVideoTitle()}.png" width="225" alt="{$arraySpeakerTalks[index].talk->getVideoTitle()}" title="{$arraySpeakerTalks[index].talk->getVideoTitle()}" /></a>
                </figure> 
                <h5 class="speakerText span6">{$arraySpeakerTalks[index].speaker->getName()} {$arraySpeakerTalks[index].speaker->getFirstName()} </h5>
                <p class="speakerText span6"> {$arraySpeakerTalks[index].talk->getVideoTitle()}</p>
            </article>   
        {/section}

    </aside>
</section>


{include "_footer.tpl"}

