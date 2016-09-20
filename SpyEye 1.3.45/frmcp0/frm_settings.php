<?php

	require_once 'php/ini.php';
	
	$ini = INI::read('config.ini');
	
	$stat = 0;
	if ((@$_POST) && $_POST['isIni']) {
		foreach ($_POST as $key => $value) {
			$pos = strpos($key, '|');
			$key1 = substr($key, 0, $pos);
			$key2 = substr($key, $pos + 1);
			if (strlen($key1))
				$ini[$key1][$key2] = $value;
		}
		is_writeable('config.ini') ? $stat = 1 : $stat = -1;
		INI::write('config.ini', $ini);
	}
	
	echo "<form method='post' id='frm_settings'>\n";
	echo "<input type=\"hidden\" name=\"isIni\" value=\"1\">";
	echo "<table>\n";
	foreach ($ini as $key => $value) {
		echo "<tr align=\"left\">\n";
		echo "<td colspan=\"2\"><span id=\"$key\"><b>$key</b><span></td>\n";
		echo "</tr>\n";
		foreach ($value as $subkey => $subvalue) {
			echo "<tr align=\"left\">\n";
			$ln = strlen($subvalue) + 5;
			echo "<td>$subkey:</td><td><input name=\"$key|$subkey\" id=\"$key|$subkey\" value=\"$subvalue\" size=\"" . (($ln < 60) ? $ln : 60) . "\"><br></td>\n";
			echo "</tr>\n";
		}
	}
	echo "<tr><td colspan=\"2\" align=\"center\"><input type='submit' value='Save' onclick=\"var pdata = ajax_getInputs('frm_settings'); ajax_pload('frm_settings.php', pdata, 'div_ajax'); return false;\"></td></tr>";
	echo "</table>\n";
	echo "</form>\n";
	
?>

<?php
	
	if ($stat) {
		($stat > 0) ? $msg = "<span><font class='ok'>OK</font></span> changes are saved</small></font>" : $msg = "<span><font class='error'>ERROR</font></span> cannot write to INI-file</small></font>";
		echo "<div align='left' height='30px' style='border-top: 1px solid black; padding: 2px; position: relative; background-color: rgb(231, 231, 231); bottom: -10px; left: -10px; right: -10px; margin-right: -20px; margin-bottom: 0px;'><font class='comment'><small><b>info: </b>$msg</div>";
	}
?>