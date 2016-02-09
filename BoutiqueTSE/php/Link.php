<?php

//création de la liasion vers Base de donnée.
$link = @mysql_connect("localhost","root","12345");
if (!$link) {
	die('Impossible de se connecter : ' . mysql_error());
}
mysql_select_db("BoutiqueTSE",$link);



function htmtocode($content) {
	$content = str_replace("\n","<br>",str_replace("\r\n","<br>", str_replace(" ","&nbsp;", $content)));
	return $content;
}

function codetohtm($content) {
	$content = str_replace("<br>","\\n", str_replace("&nbsp;"," ", $content));
	return $content;
}
?>