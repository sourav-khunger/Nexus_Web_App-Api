<?php
	class Push{
	 
		// database connection and table name
		private $conn;
	 
		// constructor with $db as database connection
		public function __construct($db){
			$this->conn = $db;
		}
		
		public function send(){
		    $url = "https://fcm.googleapis.com/fcm/send";
            $token = $this->token;
            $serverKey = 'AAAAahjYz04:APA91bHrdnwwtKMDNQtP3WlfmdLC44qPP-ZEGaJWh-AFJjH17YbY8k9vZiuAnuEjodCcbKQa-O_VgFRvw7CKShz8BKvjXe66aGHDSlAMCpCyMWI_WyjZNLX-RlfGG7i6EDdO5CRT7xwK';
            $title = $this->title;
            $body = $this->data;
            $name = $body['sender_name'];
            if($name){
                $notification = array('title' =>$title , 'text' => $name, 'sound' => 'default', 'badge' => '1', 'click_action' => 'OPEN_ACTIVITY_1');
            }else{
                $notification = array('title' =>$title , 'sound' => 'default', 'badge' => '1');
            }
            $arrayToSend = array('to' => $token, 'notification' => $notification, 'data' => $body, 'priority'=>'high');
            $json = json_encode($arrayToSend);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key='. $serverKey;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //Send the request
            curl_exec($ch);
            //Close request
            //if ($response === FALSE) {
            //die('FCM Send Error: ' . curl_error($ch));
            //}
            curl_close($ch);
            //return $response;
            
            
           /* $registrationIds = array( $this->token );

            // prep the bundle
            $msg = array
            (
            	'message' 	=> $this->data,
            	'title'		=> 'This is a title. title',
            	'subtitle'	=> 'This is a subtitle. subtitle',
            	'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
            	'vibrate'	=> 1,
            	'sound'		=> 1,
            	'largeIcon'	=> 'large_icon',
            	'smallIcon'	=> 'small_icon'
            );
            
            $fields = array
            (
            	'registration_ids' 	=> $registrationIds,
            	'data'			=> $msg
            );
             
            $headers = array
            (
            	'Authorization: key=' . $serverKey,
            	'Content-Type: application/json'
            );
             
            $ch = curl_init();
            /*curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );*/
           /* curl_setopt($ch, CURLOPT_URL, $url);
            
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields ));
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
            $result = curl_exec($ch );
            curl_close( $ch );*/
            
            //return $result;
		}
	}
?>