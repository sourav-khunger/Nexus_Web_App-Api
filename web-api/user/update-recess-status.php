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
	
	// initialize user object
	$user = new user($db);
	$user->status=trim($data->status);
    $user->user_id=trim($data->user_id);  
    if($user->updateUserRecessStatus())
    {
    $response["success"]=1;
    $response["message"]="Status updated Successfully.";
    }
	else{
	$response["success"]=0;
    $response["message"]="Something Wrong.";
	}
    echo json_encode($response);
?>