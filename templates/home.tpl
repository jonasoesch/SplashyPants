{include "_header.tpl"}

<section class="row">
    <section class="row event span6">
        <h1 class="span11 offeset1">Next Event</h1><br />
        <h2 class="span11 offset1"> {$event->getMainTopic()}</h2>
        <h3 class="span11 offset1">{$event->getStartingDate()}</h3>
        <h6 class="span11 offset1"> with Jerome da Clat et Christophe Piscine Merkle</h6>

        <a class="span6 offset6" href="{$baseURL}/event/{$event->getNo()}">more info</a>

    </section>


    <aside id="video" class="span6">
        <h1 class="span10 offeset1">Latest Talks</h1><br />
        <!-- shows the three latest videos added in the database-->
        {section name=index loop=$arraySpeakerTalks max=3 step=-1} 
        
            <!--{var_dump ($arraySpeakerTalks)}-->

            <article class="row thumbVideo">


                <a href="{$baseURL}/videoDescription/event/{$arraySpeakerTalks[index].talk->getEventNo()}/speaker/{$arraySpeakerTalks[index].talk->getSpeakerPersonNo()}" class="speakerImage span6"><img src="{$baseURL}/public/images/Thumbnails/{$arraySpeakerTalks[index].talk->getVideoTitle()}.png" width="225" alt="{$arraySpeakerTalks[index].talk->getVideoTitle()}" title="{$arraySpeakerTalks[index].talk->getVideoTitle()}"></a>   
                    <p class="speakerText span6">{$arraySpeakerTalks[index].speaker->getName()} {$arraySpeakerTalks[index].speaker->getFirstName()} : {$arraySpeakerTalks[index].talk->getVideoTitle()}</p>
            </article>   
        {/section}

    </aside>
</section>


{include "_footer.tpl"}

