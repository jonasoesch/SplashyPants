{include "_header.tpl"}
<header class="row">
  <h1 class="offset4 span4">Get access</h1>
</header>
<div class="row">
  <form class="span4 offset4" action="login" method="POST" >
    <label for="username">Username</label>
    <input type="text" name="username" placeholder="SplashyPants" />
    <label for="Password">Password</label>
    <input type="password" name="password" placeholder="Pssst… It's a secret" />
    <input type="submit" value="Login">
  </form>
</div>
{include "_footer.tpl"}
