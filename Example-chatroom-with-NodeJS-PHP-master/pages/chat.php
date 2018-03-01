<?php 
$room = null;
$headText = "";
if (!empty($_GET['username']))
{
    $room = $_GET['username'];
    $headText .= "You are ".$_GET['username'].".";
    if (!empty($_GET['join']))
    {
      $room = $_GET['join'];
      $headText .= "You want to talk with ".$_GET['join'].".";

  }

}
else
{
    var_dump("Who are you?");
    die();
}
?>
<!doctype html>
<html>
<head>
    <title>Socket.IO chat</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <style>
        .chat
        {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li
        {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li.left .chat-body
        {
            margin-left: 60px;
        }

        .chat li.right .chat-body
        {
            margin-right: 60px;
        }


        .chat li .chat-body p
        {
            margin: 0;
            color: #777777;
        }

        .panel .slidedown .glyphicon, .chat .glyphicon
        {
            margin-right: 5px;
        }

        .panel-body
        {
            overflow-y: scroll;
            height: 480px;
        }

        .url-preview {
            cursor: pointer;
        }

        ::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar
        {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }
        </style>
</head>
<body>
    <div class="container">
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-comment"></span> Chat
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            </button>
                            <ul class="dropdown-menu slidedown">
                                <li><a style="opacity: 0.4;"><span class="glyphicon glyphicon-refresh">
                                </span>Refresh</a></li>
                                <li><a style="opacity: 0.4;"><span class="glyphicon glyphicon-ok-sign">
                                </span>Available</a></li>
                                <li><a style="opacity: 0.4;"><span class="glyphicon glyphicon-remove">
                                </span>Busy</a></li>
                                <li><a style="opacity: 0.4;"><span class="glyphicon glyphicon-time"></span>
                                    Away</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><span class="glyphicon glyphicon-off"></span>
                                    Leave chat</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <ul class="chat chatlist">
                            
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <form action="">
                            <div class="input-group">
                                <input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." autocomplete="off">
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Send</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row iframe-box" style="margin-top: 10px; display: none;">
            <div class="col-md-12 well">
                <button type="button" class="close" data-dismiss="iframe-box" aria-label="Close" style="top: -10px;
  position: relative;" onclick="closeIframe()"><span aria-hidden="true">&times;</span></button>

                <iframe src="//www.google.com" height="300px;" width="100%" style="border: 0px solid;"></iframe>
            </div>
        </div>
    </div>


    <script type="template" id="show-message-as-other">
        <li class="left clearfix"><span class="chat-img pull-left">
            <?php if (empty($_GET['join'])): ?>
                <img src="//placehold.it/50/55C1E7/fff&amp;text=STAFF" alt="User Avatar" class="img-circle">
            <?php else: ?>
                <img src="//placehold.it/50/55C1E7/fff&amp;text=Cus" alt="User Avatar" class="img-circle">
            <?php endif; ?>
        </span>
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font username">xxx</strong> <small class="pull-right text-muted">
                        <span class="glyphicon glyphicon-time"></span><span class="send_at">xxx</span></small>
                </div>
                <p class="message"></p>
            </div>
        </li>
    </script>

    <script type="template" id="show-message-as-sender">
        <li class="right clearfix"><span class="chat-img pull-right">
            <img src="//placehold.it/50/FA6F57/fff&amp;text=ME" alt="User Avatar" class="img-circle">
        </span>
            <div class="chat-body clearfix">
                <div class="header">
                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span><span class="send_at">xxx</span></small>
                    <strong class="pull-right primary-font username">xxx</strong>
                </div>
                <p class="message"></p>
            </div>
        </li>
    </script>

    <script src="//cdn.socket.io/socket.io-1.2.0.js"></script>
    <script>
        var socket = io('//<?php echo $_SERVER['HTTP_HOST']; ?>:3421');
        var username = '<?php echo $_GET["username"]; ?>';
        var room = '<?php echo $room; ?>';
        var isStaff = <?php echo empty($_GET['join']) ? 'false' : 'true'; ?>;

        socket.emit('login', {username: username, isStaff: isStaff});
        socket.emit('subscribe', {room: room});

        window.onbeforeunload = function() {
            return "You're about to end your chat session, are you sure?";
        };

        $( window ).unload(function() {
            socket.emit('unsubscribe', {room: room});
            return "Bye now!";
        });

        $('form').submit(function(){
            socket.emit('send', { room: room, message: $('#message').val()});
            $('#message').val('');
            return false;
        });

        socket.on('message', function(data){
            var html = (data.sender == username) ? $("#show-message-as-sender") : $("#show-message-as-other");

            var $html = $(html.html());

            $html.find(".header .username").text(data.sender);
            $html.find(".header .send_at").text(data.send_at);

            data.message = $("<div/>").text(data.message).html();

            if (data.isStaff)
            {
                data.message = '<span class="label label-primary">Staff</span> ' + data.message;
            }

            var urlPattern = /(\b(https?):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
            var result = data.message.match(urlPattern);
            if (result)
            {
                for (var i=result.length-1; i>=0; i--) {
                    if (result[i].indexOf("#preview") > -1 && data.isStaff)
                    {
                        data.message = data.message.replace(result[i], '<span class="label label-info url-preview">'+result[i].replace("#preview", "")+'</span>');
                    }
                }
                
            }

            $html.find(".message").html(data.message);

            // console.log(msg);
            $('.chatlist').append($html);

            scrollToBottom($('.panel-body')[0]);
        });

        $(".chatlist").on('click', '.url-preview', function(e){
            var $this = $(this);
            $('.iframe-box iframe').attr("src",$this.text());
            $('.panel-body').height('150px');
            $('.iframe-box').fadeIn();
            scrollToBottom($('body')[0]);
        });

        function scrollToBottom($dom)
        {
            $dom.scrollTop = $dom.scrollHeight;
        }
        function closeIframe()
        {
            $('.iframe-box').hide();
            $('.panel-body').height('480px');
            scrollToBottom($('body')[0]);
        }
    </script>
</body>
</html>