<?php
session_start();

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
	$user->user_social_id=$_SESSION['social_id'];
	$user->save_type="profile";
	$user->data_type="image";
   $t=time();
    if($user->data_type=="image"){
                $user->photo=trim($data->data);
	            $user->photo=base64_decode($user->photo);
                
            if($user->save_type=="background")
            {
           
            	$add = $t."-user-".$user->user_social_id ."-image.png";
            	 $target_dir = "/home/doozyco1/public_html/nexus/API/uploads/user_background_photo/". $add;
                 $flag= file_put_contents($target_dir,$user->photo);
                 $user->url=$baseurl."/API/uploads/user_background_photo/". $add;
                 $response=$user->updateBackgroundImage();
                 $response['success'] =1;
		         $response['message'] = "Profile Updated Successfully";
		         
		         
            }
            elseif($user->save_type=="profile"){
                
                 $add = $t."-user-".$user->user_id ."-image.png";
            	 $target_dir = "/home/doozyco1/public_html/nexus/API/uploads/user_profile_photo/". $add;
                 $flag= file_put_contents($target_dir,$user->photo);
                 $user->url=$baseurl."/API/uploads/user_profile_photo/". $add;
                 $response=$user->updateProfileImage();
                 $response['success'] =1;
		         $response['message'] = $user->url;
		         
            }
            }
            elseif($user->data_type=="video")
		  {
		     $user->photo=trim($data->data);
	         $user->photo=base64_decode($user->photo);
		    if($user->save_type=="background")
            {
           
            	$add = $t."-user-".$user->user_id ."-video.mp4";
            	 $target_dir = "/home/doozyco1/public_html/nexus/API/uploads/user_background_photo/". $add;
                 $flag= file_put_contents($target_dir,$user->photo);
                 $user->url=$baseurl."/API/uploads/user_background_photo/". $add;
                 $response=$user->updateBackgroundVideo();
                 $response['success'] =1;
		         $response['message'] = "Profile Updated Successfully";
		         
            }
            elseif($user->save_type=="profile"){
                
                 $add = $t."-user-".$user->user_id ."-video.mp4";
            	 $target_dir = "/home/doozyco1/public_html/nexus/API/uploads/user_profile_photo/". $add;
                 $flag= file_put_contents($target_dir,$user->photo);
                 $user->url=$baseurl."/API/uploads/user_profile_photo/". $add;
                 $response=$user->updateProfileVideo();
                 $response['success'] =1;
		         $response['message'] = "Profile Updated Successfully";
		         
            }
		}
		
     
     
	    
	    echo json_encode($response);
   
?>