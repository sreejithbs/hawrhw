<!doctype html>
<html>
    <head>
        <title>Staff Page</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <!-- auto refresh. I can use ajax but it's demo. --> 
        <meta http-equiv="refresh" content="3" >
        <style>
        </style>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <br><br>
            <div class="well col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User no.</th>
                            <th>Name</th>
                            <th>Join at</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php 
                        $queue = json_decode(file_get_contents("http://".$_SERVER['HTTP_HOST'].":3421/customer/queue"), true);
                    ?>
                    <tbody>
                        <?php if (count($queue) > 0): ?>
                            <?php foreach ($queue as $key => $data): ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['username']; ?></td>
                                    <td><?php echo $data['join_at']; ?></td>
                                    <td><?php echo $data['status']; ?></td>
                                    <td>
                                        <?php if ($data['status'] == "new"): ?>
                                    <a href="chat.php?username=<?php echo $_GET['username']; ?>&join=<?php echo $data['username']; ?>" target="_blank">Chat!</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="5">
                                No customer in lobby.
                            </td>
                        </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
        <script>
            // var socket = io('//<?php echo $_SERVER['HTTP_HOST']; ?>:3421');
            // socket.connect(); 
            // socket.emit('subscribe', {room: 'staff_lobby'});
            // socket.on('update_staff_lobby', function(data){
            //     // $('tbody').html(data.html);
            // });
        </script>
    </body>
</html>