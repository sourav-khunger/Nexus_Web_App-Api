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
    $user->user_social_id = $_SESSION['social_id'];
    $chat->user_id = $_SESSION['user_id'];
    $stmt=$chat->getAllChatMembersByChatID();
    $chats=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $i=0;
    echo '<div  id="chat-list" class="chat-body">';
    foreach($chats as $key=> $value)
    {
       if($chat->user_id==$value['joined_user'])
        {
        $user->user_id=$value['created_by'];
        }
        else{
        $user->user_id=$value['joined_user'];
        }
      
        $stmt=$user->getUserDataByUserID();
        $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
        $chats[$key]["user_name"]=$user_data[user_name];
        $chats[$key]["user_photo"]=$user_data[user_profile_photo];
echo  '<div class="chat-user" id="'.$value["chat_id"].'" onclick="openChat('.$value["chat_id"].','.$user_data[user_id].')">
            <div class="user-image">';
            if(!empty($user_data[user_profile_photo])){
                
            echo'<img class="user-avtar" src="'.$user_data[user_profile_photo].'" />';
            }
            else{
                echo '<img class="user-avtar" src="assets/images/user.png" />';
            }
            echo '<span class="user-online-chat"><img class="online" src="/assets/images/home/online.png">Online</span>
                </div>
            <div class="user-details">';
             echo '<h6 class="username">';
             if(!empty($user_data[user_name])){
                 echo $user_data[user_name];
                 }
            else{
                echo "Demo User";
            }
            echo '</h6>';
            
             echo '<h6 class="company-details">';
             if(!empty($user_data[company_name])){
                 echo $user_data[company_name]. ' / ' .$user_data[occupation];
                 }
            else{
                echo "Developer / Chandigarh";
            }
             
             
             echo '</h6>';
             echo  '<p class="last-message">Hello How are you?</p>';
           echo '</div>
        </div>';
    
    }
   echo '</div>';
?>