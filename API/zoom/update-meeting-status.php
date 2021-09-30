<?php
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/user.php';
	include_once '../objects/token.php';
	include_once '../objects/chat.php';
	include_once '../objects/push.php';
	include_once '../objects/notification.php';
	include_once '../vendor/autoload.php';
	
	use \Firebase\JWT\JWT;
	$data = json_decode(file_get_contents("php://input"));   
	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();

// initialize token object

	$bearer = new Token();
	
	// initialize user object
	$user = new user($db);
	$chat = new chat($db);
	$push = new Push($db);
	$notification = new Notification($db);
	
	
	$user->token =$bearer->getBearerToken();
	$user->meeting_id=trim($data->meeting_id);
	$user->status=trim($data->status);

	// if decode succeed, show user details
    try {
        
      $decoded = JWT::decode($user->token, $key, array('HS256'));
      $user->user_social_id = $decoded->data->user_social_id;
      if($user->doesSocialIdExist()){
          $user->user_id = $decoded->data->user_id;
          
          if($user->status=='on_call')
          {
            $user->reciever_id=trim($data->reciever_id);
	        $user->sender_id=trim($data->sender_id);
            $chat->chat_id=$user->sender_id < $user->reciever_id ?$user->sender_id.$user->reciever_id : $user->reciever_id.$user->sender_id;
            $chat->created_by=$user->sender_id;
            $chat->joined_user=$user->reciever_id;
            $chat->addNewChat();
              
          }
           if($user->status=='cencel')
          {
               
            $user->reciever_id=trim($data->reciever_id);
	        $user->sender_id=trim($data->sender_id);
            $user->user_id=$user->sender_id;
            
            $notification->sender_id=$user->sender_id;
            $notification->reciever_id=$user->reciever_id;
            
            $stmt=$user->getUserDataByUserID();
            $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
            $push->title = 'Missed Call by '.$user_data[user_name];
            $notification->notifications = $push->title;
            $notification->read_status = 'false';
     
        
            $notification->time= date('Y-m-d H:i:s');
            $pushData = array(
                            'sender_id'=>$user_data[user_id],
                            'sender_name' => $user_data[user_name],
                            'sender_image' => $user_data[user_profile_photo],
                            'isCancle'=>'true'
                        );
             $push->data = $pushData;
             $user->user_id=$user->reciever_id;
             $stmt=$user->getUserDeviceByUserID();
             $userdevice=$stmt->fetchAll(PDO::FETCH_ASSOC);
             foreach($userdevice as $device){
             $deviceArray = $device['push_token'];
             $push->token = $deviceArray;
             $push->send();
                }
             $notification->saveNotification();
          }
          
           elseif($user->status=='reject')
          {
               
           $user->reciever_id=trim($data->reciever_id);
	        $user->sender_id=trim($data->sender_id);
            $user->user_id=$user->sender_id;
            
            $notification->sender_id=$user->sender_id;
            $notification->reciever_id=$user->reciever_id;
            
            $stmt=$user->getUserDataByUserID();
            $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
            $push->title = 'Decline by '.$user_data[user_name];
            $notification->notifications = $push->title;
            $notification->read_status = 'false';
            $notification->time= date('Y-m-d H:i:s');
            $pushData = array(
                            'sender_id'=>$user_data[user_id],
                            'sender_name' => $user_data[user_name],
                            'sender_image' => $user_data[user_profile_photo],
                            'isCancle'=>'true'
                        );
             $push->data = $pushData;
             $user->user_id=$user->sender_id;
             $stmt=$user->getUserDeviceByUserID();
             $device=$stmt->fetch(PDO::FETCH_ASSOC);
             $deviceArray = $device['push_token'];
             $push->token = $deviceArray;
             $push->send();
             $notification->saveNotification();
          }
          
          if($user->updateMeetingStatus())
          {
             
              
              $response["success"]=1;
              $response["message"]="Meeting status updated Successfully.";
          }
          
		else{
		     $response["success"]=0;
             $response["message"]="Something Wrong.";
		}
        }
        else{
            $response['success'] = 0;
 
		    $response['message'] = "You are not an authorised user to perform this action.";
        }
	    
	    echo json_encode($response);
    }catch (Exception $e){ // if decode fails, it means jwt is invalid
		$response['success'] = "0";
		$response['message'] = "JWT was not Verified. ". $e->getMessage();
		
		echo json_encode( $response
		);
	}
?>