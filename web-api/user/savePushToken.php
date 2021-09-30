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

	// initialize user object
	$user = new user($db);
	$user->user_id=$_SESSION['user_id'];
	$user->push_token=$_REQUEST['pushToken'];
	$user->device_id=$_SERVER['REMOTE_ADDR'];
	if($user->addNewDevice())
    {
      $response["success"]=1;
      $response["message"]="success";
    }
		else{
		     $response["success"]=0;
             $response["message"]="Something Wrong.";
		}
	    
	    echo json_encode($response);
?>