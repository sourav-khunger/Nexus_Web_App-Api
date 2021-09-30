<?php
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/user.php';
	include_once '../objects/token.php';
	include_once '../vendor/autoload.php';
	
	use \Firebase\JWT\JWT;
	
	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();

// initialize token object

	$bearer = new Token();
	
	// initialize user object
	$user = new user($db);
	$user->token =$bearer->getBearerToken();
	
	$user->save_type=$_REQUEST['save_type']?$_REQUEST['save_type']:"";
 	$user->data_type=$_REQUEST['data_type']?$_REQUEST['data_type']:"";



	// if decode succeed, show user details
    try {
        
      $decoded = JWT::decode($user->token, $key, array('HS256'));
      $user->user_social_id = $decoded->data->user_social_id;
       if($user->doesSocialIdExist()){
            $user->user_id = $decoded->data->user_id;
            
            
            if($user->data_type=="image"){
            if($user->save_type=="background")
            {
             if($_FILES['background_image']){
               $t=time();
              $add = $t."-background-".$user->user_id ."-image.png";
             

                $target_dir ="/home/doozyco1/public_html/nexus/API/uploads/user_background_photo/". $add;
              if(move_uploaded_file($_FILES['background_image']['tmp_name'], $target_dir)){
                 $user->url=$baseurl."/API/uploads/user_background_photo/". $add;
                // $user->name=$_FILES['answer_image']['name'];
                 $response=$user->updateBackgroundImage();
                 $response['success'] =1;
		         $response['message'] = "Profile Updated Successfully";
              }
              else{
                  $response["message"] ="Image Uploading Failed";
              }
         }
}
            elseif($user->save_type=="profile"){
                
                     if($_FILES['profile_image']){
               $t=time();
                $add = $t."-profile-".$user->user_id ."-image.png";

                $target_dir ="/home/doozyco1/public_html/nexus/API/uploads/user_profile_photo/". $add;
              if(move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_dir)){
                 $user->url=$baseurl."/API/uploads/user_profile_photo/". $add;
                // $user->name=$_FILES['answer_image']['name'];
                 $response=$user->updateProfileImage();
                 $response['success'] =1;
		         $response['message'] = "Profile Updated Successfully";
              }
              else{
                  $response["message"] ="Image Uploading Failed";
              }
         }
		         
    }
}
            elseif($user->data_type=="video")
		{
		   
		    if($user->save_type=="background")
            {
                 
    if($_FILES['background_video']){
               $t=time();
            $add = $t."-background-".$user->user_id ."-video.mp4";

            $target_dir ="/home/doozyco1/public_html/nexus/API/uploads/user_background_photo/".$add;
              if(move_uploaded_file($_FILES['background_video']['tmp_name'], $target_dir)){
                 $user->url=$baseurl."/API/uploads/user_background_photo/". $add;
                 $response=$user->updateBackgroundVideo();
                 $response['success'] =1;
		         $response['message'] = "Video Uploading successfull.";
              }
              else{
                  $response["message"] ="Video Uploading Failed";
              }
         }
    }
            elseif($user->save_type=="profile"){
             if($_FILES['profile_video']){
               $t=time();
                $add = $t."-profile-".$user->user_id ."-video.mp4";

                $target_dir ="/home/doozyco1/public_html/nexus/API/uploads/user_profile_photo/". $add;
              if(move_uploaded_file($_FILES['profile_video']['tmp_name'], $target_dir)){
                 $user->url=$baseurl."/API/uploads/user_profile_photo/". $add;
                // $user->name=$_FILES['answer_image']['name'];
                 $response=$user->updateProfileVideo();
                 $response['success'] =1;
		         $response['message'] = "Profile Updated Successfully";
              }
              else{
                  $response["message"] ="Video Uploading Failed";
              }
         }
                
		         
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