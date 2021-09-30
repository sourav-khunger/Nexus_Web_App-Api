<?php
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/user.php';
	include_once '../vendor/autoload.php';
	
	use \Firebase\JWT\JWT;
   // GET DATA FORM REQUEST
   $data = json_decode(file_get_contents("php://input"));

	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();
 
	// initialize object
   $user = new User($db);
   $user->user_social_id=trim($data->social_id)?trim($data->social_id):die();
   $user->device_id=trim($data->device_id);
   $user->push_token=trim($data->push_token);
   
    if($user->doesSocialIdExist())
    {
        if($user->doesUserRegisterProcessCompleted())
        {
             $stmt=$user->getUserDatawithSocialID();
             $response["success"]=1;
             $response["exist"]=true;
             $response["verified_status"]=true;
        }
        else{
        
      if($user->doesUserEmailExist()){
 
           $stmt=$user->getUserDatawithSocialID();
           $response["success"]=1;
           $response["exist"]=true;
           $response["verified_status"]=true;
      }
      else{
          $stmt=$user->getUserDatawithSocialID();
          $response["success"]=1;
          $response["exist"]=true;
          $response["verified_status"]=false;
      }
      
    }
    
    }
    else{
    $user->user_type=trim($data->user_type)?trim($data->user_type):"";
	$user->user_name= trim($data->name)?trim($data->name):"";
	$name=(explode(" ",$user->user_name));
	$user->first_name=$name[0];
	$user->last_name=$name[1];
	$user->user_social_link=trim($data->user_social_link)?trim($data->user_social_link):"";
    $user->user_email=trim($data->email)?trim($data->email):"";
    $user->user_phone_number=trim($data->phone_number)?trim($data->phone_number):"";
    $user->user_profile_photo=trim($data->user_type)?trim($data->profile_photo):"";
    if($user->register())
    {
       $stmt=$user->getUserDatawithSocialID(); 
       $response["success"]=1;
       $response["exist"]=false;
         if($user->doesUserEmailExist()){
    
    $response["verified_status"]=true;
    }
    else{
         $response["verified_status"]=false;
    }
    }
    }
    
    $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
    
    // Add Device id or push token //
    
    $user->user_id=$user_data[user_id];
    $user->addNewDevice();
    
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
  	$response["token"] = $jwt;
    $response["data"]=$user_data;
    echo json_encode($response);
    
?>