<?php
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/user.php';
	include_once '../vendor/autoload.php';
	
	$data = json_decode(file_get_contents("php://input"));   
	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();

// initialize token object
	
	// initialize user object
	$user = new user($db);
	$user->user_id=$data->user_id;
	$user->user_full_name=$data->first_name." ".$data->last_name;
	$user->first_name=$data->first_name;
	$user->last_name=$data->last_name;
	$user->facebook=trim($data->facebook);
	$user->wantedly=trim($data->wantedly);
	$user->linkdin=trim($data->linkdin);
	$user->twitter=trim($data->twitter);
	$user->instagram=trim($data->instagram);
	$user->facebook=trim($data->facebook);
	$user->github=trim($data->github);
	$user->youtube=trim($data->youtube);
	$user->user_social_link=trim($data->user_social_link);
	$user->user_activity_area=trim($data->user_activity_area);
    if($user->updateUserProfile())
    {
              $response["success"]=1;
              $response["message"]="Profile Updated Successfully.";
    }
    else{
		     $response["success"]=0;
             $response["message"]="Something Wrong.";
		}
	    
	    echo json_encode($response);
    
?>