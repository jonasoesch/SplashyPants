{include "_header.tpl" title=$arraySpeakerTalk.talk->getVideoTitle()}
{$arraySpeakerTalk.talk->getVideoTitle()}


<div class="row">
    <div class="span6">
    <!--<a href={$arraySpeakerTalk.talk->getVideoURL()} class="zoombox"><img src="{$baseURL}/public/images/Thumbnails/{$arraySpeakerTalk.talk->getVideoTitle()}.png" width="225" class="videoIcon"/></a>-->
    <iframe width="560" height="315" src="http://www.youtube.com/embed/{$arraySpeakerTalk.talk->getVideoURL()|regex_replace:"/https?:\/\/www.youtube.com\/watch\?v=/":""}?&autoplay=1" frameborder="0" allowfullscreen></iframe>
    
    </div>
        <div class ="descriptionVideo">
    <p>
        {$arraySpeakerTalk.speaker->getFirstName()}
        {$arraySpeakerTalk.speaker->getName()}
    </p>
    {$arraySpeakerTalk.talk->getVideoDescription()} 
       </div>
    
</div>

{include "_footer.tpl"}
