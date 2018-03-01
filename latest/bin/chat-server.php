<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Sree\Chat;

    require dirname(__DIR__) . '/vendor/autoload.php';
    require dirname(__DIR__) . '/config.php';

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat()
            )
        ),
        9911
    );

    $server->run();