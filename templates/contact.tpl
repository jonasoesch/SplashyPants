{include "_header.tpl" title="Contact us"}
<section class="row">
  <h1 class="offset3">Contact</h1>
</section>

<section class="row">
  <form class="span4 offset3" methode="post" action="">
  	<fieldset>
  	  <label for="name">Name</label>
	    <input type="text" name="name" placeholder="Edward Teach" size="50"/>
	    
	    <label for="email">E-Mail</label>
	    <input type="email" name="email" placeholder="teach@blackbeard.com" size="50"/>
	    
	    <label for="subject">Subject</label>
	    <input type="text" name="subject" placeholder="Hello…" size="50"/>
	    
	    <textarea name="message" cols="60" placeholder="I wanted to tell you…"></textarea>
	    
      <input type="submit" name="send"value="Send">
    </fieldset>
  </form>
</section>
{include "_footer.tpl"}
