{include "_header.tpl"}
<div id="row">
     <h1 class="span12"> {$event->getMainTopic()}</h1> 
</div>
<div id="row">
    <form method="post" action="check.php">
        <div class="span4" >
            <select class="span10" size="3" name="wannabeParticipants"> 
                {foreach from=$registrationsParticipantsWithMotivations item=aRegistrationData}
                <!--  déclaration d'une variable participant pour se faciliter la vie-->
                {assign var="participant" value=$aRegistrationData['participant']}
                <option VALUE="{$participant->getPersonNo()}"> {$participant->getFirtsName()} {$participant->getName()}</option>
                {/foreach}
            </select>
        </div>
        <div class="span8">
            <figure class="span3 ">
                <img class="profil portrait" src="images/clot.jpg" />
            </figure>
            <table class="span7 offset2 ">
                <tbody>
                    <tr>
                        <td>Hugo Chavez (62)</td>
                    </tr>
                    <tr>
                        <td>I would like a Brazzers access card, like ... right now dude. If you don't 
                            let me in this TED i will make something, that you won't forget... for sure. Me and my hombre over there
                            don't like to play. Gringo!</td>
                    </tr>
                     <tr>
                        <td>SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAGSWAG SWAG SWAG 
                            SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAG SWAG 
                            SWAG SWAG SWAG SWAG SWAG</td>
                    </tr>
                    <tr>
                        <td>
                         <input type="Submit" name="add" value="add" /> 
                         <input type="Submit" name="remove" value="ignore" /> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>    
    </form>
</div>
<div id="row">
<p class="span6 offset3"> 22 participants have been accepted to the (event name) event</p>
<p class="span6 offset3"><a href=""> see participatiors list</a> </p>
</div>
</div>

{include "_footer.tpl"}
