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
    	<div class="row info">{$debug}</div>
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
                    {if !$tedx->isLogged()}<a href="{$baseURL}/login"/>login</a>{/if} 
                    {if $tedx->isLogged()}<a href="{$baseURL}/logout"/>logout</a>{/if}
                    | 
                    <a href="profile-form.php"/>register</a>
                </div>
    </ul>
</nav>
