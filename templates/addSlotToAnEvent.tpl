
{include '_header.tpl'}
{include 'eventWithoutSlot.tpl'}
<h2>Speakers</h2>

<form action="{$baseURL}/event/{$event->getNo()}/submitAddSlot" method="post">
	<div class="row event-slot">
		<div class="span3">
			<h3>Add a Slot</h3>
				<div class="row">
	            	<p class="span12">Starting Date</p>
	            </div>
	            
		        <div class="row">
		       		<p class="span12">
						<input type="text" name="slot_dob_year" placeholder="YYYY" size="4" maxlength="4" />  /
						<input type="text" name="slot_dob_month" placeholder="MM"  size="2" maxlength="2" /> /
						<input type="text" name="slot_dob_day" placeholder="DD" size="2" maxlength="2" />
		  			</p>
		        </div>
		        
		        <div class="row">
					<p class="span12">
						<input type="text" name="slot_hob" placeholder="17:00" size="5"/>
					</p>
			    </div>
	
				<div class="row">
	            	<p class="span12">Ending Date</p>
	            </div>
	            
		        
		        <div class="row">
					<p class="span12">
						<input type="text" name="slot_hoe" placeholder="17:00" size="5"/>
					</p>
			    </div>
		</div>
	</div>
		<div class="row"> 
         	<p class="span6"> 
           <input type="Submit" />  
           </p> 
		</div>
</form>


{include "_footer.tpl"}