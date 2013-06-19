<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Splashy Title</title>
      <link href="{$baseURL}/public/css/grid.css" rel="stylesheet" />
      <link href="{$baseURL}/public/css/normalize.css" rel="stylesheet" />
      <link href="{$baseURL}/public/css/typography.css" rel="stylesheet" />
      <link href="{$baseURL}/public/css/design.css" rel="stylesheet" />

    </head>
    <body>
    	<div class="container">
    	{if isset($smarty.session.flash) && $smarty.session.flash != ''}
    		<div class="row info">
    			{pop_flash_message}
    		</div>
    	{/if}
<a href="index.php"><img src="{$baseURL}/public/images/TEDxlausanne.gif" /></a>

<nav class="menu row">
	<ul>
                <li class="span1"><a href="event.php">Event </a></li>
                <li class="span1"><a href="video.php">Videos </a></li>
                <li class="span1"><a href="about.php">About </a></li>
                <li class="span1"><a href="team.php">Team </a></li>
                <li class="span1"><a href="partner.php">Partner </a></li>
                <li class="span2"><a href="contact.php">Contact Us </a></li>
                <div class="span2 offset3" style="align:right;">
                    {if !$tedx->isLogged()}
                    	<a href="{$baseURL}/login"/>login</a> | <a href="profile-form.php"/>register</a>
                    {/if} 
                    {if $tedx->isLogged()}
                    	<a href="{$baseURL}/logout"/>logout</a> | <a href="profile-form.php"/>admin</a>
                    {/if}
                   
                   
                </div>
    </ul>
</nav>
