<?php

$host = $_GET['host'];
if ( (!isset($host)) || !strlen($host) ) {
	exit;
}

$host = str_replace("\r", "", $host);

?>

<?php

require_once 'mod_dbase.php';
require_once 'config.php';

$dbase = db_open_byname('INFORMATION_SCHEMA');
if (!$dbase) exit;

$content .= "<script>\n";
$content .= "function ajax_delrep(num) {\n";
$content .= "	var fndel = document.getElementById('del' + num);\n";
$content .= "	if (!fndel)\n";
$content .= "		return false;\n";
$content .= "	fndel.onclick();\n";
$content .= "	return true;\n";
$content .= "}\n";
$content .= "\n";
$content .= "function callback(body, i) {\n";
$content .= "	var rsltel = document.getElementById('sub_div_ajax_del' + i);\n";
$content .= "	rsltel.innerHTML = body;\n";
$content .= "	ajax_delrep(i + 1);\n";
$content .= "}\n";
$content .= "function delrep_fill(i, date) {\n";
$content .= "	var pdata = ajax_getInputs(\"frm_delinfo\"); \n";
$content .= "	ajax_pload(\"mod_hostdelete_sub.php?dt=\" + date, pdata, 'sub_div_ajax_del' + i, '<table><tr><td valign=\"center\"><img border=\"0\" src=\"img/ajax-loader(2).gif\" alt=\"ajax-loader\" title=\"Plz, wait a few sec.\"></td><td valign=\"center\"><i> Loading ...</i></td></tr></table>', callback, i);\n";
$content .= "}\n";
$content .= "</script>\n";

$sql = ' SELECT TABLE_NAME'
	 . '   FROM TABLES'
	 . " WHERE TABLES.TABLE_SCHEMA = '" . DB_NAME . "'"
	 . "   AND TABLES.TABLE_NAME LIKE 'rep2_%'";
$res = mysqli_query($dbase, $sql);
if ((@($res)) && mysqli_num_rows($res) > 0) {
	$i = 0;
	
	$content .= "<form id='frm_delinfo' name='frm_delinfo'>\n";
	$content .= "<input type='hidden' name='host' value='$host'>\n";
	$content .= "</font>\n\n";
	
	$tfirst = null;
	
	while (list($table) = mysqli_fetch_array($res)) {
		if (!$tfirst) $tfirst = $table;
		$content .= "<table width='450' border='1' cellspacing='0' cellpadding='3' style='border: 1px solid #BBBBBB; font-size: 9px; border-collapse: collapse; background-color: #376D7C;'>";
		$content .= "<th style=' color: #EEEEEE;'>";
		$content .= substr($table, 5, 4) . '/' . substr($table, 9, 2) . '/' . substr($table, 11, 2);
		$content .= '</th>';
		$content .= "<tr align='center' valign='middle' style=' background-color: #cce7ef; '>";
		$content .= '<td id="sub_div_ajax_del' . $i . '">';
		$content .= '<a id="del' . $i . '" href="#null" onclick="delrep_fill(' . $i . ', ' . substr($table, 5, 8) . '); return false;">';
		$content .= '<table><tr><td valign="center"><img border="0" src="img/ajax-loader(2).gif" alt="ajax-loader" title="Deleting reports ... please, be cool"></td><td valign="center"></td></tr></table>';
		$content .= '</a>';
		$content .= '</td>';
		$content .= '</tr>';
		$content .= "<tr style=' background-color: #e7f2f6; '>";
		$content .= "<td></td>";
		$content .= '</tr>';
		$content .= '</table>';
		
		$i++;
	}
}

db_close($dbase);

$content .= "<script> delrep_fill(0, '" . substr($tfirst, 5, 8) . "'); </script>";

require_once 'frm_skelet.php';
echo get_skelet('Hosts delete', $content);
?>