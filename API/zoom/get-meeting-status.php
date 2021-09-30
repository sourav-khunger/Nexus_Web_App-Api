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
	$user->meeting_id=trim($data->meeting_id);
	// if decode succeed, show user details
    try {
        $stmt=$user->getMeetingDetailsByMeetingID();
        $meeting_status=$stmt->fetch(PDO::FETCH_ASSOC);
        $response["success"]=1;
        $response["meeting_status"]=$meeting_status['meeting_status'];
	    echo json_encode($response);
        }catch (Exception $e){ // if decode fails, it means jwt is invalid
		$response['success'] = "0";
		$response['message'] = "JWT was not Verified. ". $e->getMessage();
		echo json_encode($response);
	}
?>