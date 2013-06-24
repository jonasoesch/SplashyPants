<!-- template validation -->

{include "_header.tpl"}
<link href="css/profile.css" rel="stylesheet" />

<section id="row">
    <h1>Validate participant</h1>
    <h2>Event title : {$event->getMainTopic()}</h2>
    <p>Event date : {$event->getStartingDate()}</p>
    {if $numberOfAcceptedRegistrations == 1 || $numberOfAcceptedRegistrations == 0}
    <p>{$numberOfAcceptedRegistrations} registration has been accepted</p>
    {else}
    <p>{$numberOfAcceptedRegistrations} registrations have been accepted</p>
    {/if}


{foreach from=$registrationsParticipantsWithMotivations item=aRegistrationData}
  <!--  déclaration des variables participant pour se faciliter la vie-->
  {assign var="participant" value=$aRegistrationData['participant']}
  {assign var="registration" value=$aRegistrationData['registration']}
  {assign var="motivations" value=$aRegistrationData['motivations']}
  {assign var="keywords" value=$aRegistrationData['keywords']}

<section class="profile-event">

      <p class="row">Date of last change : {$registration->getRegistrationDate()}</p>

      <p class="row">
        <h3 class="span12 offset4">{$participant->getFirstName()} {$participant->getName()}</h3>
      </p>

      <p class="row">
        <h4 class="span4">Registration Status</h4>
         {assign var="statusRegistration" value=$registration->getStatus()}
         
         {if $statusRegistration =="Rejected"}
        <p class="span8 rejected">{$registration->getStatus()}</p>
        {elseif $statusRegistration =="Sent"}
        <p class="span8 sent">{$registration->getStatus()}</p>
        {elseif $statusRegistration =="Accepted"}
        <p class="span8 accepted">{$registration->getStatus()}</p>
        {else}
        <p class="span8 rejected">The status of registration doesn't exist</p>
        {/if}
      </p>


    <p class="row">
      <h4 class="span4">Motivation</h4>
      {foreach from=$aRegistrationData['motivations'] item=aMotivation}
      <p class="span8">{$aMotivation->getText()}</p>
      {/foreach}
    </p>

    <p class="row">
      <h4 class="span4">Keywords</h4>
      <ul class="span8">
          {foreach from=$aRegistrationData['keywords'] item=aKeywords}
          <li class="pill">{$aKeywords->getValue()}</li>
          {/foreach}
      </ul> 

    {if $statusRegistration =="Sent"}
    <h4 class="row offset8"> 
        <a href="{$baseURL}/event/{$event->getNo()}/participant/{$participant->getNo()}/reject">Reject</a>
        <a href="{$baseURL}/event/{$event->getNo()}/participant/{$participant->getNo()}/validate">Validate</a>
    </h4>
    {elseif $statusRegistration =="Accepted" || $statusRegistration =="Rejected" }
    <h4 class="row offset8"> 
        <a href="{$baseURL}/event/{$event->getNo()}/participant/{$participant->getNo()}/cancel">Cancel</a>
    </h4>
    {else}
    <h4 class="row offset8">No action can be done</h4>    
    {/if}

    



<!--
  <section class="row">
    <form class="offset8 span1" method="post" action="{$baseURL}/event/{$event->getNo()}/addParticipant"> 
          <input type="hidden" name="rejected" value="rejected" />
          <input type="Submit" name="reject" value="reject" />
    </form>
    <form class="offset8 span1" method="post" action="{$baseURL}/event/{$event->getNo()}/addParticipant">
          <input type="hidden" name="validated" value="validated" />
          <input type="Submit" name="validate" value="validate" />
    </form>



    ou


    <form method="get" action="{$baseURL}/event/{$event->getNo()}/participant/{$participant->getNo()}">
    <p class="row offset8"> 
        <input type="Submit" name="reject" value="reject" />
        <input type="Submit" name="validate" value="validate" />
    </p>
</form>

  ou

   <!--{if $statusRegistration =="Sent"}
    <p class="row offset8"> 
        <a href="{$baseURL}/event/{$event->getNo()}/participant/{$participant->getNo()/reject}">Reject</a>
        <a href="{$baseURL}/event/{$event->getNo()}/participant/{$participant->getNo()/validate}">Validate</a>
    </p>
    {elseif $statusRegistration =="Accepted"}
    <p>blabla</p>
    {else}
    <p>blabla2</p>
    {/if}-->


  </section>


    
{/foreach}
</section>



{include "_footer.tpl"}
