<?php

namespace Sree;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $time;
    private $dbh;

    public function __construct() {
        global $dbh;
        $this->clients = array();
        $this->dbh = $dbh;
        // $this->time = time();
        echo "Congratulations! the server is now running\n";
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients[$conn->resourceId] = $conn;
        $this->saveConnection($conn->resourceId);
        echo "New connection! ({$conn->resourceId})\n";
        // echo $this->time;
    }

    public function onMessage(ConnectionInterface $from, $msg) {

        $numRecv = count($this->clients) - 1;
        // echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
        //     , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        // foreach ($this->clients as $key => $client) {
        //     if ($from !== $client) {
        //         // The sender is not the receiver, send to each client connected
        //         $client->send($msg);
        //     }
        // }
        // Send a message to a known resourceId (in this example the sender)
        // echo $from->resourceId;

        $client = $this->clients[$from->resourceId];

        $client->send("Message successfully sent to $numRecv users.");
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        unset($this->clients[$conn->resourceId]);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }


    /* My custom functions */
    public function saveConnection($resourceId){
        $sql = $this->dbh->query("SELECT * FROM `usermap` WHERE resourceId = '$resourceId'");
        $msgs = $sql->fetchAll();
        if (!$msgs){
            $sql = $this->dbh->query("INSERT INTO usermap (name, resourceId, status) VALUES ('njanTanne',$resourceId, 0 ) ");
            $msgs = $sql->fetchAll();
        }

        return true;

    }
}