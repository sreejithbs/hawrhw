var app = require('express')();
var http = require('http').Server(app);
var socket = require('socket.io')(http);

var port = 8090;


var customer = {
    queue: [],
    chat: [],
    quit: [],
    total: 0
};


socket.on('connection', function(client){
    var username = false;
    var isStaff = false;
    client.on('login', function(data) {
        username = data.username;
        isStaff = data.isStaff;
    });
    client.on('subscribe', function(data) {
        if (data.room == "staff_lobby")
        {
            // staff subscribe
        }
        else
        {
            // customer subscribe
            if (! isStaff)
            {
                var exists = false;
                for (var i=customer.queue.length-1; i>=0; i--) {
                    if (customer.queue[i].username === username)
                    {
                        exists = true;
                        customer.queue[i].join_at = new Date().toISOString();
                        break;       //<-- Uncomment  if only the first term has to be removed
                    }
                }

                if (exists === false)
                {
                    customer.total++;
                    customer.queue.push({
                        id: customer.total,
                        username: username,
                        room: data.room,
                        status: 'new',
                        join_at: new Date().toISOString()
                    });
                }
            }
            else
            {
                // if staff will update queue is talked
                for (var i=customer.queue.length-1; i>=0; i--) {
                    if (customer.queue[i].username === data.room)
                    {
                        customer.queue[i].status = "staff talked";
                        break;       //<-- Uncomment  if only the first term has to be removed
                    }
                }
            }


            client.join(data.room);
            if (! isStaff)
            {
                socket.in(data.room).emit('message', {
                    sender: username,
                    message: username + " start private chat. You are "+ customer.total + ".",
                    send_at: new Date().toISOString(),
                    isStaff: isStaff
                });

            }
            else
            {
                socket.in(data.room).emit('message', {
                    sender: username,
                    message: username + " start private chat.",
                    send_at: new Date().toISOString(),
                    isStaff: isStaff
                });
            }
            socket.in("staff_lobby").emit('new_user', {});

        }

        console.log('joining room', username, data.room);
    });

    // note http://stackoverflow.com/questions/9418697/how-to-unsubscribe-from-a-socket-io-subscription

    client.on('unsubscribe', function(data) {

        // if staff will update queue is talked
        for (var i=customer.queue.length-1; i>=0; i--) {
            if (customer.queue[i].username === data.room)
            {
                customer.queue[i].status = "out";
                break;       //<-- Uncomment  if only the first term has to be removed
            }
        }

        // remove from queue
        for (var i=customer.queue.length-1; i>=0; i--) {
            if (customer.queue[i].username === username)
            {
                customer.queue.splice(i, 1);
                break;       //<-- Uncomment  if only the first term has to be removed
            }
        }

        console.log('leaving room', data.room);
        socket.in(data.room).emit('message', {
            sender: username,
            message: username + " leave from this chat.",
            send_at: new Date().toISOString()
        });
        client.leave(data.room);
    });

    client.on('send', function(data) {
        console.log('sending message');
        socket.in(data.room).emit('message', {
            sender: username,
            message: data.message,
            send_at: new Date().toISOString(),
            isStaff: isStaff
        });
    });
});

app.get('/customer/queue', function(req, res) {
    res.json(customer.queue);
});

http.listen(port, function(){
    console.log('listening on *:'+port);
});