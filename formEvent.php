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
<?php include 'header.php'; ?>

<form>
<div class="row">
            	<div class="span7">
                    	
                    	                    	
                 <div class="span11">
                 	<div class="row">
	       	 			<p class="span6 eventTitle">
							<input type="text" name="titre" placeholder="Title" id="rue"/>
						</p>
                 	</div>
                 	
	                 <div class="row">
	       	 			<p class="span6 eventDate">
	  						<input type="text" name="dob_year" placeholder="<?php echo "YYYY"; ?>" size="4" maxlength="4" />  /
	  						<input type="text" name="dob_monat" placeholder="<?php echo "MM"; ?>"  size="2" maxlength="2" /> /
	  						<input type="text" name="dob_day" placeholder="<?php echo "DD"; ?>" size="2" maxlength="2" />
	  					</p>
		             </div>
		             <div class="row">
		             	<p class="span6">
		             		<TEXTAREA name="titre" placeholder="Enter a description" id="rue" cols="70"></TEXTAREA>
		                </p>
		             </div>
	                 <div class="row">
		                 <p class="span3"><input type="text" name="titre" placeholder="17:00" id="rue" size="5"/></p>
		                 <p class="span8"><input type="text" name="titre" placeholder="Description" id="rue"/></p>
		                 <!-- <p class="span1" id="leschamps_2"><a href="javascript:create_champ(2)">+</a></p> -->
		             </div>
		             

	  	
		                 
	  	
			      </div>

                 </div> 
            
                <div class="span5">
                	<?php include 'formLocation.php'; ?>
                </div>
                
                
                
</div>
<h2>Speakers</h2>


<div class="row event-slot">
		<h3 class="span4">Slut One</h3>
		<figure class="span2">
			<img class="profil portrait" src="images/merkle.jpg"/>
			<p>
				<a href="/tedxEventManager/SplashyPants/profile.php">Christou Piscine</a>
			</p>
		</figure>
		
		<figure class="span2 offset1">
			<img class="profil portrait" src="images/justo.png">
			<p>
				<a href="/tedxEventManager/SplashyPants/profile.php">Magic Justo</a>
			</p>
		</figure>
		
		<figure class="span2 offset1">
			<img class="profil portrait" src="images/hqdefault.jpg"/>
			<p>
				<a href="/tedxEventManager/SplashyPants/profile.php">Jerôme Clôt</a>
			</p>
		</figure>
</div>

<div class="row event-slot">
		<h3 class="span4">Slut two</h3>
		<figure class="span2">
			<img src="images/merkle2.jpg"/>
			<p>
				<a href="/tedxEventManager/SplashyPants/profile.php">Christophe Piscine</a>
			</p>
		</figure>
		
		<figure class="span2 offset1">
			<img class="profil portrait" src="images/justo2.jpg">
			<p>
				<a href="/tedxEventManager/SplashyPants/profile.php">Magic Justo</a>
			</p>
		</figure>
		<figure class="span2 offset1">
			<img class="profil portrait" src="images/clot.png"/>
			<p>
				<a href="/tedxEventManager/SplashyPants/profile.php">Jerome Clot</a>
			</p>
		</figure>
</div>


<?php include 'eventFooter.html'; ?>


<?php include 'footer.php'; ?>
