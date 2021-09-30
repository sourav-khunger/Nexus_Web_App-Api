<?php
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/user.php';
	include_once '../objects/chat.php';
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
	$chat= new chat($db);
	
	
	$user->token =$bearer->getBearerToken();
	try {
        
      $decoded = JWT::decode($user->token, $key, array('HS256'));
      $user->user_social_id = $decoded->data->user_social_id;
       if($user->doesSocialIdExist()){
          $chat->user_id = $decoded->data->user_id;
          $stmt=$chat->getAllChatMembersByChatID();
          $chats=$stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($chats as $key=> $value)
          {
              if($chat->user_id==$value['joined_user'])
              {
              $user->user_id=$value['created_by'];
              }
              else{
              $user->user_id=$value['joined_user'];
              }
              $stmt=$user->getUserDataByUserID();
              $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
              $chats[$key]["user_name"]=$user_data[user_name];
              $chats[$key]["user_photo"]=$user_data[user_profile_photo];
          }
          
          
          $response["success"]=1;
          $response["chats"]=$chats;
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