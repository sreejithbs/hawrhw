<?php

class MultiRoomServerTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var array
     */
    protected $connections;

    public function setUp()
    {
        $this->connections = array();
        for ($i=0; $i<4; $i++) {
            $connection = $this->getMockBuilder('Ratchet\ConnectionInterface')
                ->setMethods(array('send','close'))
                ->getMock();
            $connection->resourceId = 'connection'.$i;

            $this->connections[] = $connection;
        }
    }

    /**
     * @expectedException pmill\Chat\Exception\MissingActionException
     */
    public function testMissingAction()
    {
        $packet = array(
            'roomId'=>'room1',
            'userName'=>'User 1',
        );

        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode($packet));
    }

    /**
     * @expectedException pmill\Chat\Exception\InvalidActionException
     */
    public function testInvalidAction()
    {
        $packet = array(
            'roomId'=>'room1',
            'userName'=>'User 1',
            'action'=>'invalid-action',
        );

        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode($packet));
    }

    public function testCreateRoom()
    {
        $packet = array(
            'roomId'=>'room1',
            'userName'=>'User 1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        );

        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode($packet));

        $rooms = $server->getRooms();
        $this->assertArrayHasKey('room1', $rooms);
    }

    public function testJoinExistingRoom()
    {
        $packet = array(
            'roomId'=>'room1',
            'userName'=>'User 1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        );

        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->setRooms(array('room1'=>array()));
        $server->onMessage($this->connections[0], json_encode($packet));

        $rooms = $server->getRooms();
        $this->assertArrayHasKey('room1', $rooms);
        $this->assertArrayHasKey('connection0', $rooms['room1']);
    }

    public function testCreateClient()
    {
        $packet = array(
            'roomId'=>'room1',
            'userName'=>'User 1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        );

        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode($packet));

        $clients = $server->getClients();
        $this->assertArrayHasKey('connection0', $clients);
        $this->assertInstanceOf('\pmill\Chat\ConnectedClient', $clients['connection0']);
    }

    public function testUserWelcomeMessage()
    {
        $this->connections[0]
            ->expects($this->at(0))
            ->method('send')
            ->with($this->callback(function($packet){
                $packet = json_decode($packet, true);
                return $packet['message'] == 'Welcome User 1!';
            }));

        $packet = array(
            'roomId'=>'room1',
            'userName'=>'User 1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        );

        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode($packet));
    }

    public function testUserConnectedListClientsMessage()
    {
        $this->connections[0]
            ->expects($this->at(1))
            ->method('send')
            ->with($this->callback(function($packet){
                $packet = json_decode($packet, true);
                return $packet['clients'][0]['name'] == 'User 1';
            }));

        $packet = array(
            'roomId'=>'room1',
            'userName'=>'User 1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        );

        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode($packet));
    }

    public function testOtherUserConnectedMessage()
    {
        $this->connections[0]
            ->expects($this->at(2))
            ->method('send')
            ->with($this->callback(function($packet){
                $packet = json_decode($packet, true);
                return $packet['message'] == 'User 2 has connected';
            }));

        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode(array(
            'roomId'=>'room1',
            'userName'=>'User 1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        )));

        $server->onMessage($this->connections[1], json_encode(array(
            'roomId'=>'room1',
            'userName'=>'User 2',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        )));
    }

    public function testListClientsMessage()
    {
        $this->connections[0]
            ->expects($this->at(2))
            ->method('send')
            ->with($this->callback(function($packet){
                $packet = json_decode($packet, true);
                return $packet['clients'][0]['name'] == 'User 1';
            }));

        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode(array(
            'roomId'=>'room1',
            'userName'=>'User 1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        )));

        $server->onMessage($this->connections[0], json_encode(array(
            'roomId'=>'room1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_LIST_USERS,
        )));
    }

    public function testSendMessage()
    {
        $this->connections[0]
            ->expects($this->at(2))
            ->method('send')
            ->with($this->callback(function($packet){
                $packet = json_decode($packet, true);
                return $packet['message'] == 'test message body';
            }));

        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode(array(
            'roomId'=>'room1',
            'userName'=>'User 1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        )));

        $server->onMessage($this->connections[0], json_encode(array(
            'roomId'=>'room1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_MESSAGE_RECEIVED,
            'timestamp'=>time(),
            'message'=>'test message body',
        )));
    }

    public function testDisconnectedClientIsRemovedFromRoom()
    {
        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode(array(
            'roomId'=>'room1',
            'userName'=>'User 1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        )));

        $server->onClose($this->connections[0]);

        $rooms = $server->getRooms();
        $this->assertArrayNotHasKey('connection0', $rooms['room1']);
    }

    public function testErroredClientIsDisconnected()
    {
        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode(array(
            'roomId'=>'room1',
            'userName'=>'User 1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        )));

        $server->onError($this->connections[0], new \Exception('example error'));

        $rooms = $server->getRooms();
        $this->assertArrayNotHasKey('connection0', $rooms['room1']);
    }

    public function testDisconnectedClientMessageSent()
    {
        $this->connections[0]
            ->expects($this->at(3))
            ->method('send')
            ->with($this->callback(function($packet){
                $packet = json_decode($packet, true);
                return $packet['message'] == 'User 2 has left';
            }));

        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode(array(
            'roomId'=>'room1',
            'userName'=>'User 1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        )));

        $server->onMessage($this->connections[1], json_encode(array(
            'roomId'=>'room1',
            'userName'=>'User 2',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        )));

        $server->onClose($this->connections[1]);
    }

    /**
     * @expectedException pmill\Chat\Exception\ConnectedClientNotFoundException
     */
    public function testFindClientException()
    {
        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode(array(
            'roomId'=>'room1',
            'message'=>'message',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_MESSAGE_RECEIVED,
        )));
    }

    public function testRoomClientsNotReceivingMessagesFromOtherRooms()
    {
        $this->connections[1]
            ->expects($this->at(2))
            ->method('send')
            ->with($this->callback(function($packet){
                $packet = json_decode($packet, true);
                return $packet['message'] == 'message example';
            }));

        // User 3 expects welcome message, user list message, and User 4 connected
        $this->connections[2]
            ->expects($this->exactly(3))
            ->method('send')
            ->withAnyParameters();

        // User 4 only expects welcome message and user list message
        $this->connections[3]
            ->expects($this->exactly(2))
            ->method('send')
            ->withAnyParameters();

        $server = new \pmill\Chat\BasicMultiRoomServer;
        $server->onMessage($this->connections[0], json_encode(array(
            'roomId'=>'room1',
            'userName'=>'User 1',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        )));

        $server->onMessage($this->connections[1], json_encode(array(
            'roomId'=>'room1',
            'userName'=>'User 2',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        )));

        $server->onMessage($this->connections[2], json_encode(array(
            'roomId'=>'room2',
            'userName'=>'User 3',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        )));

        $server->onMessage($this->connections[3], json_encode(array(
            'roomId'=>'room2',
            'userName'=>'User 4',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_USER_CONNECTED,
        )));

        $server->onMessage($this->connections[0], json_encode(array(
            'roomId'=>'room1',
            'message'=>'message example',
            'action'=>\pmill\Chat\BasicMultiRoomServer::ACTION_MESSAGE_RECEIVED,
        )));
    }

}