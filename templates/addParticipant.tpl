{include "_header.tpl"}
<div id="row">
     <h1 class="span12"> {$event->getMainTopic()}</h1> 
</div>
{foreach from=$registrationsParticipantsWithMotivations item=aRegistrationData}
<!--  déclaration d'une variable participant pour se faciliter la vie-->
{assign var="participant" value=$aRegistrationData['participant']}

    <div id="row">
        <form method="post" action="check.php">
            
        <div class="row profile-details">
            
            <h3 class="offset1">
              <span class="prenom">{$participant->getFirtsName()} </span>
              <span class="nom">{$participant->getName()}</span>
            </h3>
          
          <div class="offset1 span8 contact profile-table">
                
                <div class="row">
                    <p class="span6 email">{$participant->getEmail()}</p>
                </div>
            
         </div>
         
    </div>
        <input type="Submit" name="add" value="add" /> 
        <input type="Submit" name="remove" value="ignore" /> 
        </form>
    </div>
{/foreach}
<!--<div id="row">
<p class="span6 offset3"> 22 participants have been accepted to the (event name) event</p>
<p class="span6 offset3"><a href=""> see participatiors list</a> </p>
</div>-->
</div>


{include "_footer.tpl"}
