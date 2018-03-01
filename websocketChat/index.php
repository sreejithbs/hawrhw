<?php
include "config.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="cdn/jquery.js"></script>
		<script src="cdn/ws.js"></script>
		<script src="cdn/chat.js"></script>
		<link href="cdn/chat.css" rel="stylesheet"/>
		<title>Live Group Chat In PHP</title>
	</head>
	<body>
		<div id="content" style="margin-top:10px;height:100%;">
			<center><h1>Live Group Chat In PHP</h1></center>
			<div class="chatWindow">
				<div class="users"></div>
				<div class="chatbox">
					<div class="status">Offline</div>
					<div class="chat">
						<div class="msgs"></div>
	 					<form id="msgForm">
							<input type="text" size="30" />
							<button>Send</button>
						</form>
					</div>
					<div class="login">
						<p>Type in your name to start chatting !</p>
						<form id="loginForm">
							<input type="text" />
							<button>Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- http://subinsb.com/live-group-chat-with-php-jquery-websocket -->
	</body>
</html>