<?php

function get_skelet ($title, $content, $class = 'div_smmain', $skipauth = false) {

$res = '<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>' . $title . '</title>
		<link href="css/style.css" type=text/css rel=stylesheet>
		<script type="text/javascript" src="js/ajax.js"></script>
		
	</head>
	<body>

	<center>
	<div id="div_smmain" class="' . $class . '">
		
		<noscript>
		<font class="error">Your JavaScript is turned off. Please, enable your JS.</font>
		</noscript>';
	
		if (!$skipauth) {
			require_once 'mod_auth.php';
			if (auth()) {
				$res .= '<!-- ajax container -->
				<div id="div_ajax" align="center">' . $content . '</div>';
			}
		}
		else {
			$res .= '<!-- ajax container -->
				<div id="div_ajax" align="center">' . $content . '</div>';
		}
		
		$res .= '
		
	</div>
	</center>
	
	<script>
	if (navigator.userAgent.indexOf("Mozilla/4.0") != -1) {
		alert("Your browser is not support yet. Please, use another (FireFox, Opera, Safari)");
		document.getElementById("div_main").innerHTML = "<font class=\'error\'>ChAnGE YOuR BRoWsEr! Dont use BUGGED Microsoft products!</font>";
	}
	</script>
	
	</body>
</html>';

return $res;

}