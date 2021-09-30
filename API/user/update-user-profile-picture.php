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
	
	$user->save_type=trim($data->save_type);
	$user->data_type=trim($data->data_type);



	// if decode succeed, show user details
    try {
        
      $decoded = JWT::decode($user->token, $key, array('HS256'));
      $user->user_social_id = $decoded->data->user_social_id;
       if($user->doesSocialIdExist()){
            $user->user_id = $decoded->data->user_id;
            
            
            if($user->data_type=="image"){
                $user->photo=trim($data->data);
	            $user->photo=base64_decode($user->photo);
                
            if($user->save_type=="background")
            {
           
            	$add = "user-".$user->user_id ."-image.png";
            	 $target_dir = "/home/doozyco1/public_html/nexus/API/uploads/user_background_photo/". $add;
                 $flag= file_put_contents($target_dir,$user->photo);
                 $user->url=$baseurl."/API/uploads/user_background_photo/". $add;
                 $response=$user->updateBackgroundImage();
                 $response['success'] =1;
		         $response['message'] = "Profile Updated Successfully";
		         
		         
            }
            elseif($user->save_type=="profile"){
                
                 $add = "user-".$user->user_id ."-image.png";
            	 $target_dir = "/home/doozyco1/public_html/nexus/API/uploads/user_profile_photo/". $add;
                 $flag= file_put_contents($target_dir,$user->photo);
                 $user->url=$baseurl."/API/uploads/user_profile_photo/". $add;
                 $response=$user->updateProfileImage();
                 $response['success'] =1;
		         $response['message'] = "Profile Updated Successfully";
		         
            }
            }
            elseif($user->data_type=="video")
		{
		     $user->photo=trim($data->data);
	         $user->photo=base64_decode($user->photo);
		    if($user->save_type=="background")
            {
           
            	$add = "user-".$user->user_id ."-video.mp4";
            	 $target_dir = "/home/doozyco1/public_html/nexus/API/uploads/user_background_photo/". $add;
                 $flag= file_put_contents($target_dir,$user->photo);
                 $user->url=$baseurl."/API/uploads/user_background_photo/". $add;
                 $response=$user->updateBackgroundVideo();
                 $response['success'] =1;
		         $response['message'] = "Profile Updated Successfully";
		         
            }
            elseif($user->save_type=="profile"){
                
                 $add = "user-".$user->user_id ."-video.mp4";
            	 $target_dir = "/home/doozyco1/public_html/nexus/API/uploads/user_profile_photo/". $add;
                 $flag= file_put_contents($target_dir,$user->photo);
                 $user->url=$baseurl."/API/uploads/user_profile_photo/". $add;
                 $response=$user->updateProfileVideo();
                 $response['success'] =1;
		         $response['message'] = "Profile Updated Successfully";
		         
            }
		}
		$stmt=$user->getUserDatawithSocialID();
		$user_data=$stmt->fetch(PDO::FETCH_ASSOC);
		   /* JWT Token Starts Here */
      
     $token="";
		$token = array(
		   "iss" => $iss,
		   "aud" => $aud,
		   "iat" => $iat,
		   "nbf" => $nbf,
		   "data" => $user_data
	                         );
	        
		$jwt = JWT::encode($token, $key);
		/* JWT Token Ends Here */
    	$response['token'] = $jwt;
		$response['data']=$user_data;
		
        }
        else{
            $response['success'] = 0;
            $response['url'] ="";
		    $response['message'] = "You are not an authorised user to perform this action.";
        }
	    
	    echo json_encode($response);
    }catch (Exception $e){ // if decode fails, it means jwt is invalid
		$response['success'] = "0";
		 $response['url'] ="";
		$response['message'] = "JWT was not Verified. ". $e->getMessage();
		
		echo json_encode( $response
		);
	}
?>