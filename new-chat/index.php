<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
require_once __DIR__ . '/../models/db3.php';
echo "<link rel='stylesheet' href='/final project/new-chat/style.css'>";
if (!isset($_SESSION['user'])) {
    header("Location: ../controllers/authorization.php");
    exit();
} else {
?>
<div class="header-chat">
    <div class="chat-arrow">
    <a href="../views/index.php" class="chat-arrow"><img src="/final project/img/icons8-стрелка-48.png" alt=""></a>
    </div>
<div class="chat-title">
<p>Our experienced specialists are ready to answer your questions and help you at any time.</p>
</div>

</div>


<div id="msg_box"><p>Start a chat</p></div>
<div class="chat-inf">
<input type="text" id="msg">
<input type="button" id="btn" value="Send">

</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
   var conn = new WebSocket('ws://192.168.96.177:8080');
   conn.onopen = function(e) {
       console.log("Connection established!");

       jQuery('#btn').click(function() {
           var msg = jQuery('#msg').val();
           var name = "<?php echo $_SESSION['user']; ?>"; 

           var d = new Date();
           var day = d.getDate();
           var month = d.getMonth() + 1;
           var year = d.getFullYear();
           var hours = d.getHours();
           var minutes = d.getMinutes();
           var seconds = d.getSeconds();
           var fullDate = (day < 10 ? '0' : '') + day + '.' + (month < 10 ? '0' : '') + month + '.' + year;
           var fullTime = (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
           var content = {
               msg: msg,
               name: name,
               date: fullDate,
               time: fullTime
           };
           conn.send(JSON.stringify(content));

           var html = "<b>" + name + "</b> (" + fullDate + " " + fullTime + "): " + msg + "<br/>";

           var html = "<div class='chat-main'><span class='chat-t'>"+fullDate +"</span>"+ "<span class='chat-t'> ("+fullTime +")</span><br/>"+  "<b class='chat-name'>" + name + ": </b>" + msg + "<br/> <br/></div>";

           jQuery('#msg_box').append(html);
           jQuery('#msg').val('');
       });
   }; 

   conn.onmessage = function(e) {
       var getData = jQuery.parseJSON(e.data);
       var html = "<b>" + getData.name + "</b>: " + getData.msg + "<br/>";
       jQuery('#msg_box').append(html);
   };
</script>
<?php } ?>

</body>
</html>