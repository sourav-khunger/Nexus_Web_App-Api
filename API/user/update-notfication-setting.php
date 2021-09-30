<?php
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/user.php';
	include_once '../objects/token.php';
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
	$user->token =$bearer->getBearerToken();
	$user->push_new_message=trim($data->push_new_message);
	$user->push_recommend=trim($data->push_recommend);
	$user->push_matching=trim($data->push_matching);
	$user->push_realtime_talk=trim($data->push_realtime_talk);
	$user->push_news=trim($data->push_news);
	$user->email_new_message=trim($data->email_new_message);
	$user->email_recommend=trim($data->email_recommend);
	$user->email_matching=trim($data->email_matching);
	$user->email_realtime_talk=trim($data->email_realtime_talk);
	$user->email_news=trim($data->email_news);
	
	
	// if decode succeed, show user details
    try {
        
      $decoded = JWT::decode($user->token, $key, array('HS256'));
      $user->user_social_id = $decoded->data->user_social_id;
       if($user->doesSocialIdExist()){
          $user->user_id = $decoded->data->user_id;
          if($user->updateUserNotificationSettings())
          {
              $response["success"]=1;
              $response["message"]="Profile Updated Successfully.";
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