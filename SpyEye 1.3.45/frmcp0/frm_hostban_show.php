<?php

require_once 'mod_file.php';
require_once 'mod_dbase.php';

$dbase = db_open($dbase);

// select *
$sql = "SELECT host FROM hostban";
$res = mysqli_query($dbase, $sql);
if (!(@($res))) {
	writelog("error.log", "Wrong query : \" $sql \"");
	$content .= "<font class='error'>ERROR</font> : Wrong query : $sql<br><br>";
	break;
}

$content .= "<textarea name='hosts' style=' border-width: 1px; width: 340px; height: 360px; background-color: #e7f2f6; color: #666666; ' >\n";
while ( list($thost) = mysqli_fetch_row($res) ) { 
	$content .= "$thost\n";
}
$content .= "</textarea>";

db_close($dbase);

require_once 'frm_skelet.php';
echo get_skelet('Banned hosts', $content, true);
?>