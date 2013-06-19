<?php /* Smarty version Smarty-3.1.13, created on 2013-06-19 12:28:37
         compiled from "templates/_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:65913431751c0e1248cf2d0-00585371%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8b9eb93bcd3f5892a3f19ed8fdfdd400c7c5381' => 
    array (
      0 => 'templates/_header.tpl',
      1 => 1371637584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65913431751c0e1248cf2d0-00585371',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c0e1248dc280_14106672',
  'variables' => 
  array (
    'baseURL' => 0,
    'debug' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c0e1248dc280_14106672')) {function content_51c0e1248dc280_14106672($_smarty_tpl) {?><!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Splashy Title</title>
      <link href="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
/public/css/grid.css" rel="stylesheet" />
      <link href="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
/public/css/normalize.css" rel="stylesheet" />
      <link href="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
/public/css/typography.css" rel="stylesheet" />
      <link href="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
/public/css/design.css" rel="stylesheet" />

    </head>
    <body>
    	<div class="container">
    	<div class="row info"><?php echo $_smarty_tpl->tpl_vars['debug']->value;?>
</div>
<a href="index.php"><img src="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
/public/images/TEDxlausanne.gif" /></a>

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