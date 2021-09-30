<?php
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/token.php';
	include_once '../objects/user.php';
	include_once '../vendor/autoload.php';

   $data = json_decode(file_get_contents("php://input"));

	use \Firebase\JWT\JWT;
	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();
 
 // initialize token object

	$bearer = new Token();
 
	// initialize object
    $user = new User($db);
 
 
	$user->token =$bearer->getBearerToken();
 	try{
 	 
 	$num=0; 
 	$decoded = JWT::decode($user->token, $key, array('HS256'));
    $user->user_social_id = $decoded->data->user_social_id;
    $user->user_id= $decoded->data->user_id;
    $user->deleteUserAllPurposes();
    if($user->doesSocialIdExist())
    {
        foreach($data->purpose as $value){
        
        $user->purpose_id=$value->purpose_id;
        // Serialize Skills Array
        $user->skill_id=serialize($value->skill_id);
        $user->funding_id=serialize($value->funding_id);
        $user->industry_id=serialize($value->industry_id);
        $user->alliance_id=serialize($value->alliance_id);
        $user->investment_id=serialize($value->investment_id);
        $user->business_plan=addslashes($value->business_plan);
        $user->status=$value->status;
        $user->vision=$value->vision;
        $user->strength=$value->strength;
        $user->supplement=$value->supplement;
        if($user->saveUserPurpose())
        {
            $num++;
        }
        }
       
if($num>0){
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
	 $response['message'] = "Database Error";
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
 