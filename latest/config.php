<?php
// ini_set("display_errors","on");
$docRoot	= realpath(dirname(__FILE__));
if( !isset($dbh) ){
	session_start();
	date_default_timezone_set("UTC");
	$host = "localhost"; // Hostname
	$port = "3306"; // MySQL Port : Default : 3306
	$user = "root"; // Username Here
	$pass = ""; //Password Here
	$db   = "chat"; // Database Name
	$dbh  = new PDO('mysql:dbname='.$db.';host='.$host.';port='.$port,$user,$pass);

}
?>