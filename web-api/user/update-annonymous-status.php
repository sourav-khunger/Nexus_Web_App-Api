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
	$user->user_id=trim($data->user_id);
	$user->annonymous_mode=trim($data->annonymous_mode);
          if($user->updateAnnonymousStatus())
          {
              $response["success"]=1;
              $response["message"]="Annonymous Status Updated Successfully.";
          }
		else{
		     $response["success"]=0;
             $response["message"]="Something Wrong.";
		}
	    
	    echo json_encode($response);
?>