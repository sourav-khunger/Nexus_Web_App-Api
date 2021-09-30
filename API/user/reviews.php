<?php
	// include database and object files
    include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/user.php';
	include_once '../objects/token.php';
	include_once '../vendor/autoload.php';
	
	use \Firebase\JWT\JWT;
	
   // GET DATA FORM JSON
   $data = json_decode(file_get_contents("php://input"));

	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();
 
 // initialize token object

	$bearer = new Token();
	
	// initialize object
	$user = new user($db);
	$user->token = $bearer->getBearerToken();

	$user->sender_id=trim($data->sender_id);
	$user->none=trim($data->none);
		$user->violation=trim($data->violation);
			$user->breake=trim($data->breake);
				$user->Involving=trim($data->Involving);
					$user->meeting_id=trim($data->meeting_id);
					
    try {
        $decoded = JWT::decode($user->token, $key, array('HS256'));
    	$user->reciever_id = $decoded->data->user_id;
        $user->review_id=$user->reciever_id;
         $stmt=$user->getReview();
         $getallreview=$stmt->fetch(PDO::FETCH_ASSOC);
       
          if($user->addReview())
          {
           	  $response["success"]=1;
              $response["message"]="Reviews Add Successfully.";
              
          }
	
		else{
		     $response["success"]=0;
             $response["message"]="Something Wrong.";
	      	}
         
           	echo json_encode($response);
	   }
	   
	  catch (Exception $e){ // if decode fails, it means jwt is invalid
		$response['success'] = "0";
		 $response['url'] ="";
		$response['message'] = "JWT was not Verified. ". $e->getMessage();
		
		echo json_encode( $response
		);
	}
	?>