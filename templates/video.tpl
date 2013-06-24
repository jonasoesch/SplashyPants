{include "_header.tpl"}
VIDEOWALL

<div class="row">
<!--{$someTalks|@var_dump}
{$someTalks|@count}-->

 {foreach from=$someTalks item=aTalk}
    <div class="span3">
        <div class="thumbVideo">
            <a href="{$baseURL}/videoDescription/event/{$aTalk->getEventNo()}/speaker/{$aTalk->getSpeakerPersonNo()}"><img src="{$baseURL}/public/images/Thumbnails/{$aTalk->getVideoTitle()}.png" width="225"/></link>   
            <p>{$aTalk->getVideoTitle()}</p>
       </div>    
    </div>
{/foreach}
    
</div>

{include "_footer.tpl"}
