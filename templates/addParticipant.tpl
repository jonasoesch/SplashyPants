{include "_header.tpl"}
<link href="css/profile.css" rel="stylesheet" />

<div id="row">
    <h2 class>{$event->getMainTopic()}</h2> 
</div>

<div class="profile-event">
  
  {foreach from=$registrationsParticipantsWithMotivations item=aRegistrationData}
  <!--  déclaration des variables participant pour se faciliter la vie-->
  {assign var="participant" value=$aRegistrationData['participant']}
  {assign var="registration" value=$aRegistrationData['registration']}
  {assign var="motivations" value=$aRegistrationData['motivations']}
  {assign var="keywords" value=$aRegistrationData['keywords']}

<form method="post" action="check.php">
      <div class="row">
        <h1 class="span3">{$participant->getFirstName()} {$participant->getName()}</h1>
      </div>
      <div class="row">
        <h3 class="span4">Registration Status</h3>
         <!--{assign var="statusRegistration" value=$registration->getStatus()}-->
         {if $statusRegistration =="pending"}
        <p class="span8 pending">{$registration->getStatus()}</p>
        {elseif $statusRegistration =="sent"}
        <p class="span8 sent">{$registration->getStatus()}</p>
        {elseif $statusRegistration =="accepted"}
        <p class="span8 accepted">{$registration->getStatus()}</p>
        {else}
        <p class="span8 rejected">{$registration->getStatus()}</p>
        {/if}
      </div>


    <div class="row">
      <h3 class="span4">Motivation</h3>
      {foreach from=$aRegistrationData['motivations'] item=aMotivation}
      <p class="span8">{$aMotivation->getText()}</p>
      {/foreach}
    </div>

    <div class="row">
      <h3 class="span4">Keywords</h3>
      
        <ul class="span8">
          {foreach from=$aRegistrationData['keywords'] item=aKeywords}
          <li class="pill">{$aKeywords->getValue()}</li>
          {/foreach}
        </ul>

      
    </div>
 <div class="row offset8">
        <input type="Submit" name="add" value="add" /> 
        <input type="Submit" name="remove" value="ignore" /> 
        </form>
</div>


    
{/foreach}
<!--<div id="row">
<p class="span6 offset3"> 22 participants have been accepted to the (event name) event</p>
<p class="span6 offset3"><a href=""> see participatiors list</a> </p>
</div>-->



{include "_footer.tpl"}
