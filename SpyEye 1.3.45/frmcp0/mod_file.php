<?php

function writelog ($url, $data)
{
     $url = trim(htmlspecialchars($url));
     $f = fopen($url, "a");
     fwrite($f, date("r") . "  -  " . $data . "\n");
     fclose($f);
}

function writefile ($url, $data)
{
     $url = trim(htmlspecialchars($url));
     $f = fopen($url, "a");
     $res = fwrite($f, $data . "\n");
     fclose($f);
	 return res;
}


?>