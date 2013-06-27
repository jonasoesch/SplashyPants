{include "_header.tpl" title="Our TEDx talks" where="video"}

<h1>Past Talks at TEDx</h1>


 {foreach from=$someTalks item=aTalk}
    {if ($aTalk@index % 4) == 0}<div class="row">{/if}
    <article class="span3">
        <div class="thumbVideo">
            <a href="{$baseURL}/videoDescription/event/{$aTalk->getEventNo()}/speaker/{$aTalk->getSpeakerPersonNo()}"><img src="{$baseURL}/public/images/Thumbnails/{rand(1,10)}.PNG" width="225"/></a>
            <h3 class="subtitle-fat">
              <a href="{$baseURL}/videoDescription/event/{$aTalk->getEventNo()}/speaker/{$aTalk->getSpeakerPersonNo()}">{$aTalk->getVideoTitle()}</a>
            </h3>
              <p><a href="{$baseURL}/person/{$aTalk->getSpeakerPersonNo()}">
                {$speakers[$aTalk->getSpeakerPersonNo()]->getFirstName()}
                {$speakers[$aTalk->getSpeakerPersonNo()]->getName()}
              </a>
              </p>
       </div>    
    </article>
  {if ($aTalk@index % 4) == 3}</div>{/if}
{/foreach}

{include "_footer.tpl"}
