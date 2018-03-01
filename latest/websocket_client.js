var output;

var websocket;

function WebSocketSupport()
{
    if (browserSupportsWebSockets() === false) {
        document.getElementById("ws_support").innerHTML = "<h2>Sorry! Your web browser does not supports web sockets</h2>";

        var element = document.getElementById("wrapper");
        element.parentNode.removeChild(element);

        return;
    }

    output = document.getElementById("chatbox");

    websocket = new WebSocket('ws:localhost:9911');

    websocket.onopen = function(e) {
        // console.log(e);
        writeToScreen("You have have successfully connected to the server");
    };

    websocket.onmessage = function(e) {
        onMessage(e)
    };

    websocket.onerror = function(e) {
        onError(e)
    };
}

function onMessage(e) {
    writeToScreen('<span style="color: blue;"> ' + e.data + '</span>');
}

function onError(e) {
    writeToScreen('<span style="color: red;">ERROR:</span> ' + e.data);
}

function doSend(message) {
    var validationMsg = userInputSupplied();
    if (validationMsg !== '') {
        alert(validationMsg);
        return;
    }
    var userName = document.getElementById('chatname').value;
    var roomId = document.getElementById('roomId').value;

    document.getElementById('msg').value = "";

    document.getElementById('msg').focus();

    var printMsg = '@<b>' + userName + '</b>: ' + message;
    var msg = '@<b>' + userName + '</b>: ' + message + '</b>: ' + roomId;;

    websocket.send(printMsg);

    writeToScreen(printMsg);
}

function writeToScreen(message) {
    var pre = document.createElement("p");
    pre.style.wordWrap = "break-word";
    pre.innerHTML = message;
    output.appendChild(pre);
}

function userInputSupplied() {
    var chatname = document.getElementById('chatname').value;
    var msg = document.getElementById('msg').value;
    if (chatname === '') {
        return 'Please enter your username';
    } else if (msg === '') {
        return 'Please the message to send';
    } else {
        return '';
    }
}

function browserSupportsWebSockets() {
    if ("WebSocket" in window)
    {
        return true;
    }
    else
    {
        return false;
    }
}