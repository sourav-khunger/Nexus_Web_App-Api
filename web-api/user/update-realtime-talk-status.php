<?php
session_start();
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/user.php';
	include_once '../vendor/autoload.php';
	
	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();

// initialize token object


	
	// initialize user object
	$user = new user($db);
    $user->user_id=$_REQUEST['user_id'];
  echo  $user->social_id=$_SESSION['social_id'];
	$user->status=$_REQUEST['status'];
	// if decode succeed, show user details
    try {
       if($user->doesSocialIdExist()){
        
          if($user->updateUserRealtimeStatus())
          {
              $response["success"]=1;
              $response["message"]="Status updated Successfully.";
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