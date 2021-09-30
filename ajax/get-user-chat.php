<?php
session_start();
	// include database and object files
    include_once '../web-api/config/db.php';
    include_once '../web-api/config/core.php';
    include_once '../web-api/objects/user.php';
    include_once '../web-api/objects/chat.php';

// instantiate database and user object

    $database = new Database();
    $db = $database->getConnection();

    $user = new user($db);
    
	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();
	
	// initialize user object
	$user = new user($db);
	$chat= new chat($db);
    $user->user_id=$_REQUEST['receiver_id'];
    $stmt=$user->getUserDataByUserID();
    $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
    
echo '<div class="chat-box"  id="chat-box-message">
     <div class="chat-header">
        <div class="user-details-chat">
            <div class="chat-user-image">';
        if(!empty($user_data[user_profile_photo])){
            
        
        echo '<img class="user-avtar" src="'.$user_data[user_profile_photo].'" />';
        }else{
              echo '<img class="user-avtar" src="assets/images/user.png" />';
        }
           echo '</div>
            <div class="details">
            <h6 class="username">'.$user_data[user_name].'</h6>
           <span class="online-chat"><img class="online" src="/assets/images/home/online.png">Online</span>
            </div>
            </div>
        <div class="user-functions">
            <img src="/assets/images/chat/head.png" class="calling-icon">
            <img src="/assets/images/chat/medal.png" class="bookmark-icon">
        </div>
        </div>
    <div class="chat-body">
        <div class="messages">
          
        </div>
    </div>
    <div class="chat-footer">
<textarea class="message_send" id="messageToBeSend" placeholder="Type, paste, cut text here..."></textarea>
  <button class="btn message-send" id="send" onclick="sendMessageToFirebase()"><img src="/assets/images/chat/send.png" class="send-button"></button>
    </div>
    </div>';