{include "_header.tpl" title="Our TEDx talks"}

<h1>Past Talks at TEDx</h1>

<div class="row">
<!--{$someTalks|@var_dump}
{$someTalks|@count}-->

 {foreach from=$someTalks item=aTalk}
    <div class="span3">
        <div class="thumbVideo">
            <a href="{$baseURL}/videoDescription/event/{$aTalk->getEventNo()}/speaker/{$aTalk->getSpeakerPersonNo()}"><img src="{$baseURL}/public/images/Thumbnails/{$aTalk->getVideoTitle()}.png" width="225"/></a>   
            <h3 class="subtitle-fat">
              <a href="{$baseURL}/videoDescription/event/{$aTalk->getEventNo()}/speaker/{$aTalk->getSpeakerPersonNo()}">{$aTalk->getVideoTitle()}</a>
            </h3>
              <a href="{$baseURL}/person/{$aTalk->getSpeakerPersonNo()}">
                {$speakers[$aTalk->getSpeakerPersonNo()]->getFirstName()}
                {$speakers[$aTalk->getSpeakerPersonNo()]->getName()}
              </a>
            <p></p>
       </div>    
    </div>
{/foreach}
    
</div>

{include "_footer.tpl"}
