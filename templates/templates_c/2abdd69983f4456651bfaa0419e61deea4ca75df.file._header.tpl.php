<?php /* Smarty version Smarty-3.1.13, created on 2013-06-19 01:43:03
         compiled from "/Applications/MAMP/htdocs/tedxEventManager/SplashyPants/templates/_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3180044451c0f087e49ae9-68948665%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2abdd69983f4456651bfaa0419e61deea4ca75df' => 
    array (
      0 => '/Applications/MAMP/htdocs/tedxEventManager/SplashyPants/templates/_header.tpl',
      1 => 1371563223,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3180044451c0f087e49ae9-68948665',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'baseURL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c0f087e80ee2_36326589',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c0f087e80ee2_36326589')) {function content_51c0f087e80ee2_36326589($_smarty_tpl) {?><!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Splashy Title</title>
      <link href="css/grid.css" rel="stylesheet" />
      <link href="css/normalize.css" rel="stylesheet" />
      <link href="css/typography.css" rel="stylesheet" />
      <link href="css/design.css" rel="stylesheet" />

    </head>
    <body>
    	<div class="container">
<a href="index.php"><img src="images/TEDxlausanne.gif" /></a>

<nav class="menu row">
	<ul>
                <li class="span1"><a href="event.php">Event </a></li>
                <li class="span1"><a href="video.php">Videos </a></li>
                <li class="span1"><a href="about.php">About </a></li>
                <li class="span1"><a href="team.php">Team </a></li>
                <li class="span1"><a href="partner.php">Partner </a></li>
                <li class="span2"><a href="contact.php">Contact Us </a></li>
                <div class="span2 offset3" style="align:right;">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
/login"/>login</a> | <a href="profile-form.php"/>register</a>
                </div>
    </ul>
</nav>
<?php }} ?>