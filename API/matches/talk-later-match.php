<?php
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/user.php';	
	include_once '../objects/token.php';
	include_once '../objects/push.php';
	include_once '../objects/match.php';
	include_once '../vendor/autoload.php';
	use \Firebase\JWT\JWT;
   // GET DATA FORM REQUEST
   $data = json_decode(file_get_contents("php://input"));

	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();
	// initialize object
    $user = new User($db);
    $push = new Push($db);
    $match= new Match($db);
    $bearer = new Token();
    
    $user->token =$bearer->getBearerToken();
    
    try {
        
      $decoded = JWT::decode($user->token, $key, array('HS256'));
      $user->user_social_id = $decoded->data->user_social_id;
       if($user->doesSocialIdExist()){   
         $match->sender_id=$decoded->data->user_id;
         $match->receiver_id=trim($data->receiver_id)?trim($data->receiver_id):die();
         $match->match_id=$match->sender_id < $match->receiver_id ?$match->sender_id.$match->receiver_id : $match->receiver_id.$match->sender_id;
         if($match->doesChatAlreadyExist())
            {
             $response['success']=1;
             $response['message']="You have Already matched with this user.";
            }
         else if($match->doesMatchedIdExist())
         {
            if($match->doesSenderIdNotSame())
            {
             $match->status='approved';
             if($match->completeMatch()){
             $match->AddToChat();
              $user->user_id=$match->sender_id;
              $stmt=$user->getUserDataByUserID();
              $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
              $push->title = $user_data[user_name].' Accepted your match';
              $pushData = array(
                            'sender_id'=>$user_data[user_id],
                            'sender_name' => $user_data[user_name],
                            'sender_image' => $user_data[user_profile_photo],
                        );
            $push->data = $pushData;
            $user->user_id=$user->receiver_id;
            $stmt=$user->getUserDeviceByUserID();
            $device=$stmt->fetch(PDO::FETCH_ASSOC);
            $deviceArray = $device['push_token'];
            $push->token = $deviceArray;
            $push->send();
            $response['success']=1;
            $response['message']="You have been matched successfully.";
            }
        }
        else{
            $response['success']=1;
            $response['message']='You have already requested for match.';
        }
    }
    else{
        $match->status='pending';
        if($match->createNewMatch())
        {
            $user->user_id=$match->sender_id;
            $stmt=$user->getUserDataByUserID();
            $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
            $push->title = $user_data[user_name].' has requested to talk with you.';
            $pushData = array(
                            'sender_id'=>$user_data[user_id],
                            'sender_name' => $user_data[user_name],
                            'sender_image' => $user_data[user_profile_photo]
                        );
            $push->data = $pushData;
            $user->user_id=$match->receiver_id;
            $stmt=$user->getUserDeviceByUserID();
            $device=$stmt->fetch(PDO::FETCH_ASSOC);
            $deviceArray = $device['push_token'];
            $push->token = $deviceArray;
            $push->send();
            $response['success']=1;
            $response['message']="Match requested";
        }
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