{include "_header.tpl"}
{$talk->getVideoTitle()}


<div class="row">
    <div class="span6">
    <a href={$talk->getVideoURL()} class="zoombox"><img src="{$baseURL}/public/images/Thumbnails/{$talk->getVideoTitle()}.png" width="225" class="videoIcon"/></a>
    </div>
        <div class ="descriptionVideo">
    <!--{$talk->getVideoURL()}-->

    {$talk->getVideoDescription()} 
       </div>
    
</div>

{include "_footer.tpl"}
