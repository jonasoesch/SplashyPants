{include "_header.tpl"}
<section class="row">
  <h1 class="offset3">Contact</h1>
</section>

<section class="row">
  <form class="span4 offset3" methode="post" action="">
  	<fieldset>
	    <input type="text" name="name" placeholder="Name" size="50"/>
	    <input type="email" name="email" placeholder="E-mail" size="50"/>
	    <input type="text" name="subject" placeholder="Subject" size="50"/>
	    <textarea name="message" cols="60" placeholder="Message"></textarea>
      <input type="submit" name="send"value="Send">
    </fieldset>
  </form>
</section>
{include "_footer.tpl"}
