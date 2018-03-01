# Example-chatroom-with-NodeJS-PHP
Example chatroom project with crossing use between NodeJS PHP Socket.io and Express. This one for demo customer service system with lobby for staff.

# How to run
- Put this project to folder of apache or nginx that can run PHP.
- run `npm install` to install node package. This require express and socket.io.
- run `node chat.js` for run websocket/api server.

# How to use
- Open index.php page to get login page as customer.
- Open staff.php page to get login page as customer service staff.
- Staff can send preview link by insert link to message box and append link with `#preview` for make url can click and open iframe below chat box. (Example: `http://ethaizone.com#preview`)
Try it. Simple and plan.

# License
For learning perpose only. If you want similar project, contact me. I will cast magic and make it best for you.

# Warning
This project is quick and dirty example. I don't implement any security protection.

# Screenshots
![Login](/screenshots/login.png)
![Chat](/screenshots/chat.png)
![Staff lobby](/screenshots/staff_lobby.png)