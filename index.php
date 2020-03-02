<!DOCTYPE html>
<html>
    <head>
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

        <link rel="stylesheet" type="text/css" href="http://localhost/simple-chat-socket/chatui.css">


        <script src="http://localhost/simple-chat-socket/chatui.js"></script>

        <script>  

            $(document).ready(function(){
                var websocket = new WebSocket("ws://localhost:8090/demo/php-socket.php"); 
      
                websocket.onmessage = function(event) {
                    var Data    = JSON.parse(event.data);
                    var who     = Data.user_id;

                    insertChat(who,Data.message);
                    $('#chat-message').val('');
                };
                
                $('#frmChat').on("submit",function(event){
                    event.preventDefault();
                    var messageJSON = {
                        chat_user_id: $('#chat-user').val(), // ini buat id
                        chat_user: $('#chat-user').val(), // ini buat name user
                        chat_message: $('#chat-message').val() // ini buat message
                    };

                    websocket.send(JSON.stringify(messageJSON));
                });
            });
	    </script>


    </head>
    <body>
        <?php
            session_start();
        ?>
        <form name="frmChat" id="frmChat">
            <div class="col-sm-3 col-sm-offset-4 frame">
                <ul></ul>
                <div>
                    <div class="msj-rta macro">     
                        <input type="hidden" id="chat-user" value=<?php echo session_id();?>/>
                        <div class="text text-r" style="background:whitesmoke !important">
                            <input class="mytext" id="chat-message" placeholder="Type a message"/>
                        </div> 

                    </div>
                    <div style="padding:10px;">
                        <span class="glyphicon glyphicon-share-alt"></span>
                    </div>                
                </div>
            </div>    
        </form>   
    </body>
</html>

