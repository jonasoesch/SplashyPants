{include "_header.tpl"}

			
			<div class="row">
            	<section class="row event span6">
                    	<h3 class="span11 offset1"> {$event->getMainTopic()}</h3>
                    	<h1 class="span11 offset1">{$event->getStartingDate()}</h1>
                    	<h6 class="span11 offset1"> with Jerome da Clat et Christophe Piscine Merkle</h6>
                    	
                    		<a class="span6 offset6" href="{$baseURL}/event/{$event->getNo()}">more info</a>

                 </section>
                 
            
                <aside id="video" class="span6">    
                		<figure class="row">
                    	<img src="{$baseURL}/public/images/manu-jindal-434px.jpg" class="speakerImage span6"/>
                    	<p class="speakerText span6">Manu Jindal: The sky is NOT the limit: live the change <br /> 28.06.2012 <br /> Disruption </p>
                		</figure>
                    
                		<figure class="row">
	                    <img src="{$baseURL}/public/images/katrin-muff-434px.jpg" class="speakerImage span6"/>
	                    <p class="speakerText  span6">Katrin Muff: Rethinking management education for the world <br />28.06.2012 <br /> Positive Disruption</p>
                		</figure>
                    
                		<figure class="row">
                    	<img src="{$baseURL}/public/images/pierre-calleja-434px.jpg" class="speakerImage span6"/>
                    	<p class="speakerText  span6">Pierre Calleja: The street lamp that absorbs CO2 <br /> 28.06.2012 <br /> Positive Disruption</p>
                		</figure>
                </aside>
            </div>
            

{include "_footer.tpl"}

