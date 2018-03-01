<!DOCTYPE html>
<html>
    <head>
        <title>WebSocket PHP</title>
        <link type="text/css" rel="stylesheet" href="style.css" />
        <script src="websocket_client.js"></script>
    </head>
    <body onload="javascript:WebSocketSupport()">
        <div id="ws_support"></div>

        <div id="wrapper">
            <div id="menu">
                <h3 class="welcome">WebSocket PHP</h3>
            </div>

            <!-- <button id="initiateChat">Initiate Chat</button> -->

            <!-- <div id="hideDiv" style="display: none;"> -->
                <div id="chatbox"></div>

                <div id ="controls">
                    <label for="name"><b>Name</b></label>
                    <input name="chatname" type="text" id="chatname" size="67" placeholder="Type your name here"/>
                    <input name="msg" type="text" id="msg" size="63" placeholder="Type your message here" />
                    <input name="roomId" type="hidden" id="roomId" value="<?php echo "room". time(); ?>" />
                    <input name="sendmsg" type="submit"  id="sendmsg" value="Send" onclick="doSend(document.getElementById('msg').value)" />
                </div>
            <!-- </div> -->

        </div>

        <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            $("#initiateChat").click(function() {
                $("#hideDiv").css('display', 'inline');
                $(this).hide();
            });
        </script> -->
    </body>
</html>