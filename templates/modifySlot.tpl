
{include '_header.tpl'}
{include 'eventWithoutSlot.tpl'}
<h2>Speakers</h2>

<form>
{foreach from=$slotsWithSpeakers item=slotData}
	<div class="row event-slot">
		<div class="span3">
			<h3>Slot One</h3>
				<div class="row">
	            	<p class="span12">Starting Date</p>
	            </div>
	            
		        <div class="row">
		       		<p class="span12">
						<input type="text" name="slot_dob_year" placeholder="YYYY" size="4" maxlength="4" />  /
						<input type="text" name="slot_dob_monat" placeholder="MM"  size="2" maxlength="2" /> /
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
						<input type="text" name="slot_doe_year" placeholder="YYYY" size="4" maxlength="4" />  /
						<input type="text" name="slot_doe_monat" placeholder="MM"  size="2" maxlength="2" /> /
						<input type="text" name="slot_doe_day" placeholder="DD" size="2" maxlength="2" />
		  			</p>
		        </div>
		        
		        <div class="row">
					<p class="span12">
						<input type="text" name="slot_hoe" placeholder="17:00" size="5"/>
					</p>
			    </div>
		</div>

		<div span="9">
			<div class="row">
				<p class="span3">
				Select a speaker
				<select>
			  					{foreach from=$speakers item=speaker}	
			  											  
			  						<option value="{$speaker->getNo()}">{$speaker->getFirstName()} {$speaker->getName()} </option>
							  	{/foreach}
				</select>
				</p>
				<p class="span3">
				Select a speaker
				<select>
			  					{foreach from=$speakers item=speaker}	
			  											  
			  						<option value="{$speaker->getNo()}">{$speaker->getFirstName()} {$speaker->getName()} </option>
							  	{/foreach}
				</select>
				</p>
				<p class="span2">
				Select a speaker
				<select>
			  					{foreach from=$speakers item=speaker}	
			  											  
			  						<option value="{$speaker->getNo()}">{$speaker->getFirstName()} {$speaker->getName()} </option>
							  	{/foreach}
				</select>
				</p>
			</div>
		</div>
	</div>
{/foreach}
</form>


{include "_footer.tpl"}