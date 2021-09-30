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
	
	// initialize object
	$user = new user($db);
	$bearer = new Token();
	$user->token =$bearer->getBearerToken();
	 try {
        $decoded = JWT::decode($user->token, $key, array('HS256'));
    	 $user->user_social_id = $decoded->data->user_social_id;
    	    
	       if($user->doesUserEmailExist()){
	       $stmt=$user->getUserDatawithSocialID();
	       $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
           $response["success"]=1;
           $response["verified_status"]=true;
               /* JWT Token Starts Here */
      
     $token="";
		$token = array(
		   "iss" => $iss,
		   "aud" => $aud,
		   "iat" => $iat,
		   "nbf" => $nbf,
		   "data" => $user_data
	                         );
	        
		$jwt = JWT::encode($token, $key);
		/* JWT Token Ends Here */
  	$response['token'] = $jwt;
           $response["data"]=$user_data;
            }
          else{
          $response["success"]=1;
          $response["verified_status"]=false;
          $response["token"]="";
           $response["data"]="";
           }
     
             echo json_encode($response);
	 }
	 catch (Exception $e){ // if decode fails, it means jwt is invalid
		$response['success'] = 0;
		$response['message'] = "JWT was not Verified. ". $e->getMessage();
		
		echo json_encode($response
		);
	}
	   
	
	
