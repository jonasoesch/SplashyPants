{include "_header.tpl"}
<link href="css/profile.css" rel="stylesheet" />

<section id="row">
    <h1>Validate participant</h1>
    <h2>Event title : {$event->getMainTopic()}</h2>
    <p>Event date : {$event->getStartingDate()}</p>


{foreach from=$registrationsParticipantsWithMotivations item=aRegistrationData}
  <!--  déclaration des variables participant pour se faciliter la vie-->
  {assign var="participant" value=$aRegistrationData['participant']}
  {assign var="registration" value=$aRegistrationData['registration']}
  {assign var="motivations" value=$aRegistrationData['motivations']}
  {assign var="keywords" value=$aRegistrationData['keywords']}

<section class="profile-event">

      <p class="row">
        <h3 class="span12 offset4">{$participant->getFirstName()} {$participant->getName()}</h3>
      </p>

      <p class="row">
        <h4 class="span4">Registration Status</h4>
         {assign var="statusRegistration" value=$registration->getStatus()}
         
         {if $statusRegistration =="Pending"}
        <p class="span8 pending">{$registration->getStatus()}</p>
        {elseif $statusRegistration =="Sent"}
        <p class="span8 sent">{$registration->getStatus()}</p>
        {elseif $statusRegistration =="Accepted"}
        <p class="span8 accepted">{$registration->getStatus()}</p>
        {else}
        <p class="span8 rejected">{$registration->getStatus()}</p>
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
    </p>

<form method="get" action="{$baseURL}/event/{$event->getNo()}/participant/{$aParticipant->getPersonNo()}">
    <p class="row offset8"> 
        <input type="Submit" name="reject" value="reject" />
        <input type="Submit" name="validate" value="validate" />
    </p>
</form>



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
  </section>-->

</section>
    
{/foreach}
</section>
<!--<div id="row">

  <form method="post" action="{$baseURL}/event/{$event->getNo()}/addParticipant">
    <p class="row offset8"> 
        <input type="hidden" name="rejected" value="rejected" />
        <input type="hidden" name="validated" value="validated" />
        <input type="Submit" name="reject" value="reject" />
        <input type="Submit" name="validate" value="validate" />
    </p>
</form>


<p class="span6 offset3"> 22 participants have been accepted to the (event name) event</p>
<p class="span6 offset3"><a href=""> see participatiors list</a> </p>
</div>-->



{include "_footer.tpl"}
