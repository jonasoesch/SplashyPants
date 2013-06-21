{include "_header.tpl"}
<link href="css/profile.css" rel="stylesheet" />
<div class="row">
     <h1 class="span12"> {$event->getMainTopic()}</h1> 
</div>
{foreach from=$registrationsParticipantsWithMotivations item=aRegistrationData}
<!--  déclaration d'une variable participant pour se faciliter la vie-->
{assign var="participant" value=$aRegistrationData['participant']}

    <div class="row">
        <div class="row">
        <form method="post" action="check.php">
            
        
            <div class="span3">
                <h3 class="span3">
                  <span class="prenom">{$participant->getFirstName()} </span>
                  <span class="nom">{$participant->getName()}</span>
                </h3>
            </div>
          <div class="span3">
                <div class="row">
                    <p class="span6 email">{$participant->getEmail()}</p>
                </div>
            
         </div>
         
    </div>
    <div class="offset2">
        <input type="Submit" name="add" value="add" /> 
        <input type="Submit" name="remove" value="ignore" /> 
        </form>
    </div>
    </div>
{/foreach}
<!--<div id="row">
<p class="span6 offset3"> 22 participants have been accepted to the (event name) event</p>
<p class="span6 offset3"><a href=""> see participatiors list</a> </p>
</div>-->



{include "_footer.tpl"}
