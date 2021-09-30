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
	$user->user_full_name=trim($data->user_full_name);
	$name=(explode(" ",$user->user_full_name));
	$user->first_name=$name[0];
	$user->last_name=$name[1];
	$user->annonymous_mode=trim($data->annonymous_mode);
	$user->facebook=trim($data->facebook);
	$user->wantedly=trim($data->wantedly);
	$user->linkdin=trim($data->linkdin);
	$user->twitter=trim($data->twitter);
	$user->instagram=trim($data->instagram);
	$user->facebook=trim($data->facebook);
	$user->github=trim($data->github);
	$user->youtube=trim($data->youtube);
	$user->user_activity_area=trim($data->user_activity_area);
	
	
	// if decode succeed, show user details
    try {
        
      $decoded = JWT::decode($user->token, $key, array('HS256'));
      $user->user_social_id = $decoded->data->user_social_id;
       if($user->doesSocialIdExist()){
          $user->user_id = $decoded->data->user_id;
          if($user->updateUserProfile())
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