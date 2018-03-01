<?php
require_once "vendor/autoload.php";

$port = 9911;
$server = new \pmill\Chat\BasicMultiRoomServer;

\pmill\Chat\BasicMultiRoomServer::run($server, $port);
