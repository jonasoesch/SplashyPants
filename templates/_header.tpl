<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
      <title>
        {if isset($title)}
          {$title}
        {else}
          TEDx
        {/if}
      </title>
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
    	  <header class="row">
      	  <a class="span8" href="{$baseURL}"><img src="{$baseURL}/public/images/TEDxLausanne.gif"/></a>
    	  </header>
<nav class="menu row">
	<ul>
                <li class="span1"><a class="link" href="{$baseURL}/events">Events </a></li>
                <li class="span1"><a class="link" href="{$baseURL}/video">Videos </a></li>
                <li class="span1"><a class="link" href="{$baseURL}/about">About </a></li>
                <li class="span1"><a class="link" href="{$baseURL}/team">Team </a></li>
                <li class="span1"><a class="link" href="{$baseURL}/partners">Partners </a></li>
                <li class="span2"><a class="link" href="{$baseURL}/contact">Contact Us </a></li>
                <div class="span2 offset3" style="align:right;">
                    {if !$tedx->isLogged()}
                    	<a class="link" href="{$baseURL}/login"/>login</a>
                         | 
                        <a class="link" href="{$baseURL}/register"/>register</a> 
                    {/if} 
                    {if $tedx->isLogged()}

                    	<a href="{$baseURL}/logout"/>logout</a> | {if $tedx->isAdministrator()|| $tedx->isSuperAdmin() || $tedx->isOrganizer() }<a href="{$baseURL}/admin"/>  admin</a>{/if}  
                    {/if}
                   
                   
                </div>
    </ul>
</nav>
