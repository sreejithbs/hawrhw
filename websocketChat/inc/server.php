<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

function shutdown(){
	global $docRoot;
	file_put_contents("$docRoot/inc/serverStatus.txt", "0");
	require_once "$docRoot/inc/startServer.php";
}
register_shutdown_function('shutdown');
if( isset($startNow) ){
	require_once "$docRoot/inc/vendor/autoload.php";
	require_once "$docRoot/inc/class.chat.php";
	$server = IoServer::factory(
		new ChatServer(),
		8080,
		"127.0.0.1"
	);
	$server->run();
}
?>