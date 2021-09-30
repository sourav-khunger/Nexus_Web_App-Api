<?php 
/* 
| Developed by: Tauseef Ahmad
| Last Upate: 01-19-2021 08:45 PM
| Facebook: www.facebook.com/ahmadlogs
| Twitter: www.twitter.com/ahmadlogs
| YouTube: https://www.youtube.com/channel/UCOXYfOHgu-C-UfGyDcu5sYw/
| Blog: https://ahmadlogs.wordpress.com/
 */ 
 
//Include Firebase Library and Dependencies
include_once '../vendor/autoload.php';

use \Firebase\JWT\JWT;


class Zoom_Api
{
	private $zoom_api_key = 'xKdY9pm_Q6-WlXzejHB05w';
	private $zoom_api_secret = 'tAKSPlBfVTz5P8AJzS6TjcWzHFsGbnATjDZ5';	
	
	//function to generate JWT
	private function generateJWTKey() {
		$key = $this->zoom_api_key;
		$secret = $this->zoom_api_secret;
		$token = array(
			"iss" => $key,
			"exp" => time() + 5800 //60 seconds as suggested
		);
		return JWT::encode( $token, $secret );
	}	
	
	//function to create meeting
    	public function createMeeting($value = array())
    	{
 	//	$post_time  = $value['start_date'];
 		$start_time = date("Y-m-d H:i:s"); 

		$createMeetingArray = array();
		if (!empty($value['alternative_host_ids'])) {
		    if (count($value['alternative_host_ids']) > 1) {
			$alternative_host_ids = implode(",", $value['alternative_host_ids']);
		    } else {
			$alternative_host_ids = $value['alternative_host_ids'][0];
		    }
		}


		$createMeetingArray['topic']      = $value['topic'];
		$createMeetingArray['agenda']     = !empty($value['agenda']) ? $value['agenda'] : "";
		$createMeetingArray['type']       = !empty($value['type']) ? $value['type'] : 2; //Scheduled
		$createMeetingArray['start_time'] = $start_time;
		$createMeetingArray['timezone']   = 'Asia/Tashkent';
		$createMeetingArray['password']   = !empty($value['password']) ? $value['password'] : "";
		$createMeetingArray['duration']   = !empty($value['duration']) ? $value['duration'] : 60;

		$createMeetingArray['settings']   = array(
            		'join_before_host'  => true,
            		'host_video'        => !empty($value['option_host_video']) ? true : false,
            		'participant_video' => !empty($value['option_participants_video']) ? true : false,
            		'mute_upon_entry'   => !empty($value['option_mute_participants']) ? true : false,
            		'enforce_login'     => !empty($value['option_enforce_login']) ? true : false,
            		'auto_recording'    => !empty($value['option_auto_recording']) ? $value['option_auto_recording'] : "none",
            		'alternative_hosts' => isset($alternative_host_ids) ? $alternative_host_ids : ""
        	);

		return $this->sendRequest($createMeetingArray);
	}	
	
	//function to send request
    	protected function sendRequest($value)
    	{
		//Enter_Your_Email
		$request_url = "https://api.zoom.us/v2/users/jikkari88@gmail.com/meetings";
		
		$headers = array(
			"authorization: Bearer ".$this->generateJWTKey(),
			"content-type: application/json",
			"Accept: application/json",
		);
		
		$postFields = json_encode($value);
		
        	$ch = curl_init();
        	curl_setopt_array($ch, array(
            	CURLOPT_URL => $request_url,
	    	CURLOPT_RETURNTRANSFER => true,
	    	CURLOPT_ENCODING => "",
	    	CURLOPT_MAXREDIRS => 10,
	    	CURLOPT_TIMEOUT => 30,
	    	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    	CURLOPT_CUSTOMREQUEST => "POST",
	    	CURLOPT_POSTFIELDS => $postFields,
	    	CURLOPT_HTTPHEADER => $headers,
        	));

        	$meeting = curl_exec($ch);
        	$err = curl_error($ch);
        	curl_close($ch);
        	if (!$meeting) {
            		return $err;
		}
        	return json_decode($meeting);
	}
}

