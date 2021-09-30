
<?php

	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/notification.php';
	include_once '../objects/token.php';
	include_once '../objects/user.php';
   	include_once '../vendor/autoload.php';
	
	use \Firebase\JWT\JWT;
	$data = json_decode(file_get_contents("php://input"));	
	
	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();
	
	// initialize object
	$notification = new Notification($db);
	$bearer = new Token();
	$user = new user($db);
    $user->token =$bearer->getBearerToken();
    $notification->read_status=trim($data->read_status);
	 try {
	     
        $decoded = JWT::decode($user->token, $key, array('HS256'));
        $user->user_id = $decoded->data->user_id;
        $notification->notification_id = trim($data->notification_id);
        if($notification->updateStatusNotification()){
        $response["success"]=1;
    	$response['message'] ="Status Updated Successfully.";
        }
        else{
             	$response["success"]= 0;
            	$response['message'] ="Status Updation Failed.";
        }
       	  echo json_encode($response);
	     }   
	  
	  catch (Exception $e){ // if decode fails, it means jwt is invalid
		$response['success'] = 0;
		$response['message'] = "JWT was not Verified. ";
		
		echo json_encode($response
		);
	}
	
     
	 