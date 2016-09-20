<?php

require_once 'config.php';

function db_open() {
	$dbase = mysqli_connect (DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
	
	if (mysqli_connect_errno()) {
		printf ("<font class='error'>Connect failed</font> : %s\n", mysqli_connect_error());
		return null;
	}
	
	return $dbase;
}

function db_open_byname($dbname) {
	$dbase = mysqli_connect (DB_SERVER, DB_USER, DB_PASSWORD, $dbname);
	
	if (mysqli_connect_errno()) {
		printf ("<font class='error'>Connect failed</font> : %s\n", mysqli_connect_error());
		return null;
	}
	
	return $dbase;
}

function db_close($dbase) {
	mysqli_close($dbase);
}

?>