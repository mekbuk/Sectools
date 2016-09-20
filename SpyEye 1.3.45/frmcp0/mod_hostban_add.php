<?php

$host = $_GET['host'];
if ( (!isset($host)) || !strlen($host) ) {
	$host = false;
	$hosts = $_POST['hosts'];
	if ( (!isset($hosts)) ) {
		exit;
	}
}

require_once 'mod_file.php';
require_once 'mod_dbase.php';

$dbase = db_open($dbase);

while (true) {	

if ($host !== false) {

$host = str_replace("\r", "", $host);

// host is unique?
$sql = "SELECT host FROM hostban WHERE host = '$host' LIMIT 1";
$res = mysqli_query($dbase, $sql);
if (!@$res) {
	// error
	writelog("error.log", "Wrong query : $sql");
	$content .= "<font class='error'>ERROR</font> : Wrong query : $sql<br><br>";
	break;
}
else if (mysqli_num_rows($res) == 1) {
	// no
	$content .= "<font class='error'>ERROR</font> : Host \"$host\" already exists!<br><br>";
}
else {
	// yep

	// insert new
	$sql = "INSERT INTO hostban VALUES (NULL, '$host')";

	mysqli_query($dbase, $sql);
	if (!mysqli_affected_rows($dbase)) {
		writelog("error.log", "Wrong query : $sql");
		$content .= "<font class='error'>ERROR</font> : Wrong query : $sql<br><br>";
		break;
	}
}

}

else {

$sql = 'DELETE FROM hostban';
mysqli_query($dbase, $sql);

$match = preg_split("/\n/", $hosts);
if (count($match)) {
	for ($i = 0; $i < count($match); $i++) {
		//$thost = trim($match[$i]);
		$thost = $match[$i];
		$thost = str_replace("\r", "", $thost);
		if (!strlen($thost)) continue;
		
		$sql = "INSERT INTO hostban VALUES (NULL, '$thost')";

		mysqli_query($dbase, $sql);
		if (!mysqli_affected_rows($dbase)) {
			writelog("error.log", "Wrong query : $sql");
			$content .= "<font class='error'>ERROR</font> : Wrong query : $sql<br><br>";
			//break;
		}
	}
}

}

// select *
$sql = "SELECT host FROM hostban";
$res = mysqli_query($dbase, $sql);
if (!(@($res))) {
	writelog("error.log", "Wrong query : \" $sql \"");
	$content .= "<font class='error'>ERROR</font> : Wrong query : $sql<br><br>";
	break;
}

$content .= "<form name='frm_hostban' id='frm_hostban'>\n";
$content .= "<textarea name='hosts' style=' border-width: 1px; width: 340px; height: 360px; background-color: #e7f2f6; color: #666666; ' >\n";
while ( list($thost) = mysqli_fetch_row($res) ) { 
	$content .= "$thost\n";
}
$content .= "</textarea><br><br>";

$content .= "<input type='button' value='submit' onclick='var pdata = ajax_getInputs(\"frm_hostban\"); ajax_pload(\"mod_hostban_add.php\", pdata, \"div_ajax\"); return false;'>\n";
$content .= "</form>\n";

if ($host === false) {
	db_close($dbase);
	echo $content;
	exit;
}

break;
}

db_close($dbase);

require_once 'frm_skelet.php';
echo get_skelet('Banned hosts', $content);
?>