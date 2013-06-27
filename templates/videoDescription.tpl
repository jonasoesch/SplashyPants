{include "_header.tpl" title=$arraySpeakerTalk.talk->getVideoTitle()}

<h1 class="offset2 span7">{$arraySpeakerTalk.talk->getVideoTitle()}</h1>


    <!--<a href={$arraySpeakerTalk.talk->getVideoURL()} class="zoombox"><img src="{$baseURL}/public/images/Thumbnails/{$arraySpeakerTalk.talk->getVideoTitle()}.png" width="225" class="videoIcon"/></a>-->
    <iframe class="offset2" width="560" height="315" src="http://www.youtube.com/embed/{$arraySpeakerTalk.talk->getVideoURL()|regex_replace:"/https?:\/\/www.youtube.com\/watch\?v=/":""}?&autoplay=1" frameborder="0" allowfullscreen></iframe>
    <div class="descriptionVideo row">
      <h3 class="subtitle offset2 span7">
        <a href="{$baseURL}/person/{$arraySpeakerTalk.speaker->getNo()}">
        {$arraySpeakerTalk.speaker->getFirstName()}
        {$arraySpeakerTalk.speaker->getName()}
        </a>
      </h3>
      <p class="offset2 span7">
        {$arraySpeakerTalk.talk->getVideoDescription()} 
      </p>
    </div>


{include "_footer.tpl"}
