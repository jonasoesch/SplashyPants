<?php /* Smarty version Smarty-3.1.13, created on 2013-06-19 12:02:55
         compiled from "templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:141066433351c166970061e6-16694693%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81a0270564c79ee7a1c4f40d2a5e8bcfac7e3570' => 
    array (
      0 => 'templates/login.tpl',
      1 => 1371636165,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '141066433351c166970061e6-16694693',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c16697151d82_35256589',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c16697151d82_35256589')) {function content_51c16697151d82_35256589($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="row">
  <h1 class="offset4">Login</h1>
</div>
<div class="row">
  <form class="span4 offset4" action="login/do" method="POST" >
    <input type="text" name="username" placeholder="E-Mail" />
    <input type="password" name="password" placeholder="Password" />
    <input type="submit" value="Log In">
  </form>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>