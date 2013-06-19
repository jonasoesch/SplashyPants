<!DOCTYPE html>
<html lang="en">
  <head>
    {* Comment *}
    <title>Smarty</title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
  </head>
  <body>
    <h2>{$nom}</h2>
    <p>{$prenom|default: "Prenom par defaut"|upper}</p>


    <ul>
      <li>{$person.prenom|capitalize}</li>
      <li>{$person.nom|escape: 'url'}</li>
      <li>{$smarty.now|date_format: "%e. %b %Y"}</li>
    </ul>

    {* Foreach Loop *}
  <ul>
    {foreach $list as $item}
    <li style="background-color: {cycle values='#fff, #ccc'}">
      {$item@key} : {$item} 
    </li>
    {foreachelse}
    <li>Nothing found</li>
    {/foreach}
      @key, @index, @iteration, @first, @last, @total
  </ul>


  {if $users}
    <p>Jap</p>
  {elseif $nom}
    <p>Jap jap</p>
  {else}
    <p>Nope</p>
  {/if}

  <p>
    {literal}
      function() { alert('literal')}
    {/literal}
  </p>

  <p> Maintentant: {$smarty.now|date_format: "%d.%m.%Y %H:%M:%S"}</p>

  <p>
    {$lorem|truncate: 40}
  </p>

<h2>Table</h2>
{html_table loop=$table cols="Nom, Prenom"}


  <h2>Checkboxes</h2>
  {html_checkboxes name="cheggi" options=$checkboxes selected='three' separator="<br />"}

  <h2>Radios</h2>
  {html_radios name="radii" options=$checkboxes selected='three' separator="<br />"}

  <h2>Options</h2>
  {html_options name="opti" options=$checkboxes selected='two'}


  <h2>Date & Time</h2>
  {html_select_date} {html_select_time use_24_hours=true}


    {include "include.tpl" local_var="This is local to the include"}
  </body>
</html>

