<?php
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/token.php';
	include_once '../objects/user.php';
	include_once '../vendor/autoload.php';
	
	use \Firebase\JWT\JWT;
   // GET DATA FORM REQUEST
   $data = json_decode(file_get_contents("php://input"));

	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();
 
 // initialize token object

	$bearer = new Token();
 
	// initialize object
    $user = new User($db);
 	$user->token =$bearer->getBearerToken();
 	try{
 	$decoded = JWT::decode($user->token, $key, array('HS256'));
 	$user->user_social_id = $decoded->data->user_social_id;
    if($user->doesSocialIdExist())
    {
        $user->user_id= $decoded->data->user_id;
        $user->user_full_name=$data->user_full_name;
        $name=(explode(" ",$user->user_full_name));
	    $user->first_name=$name[0];
	    $user->last_name=$name[1];
        $user->user_activity_area=$data->user_activity_area;
        $user->company_name=$data->company_name;
        $user->company_url=$data->company_url;
        $user->occupation=$data->occupation;
        $user->job_history=$data->job_history;
        
        // Serialize Skills Array
        $skills=serialize($data->skills);
        $user->skills=$skills;
        
        if($user->insertProfileInfo())
        {
          $stmt=$user->getUserDatawithSocialID(); 
          $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
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
    $response["success"]=1;
  	$response["token"] = $jwt;
  	$response["data"]=$user_data;
        }
    else{
        $response['success'] = 0;
	   $response['message'] = "User Data Already Updated";
    }
    }


      else{
      $response['success'] = 0;
	   $response['message'] = "You are not an authorised user to perform this action.";
  }
    echo json_encode($response);
 	}
 	catch(Exception $e){ // if decode fails, it means jwt is invalid
		$response['success'] = 0;
		$response['message'] = "JWT was not Verified. ". $e->getMessage();
		
		echo json_encode($response);
	}
?>