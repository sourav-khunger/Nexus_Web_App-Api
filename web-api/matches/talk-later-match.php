<?php
session_start();
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/user.php';	
	include_once '../objects/match.php';
	include_once '../vendor/autoload.php';
	
   // GET DATA FORM REQUEST

	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();
	// initialize object
    $user = new User($db);
    $match= new Match($db);
    
 

      $user->user_social_id = $_SESSION['social_id'];
       if($user->doesSocialIdExist()){   
         $match->sender_id=$_REQUEST[user_id];
         $match->receiver_id=$_REQUEST[receiver_id];
         $match->match_id=$match->sender_id < $match->receiver_id ?$match->sender_id.$match->receiver_id : $match->receiver_id.$match->sender_id;
         if($match->doesChatAlreadyExist())
            {
             $response['success']=1;
             $response['message']="You have Already matched with this user.";
            }
         else if($match->doesMatchedIdExist())
         {
            if($match->doesSenderIdNotSame())
            {
             $match->status='approved';
             if($match->completeMatch()){
             $match->AddToChat();
            $response['success']=1;
            $response['message']="You have been matched successfully.";
            }
        }
        else{
            $response['success']=1;
            $response['message']='You have already requested for match.';
        }
    }
    else{
        $match->status='pending';
        if($match->createNewMatch())
        {
            $response['success']=1;
            $response['message']="Match requested";
        }
    }
}
    else{
     $response['success'] = 0;
     $response['message'] = "You are not an authorised user to perform this action.";
    }
  echo json_encode($response);
?>