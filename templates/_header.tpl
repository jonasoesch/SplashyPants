<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Splashy Title</title>
      <link href="{$baseURL}/public/css/grid.css" rel="stylesheet" />
      <link href="{$baseURL}/public/css/normalize.css" rel="stylesheet" />
      <link href="{$baseURL}/public/css/typography.css" rel="stylesheet" />
      <link href="{$baseURL}/public/css/design.css" rel="stylesheet" />
      <link href="{$baseURL}/public/js/zoombox/zoombox.css" rel="stylesheet" /> 

    </head>
    <body>
    	<div class="container">
    	{if isset($smarty.session.flash) && $smarty.session.flash != ''}
    		<div class="row flash-message">
    			{pop_flash_message}
    		</div>
    	{/if}
<a href="{$baseURL}"><img src="{$baseURL}/public/images/TEDxlausanne.gif"/></a>

<nav class="menu row">
	<ul>
                <li class="span1"><a href="{$baseURL}/events">Events </a></li>
                <li class="span1"><a href="{$baseURL}/video">Videos </a></li>
                <li class="span1"><a href="{$baseURL}/about">About </a></li>
                <li class="span1"><a href="{$baseURL}/team">Team </a></li>
                <li class="span1"><a href="{$baseURL}/partners">Partners </a></li>
                <li class="span2"><a href="{$baseURL}/contact">Contact Us </a></li>
                <div class="span2 offset3" style="align:right;">
                    {if !$tedx->isLogged()}
                    	<a href="{$baseURL}/login"/>login</a> | <a href="{$baseURL}/register"/>register</a>
                    {/if} 
                    {if $tedx->isLogged()}
                    	<a href="{$baseURL}/logout"/>logout</a> | <a href="profile-form.php"/>admin</a>
                    {/if}
                   
                   
                </div>
    </ul>
</nav>
