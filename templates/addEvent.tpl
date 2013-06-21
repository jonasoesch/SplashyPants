<script>
function create_champ(i) {

var i2 = i + 1;
var champ1='<p class="span3"><input type="text" size="5" placeholder="17:00" name="heure_'+i+'"/></p>';
var champ2='<p class="span8"><input type="text" name="description_'+i+'" placeholder="Description" id="rue"/></p>';
var champ3='<p class="span1" id="leschamps_'+i2+'"><a href="javascript:create_champ('+i2+')">+</a></p>';


document.getElementById('leschamps_'+i).innerHTML = champ1+champ2+champ3;
//document.getElementById('leschamps_'+i).innerHTML += (i <= 10) ? '</div><p class="span1"><span id="leschamps_'+i2+'"><a href="javascript:create_champ('+i2+')">+</a></span></p></div>' : '';


}
</script>
{include '_header.tpl'}
<form>
<div class="row">
            	<div class="span7">
                    	
                <form method="post" action=""> 	                    	
                 <div class="span11">
                 	<div class="row">
	       	 			<p class="span6 eventTitle">
							<input type="text" name="title" placeholder="Title" id="rue" size="70"/>
						</p>
                 	</div>
                 	<div class="row">
                 		<p class="span12">Starting Date</p>
                 	</div>
	                 <div class="row">
	       	 			<p class="span6">
	  						<input type="text" name="dob_year" placeholder="YYYY" size="4" maxlength="4" />  /
	  						<input type="text" name="dob_monat" placeholder="MM"  size="2" maxlength="2" /> /
	  						<input type="text" name="dob_day" placeholder="DD" size="2" maxlength="2" />
	  					</p>
		             </div>
		             <div class="row">
		                 <p class="span3"><input type="text" name="titre" placeholder="17:00" id="rue" size="5"/></p>
		                 <!--<p class="span8"><input type="text" name="titre" placeholder="Description" id="rue"/></p>-->
		                 <!-- <p class="span1" id="leschamps_2"><a href="javascript:create_champ(2)">+</a></p> -->
		             </div>
		             <div class="row">
                 		<p class="span12">Ending Date</p>
                 	</div>
		             <div class="row">
	       	 			<p class="span6">
	  						<input type="text" name="dob_year" placeholder="YYYY" size="4" maxlength="4" />  /
	  						<input type="text" name="dob_monat" placeholder="MM"  size="2" maxlength="2" /> /
	  						<input type="text" name="dob_day" placeholder="DD" size="2" maxlength="2" />
	  					</p>
		             </div>
		             <div class="row">
		                 <p class="span3"><input type="text" name="titre" placeholder="21:00" id="rue" size="5"/></p>
		                 <!--<p class="span8"><input type="text" name="titre" placeholder="Description" id="rue"/></p>-->
		                 <!-- <p class="span1" id="leschamps_2"><a href="javascript:create_champ(2)">+</a></p> -->
		             </div>
		             <div class="row">
		             	<p class="span6">
		             		<TEXTAREA name="titre" placeholder="Enter a description" id="rue" cols="70"></TEXTAREA>
		                </p>
		             </div>
		             <div class="row"> 
		             	<p class="span6"> 
		               <input type="Submit" name="submit" value="Validate" />  
		               </p> 
		             </div>
	  	
			      </div>
			    </form>
                 </div> 
            
               <div class="span5">
               		<div class="row">
	                	<p class="address" span="12">
	                		<input type="text" name="name" placeholder="Name" size="35" maxlength="25" /><br />
				  			<input type="text" name="address" placeholder="Address" size="35" maxlength="25" /><br />
				  			<input type="text" name="zipcode" placeholder="Zipcode" size="5" maxlength="5" />
				  			<input type="text" name="city" placeholder="City" size="22" maxlength="25" /> <br />
				  			<input type="text" name="country" placeholder="Country" size="20" maxlength="25" />
		  				</p>        
		  			</div>
		  			<div class="row">
		  				<p span="12">Existing Location</p>
		  					<select>
							  <option value="volvo">Volvo</option>
							  <option value="saab">Saab</option>
							  <option value="opel">Opel</option>
							  <option value="audi">Audi</option>
							 </select>
		  			</div>
	  			</div> 
                
                
                
</div>

<h2>Speakers</h2>


	<div class="row event-slot">
		<div class="span6">
			<h3>Slot One</h3>
				<div class="row">
	            	<p class="span12">Starting Date</p>
	            </div>
	            
		        <div class="row">
		       		<p class="span6">
						<input type="text" name="dob_year" placeholder="YYYY" size="4" maxlength="4" />  /
						<input type="text" name="dob_monat" placeholder="MM"  size="2" maxlength="2" /> /
						<input type="text" name="dob_day" placeholder="DD" size="2" maxlength="2" />
		  			</p>
		        </div>
		        
		        <div class="row">
					<p class="span5">
						<input type="text" name="titre" placeholder="17:00" id="rue" size="5"/>
					</p>
			    </div>
	
				<div class="row">
	            	<p class="span12">Ending Date</p>
	            </div>
	            
		        <div class="row">
		       		<p class="span6">
						<input type="text" name="dob_year" placeholder="YYYY" size="4" maxlength="4" />  /
						<input type="text" name="dob_monat" placeholder="MM"  size="2" maxlength="2" /> /
						<input type="text" name="dob_day" placeholder="DD" size="2" maxlength="2" />
		  			</p>
		        </div>
		        
		        <div class="row">
					<p class="span5">
						<input type="text" name="titre" placeholder="17:00" id="rue" size="5"/>
					</p>
			    </div>
		</div>

	</div>


<!-- <?php include 'eventFooter.html'; ?>-->


{include "_footer.tpl"}