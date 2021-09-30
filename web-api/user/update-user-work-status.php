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
	$user->user_id =$data->user_id;
	$user->company_name=trim($data->company_name);
	$user->company_url=trim($data->company_url);
	$user->occupation=trim($data->occupation);
	$user->job_history=trim($data->job_history);
	// Serialize Skills Array
    // $skills=serialize($data->skills);
    // $user->skills=$skills;
    if($user->updateUserWorkStatus())
    {
    $response["success"]=1;
    $response["message"]="Profile Updated Successfully.";
    }
	else{
	$response["success"]=0;
    $response["message"]="Something Wrong.";
		}
    echo json_encode($response)
?>