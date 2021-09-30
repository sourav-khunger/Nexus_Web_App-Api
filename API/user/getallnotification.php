
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
	 
	 try {
        $decoded = JWT::decode($user->token, $key, array('HS256'));
        $user->user_id = $decoded->data->user_id;
        $notification->reciever_id = $user->user_id;
        
        $stmt = $notification->getNotification();
        $getallnotification=$stmt->fetchAll(PDO::FETCH_ASSOC);
    	$notification->time = $getallnotification[0][time];
        $notification->time1 = date('Y-m-d H:i:s');
        $stmt= $notification->getTime();
        $getTime=$stmt->fetch(PDO::FETCH_ASSOC);
        echo $getTime[time];
       	$response["success"]=1;
    	$response['message'] = "User Data.";
    	$response['data']=$getallnotification;
    
    	echo json_encode($response);
	     }   
	  
	  catch (Exception $e){ // if decode fails, it means jwt is invalid
		$response['success'] = 0;
		$response['message'] = "JWT was not Verified. ";
		
		echo json_encode($response
		);
	}
	
     
	 