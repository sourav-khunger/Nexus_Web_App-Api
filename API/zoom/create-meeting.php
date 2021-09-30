<?php
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/user.php';
	include_once '../objects/push.php';
	include_once '../vendor/autoload.php';
	include_once 'Zoom_Api.php';


	use \Firebase\JWT\JWT;
   // GET DATA FORM REQUEST
   $data = json_decode(file_get_contents("php://input"));

	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();
 
	// initialize object
   $user = new User($db);
   $push = new Push($db);
   $zoom_meeting = new Zoom_Api();
   
   $value = array();
   $value['topic'] 		= 'Buisness Talk';
   $value['duration'] 	= 30;
   $value['type'] 		= 2;
   $value['password'] 	= "12345";
   
   $meeting = $zoom_meeting->createMeeting($value);
   
   
   
   
   
   
   $user->sender_id=trim($data->sender_id)?trim($data->sender_id):die();
   $user->receiver_id=trim($data->receiver_id)?trim($data->receiver_id):die();
   $user->meeting_status=trim($data->meeting_status)?trim($data->meeting_status):die();

   $user->meeting_id=$meeting->id;
   $user->meeting_password=$meeting->password;
    // $user->meeting_id="89018193159";
  // $user->meeting_password="12345";
  if($user->saveMeeting())
  {
      $user->user_id=$user->sender_id;
      $stmt=$user->getUserDataByUserID();
      $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
      $push->title = $user_data[user_name].' Calling';
      $pushData = array(
                            'sender_id'=>$user_data[user_id],
                            'sender_name' => $user_data[user_name],
                            'sender_image' => $user_data[user_profile_photo],
                        	'meeting_id' => $user->meeting_id,
                        	'meeting_password' =>$user->meeting_password,
                        	'isCalling' =>true
                        );
      $push->data = $pushData;
      $user->user_id=$user->receiver_id;
      $stmt=$user->getUserDeviceByUserID();
      $userdevice=$stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($userdevice as $device){
         $deviceArray = $device['push_token'];
         $push->token = $deviceArray;
         $push->send();
        }
      $stmt=$user->getMeetingDetailsByMeetingID();
      $meeting=$stmt->fetch(PDO::FETCH_ASSOC);
      $response['success']=1;
      $response['meeting_data']=$meeting;
  }
  
  echo json_encode($response);