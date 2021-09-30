<?php
require_once '../config/core.php';

use \Firebase\JWT\JWT;

class user
{

    // database connection and table name
    private $conn;
    private $table_user = "user_info";
    private $table_devices = "devices";
    private $table_user_purpose="user_purpose_of_use";
    private $table_notification="user_notification_setting";
    private $table_meeting="user_zoom_meeting";
    private $table_hidden="hidden_users";
     private $table_review="user_reviews";

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
 
   public function addReview(){
        $query="INSERT INTO " . $this->table_review . " SET 
    	sender_id='" . htmlspecialchars(strip_tags($this->sender_id)) . "',
    	reciever_id='" . htmlspecialchars(strip_tags($this->reciever_id)) . "',
    	none='" . htmlspecialchars(strip_tags($this->none)) . "',
    	violation='" . htmlspecialchars(strip_tags($this->violation)) . "',
    	breake='" . htmlspecialchars(strip_tags($this->breake)) . "',
    	Involving='" . htmlspecialchars(strip_tags($this->Involving)) . "',
    	meeting_id='" . htmlspecialchars(strip_tags($this->meeting_id)) ."'";
    	$stmt = $this->conn->prepare($query);
    	 if ($stmt->execute()) {
        return true;
        } else {
            return false;
        }
    }
    
     public function getReview()
    {
        $query = "SELECT * FROM " . $this->table_review . " WHERE reciever_id='" . htmlspecialchars(strip_tags($this->reciever_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    
    public function deleteUserAllPurposes()
    {
        $query = "DELETE FROM ". $this->table_user_purpose." WHERE user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "'";;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $query;
    }
    
    
    public function doesSocialIdExist()
    {

        $query = "SELECT * FROM " . $this->table_user . " WHERE user_social_id='" . htmlspecialchars(strip_tags($this->user_social_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num > 0) {
            return true;
        } else {
            //print_r($stmt->errorInfo());
        }
        return false;
    }
    
     public function doesDeviceIdExist()
    {

        $query = "SELECT * FROM " . $this->table_devices . " WHERE device_id='" . htmlspecialchars(strip_tags($this->device_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num > 0) {
         return true;
        } else {
            //print_r($stmt->errorInfo());
        }
        return false;
    }
    
    public function removeDevice(){
          $query = "DELETE FROM ". $this->table_devices." WHERE device_id='" . htmlspecialchars(strip_tags($this->device_id)) . "'";;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
    
    public function doesUserEmailExist()
    
    {
        $query = "SELECT user_email FROM " . $this->table_user . " WHERE user_email!='' AND user_social_id='" . htmlspecialchars(strip_tags($this->user_social_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num > 0) {
            return true;
        } else {
            //print_r($stmt->errorInfo());
        }
        return false;
    }

    
    public function doesUserRegisterProcessCompleted(){
        $query = "SELECT * FROM " . $this->table_user . " WHERE user_registration_step='3' AND user_social_id='" . htmlspecialchars(strip_tags($this->user_social_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num > 0) {
            return true;
        } else {
            //print_r($stmt->errorInfo());
        }
        return false;
    }


    public function verifyUserEmail()
    {
        $query = "UPDATE " . $this->table_user . " SET user_email='" . htmlspecialchars(strip_tags($this->user_email)) . "' WHERE user_social_id='" . $this->user_social_id . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num > 0) {
            return true;
        } else {
            //print_r($stmt->errorInfo());
        }
        return $query;
    }

    public function hideUser()
    {
        $query = "INSERT INTO " . $this->table_hidden . " SET hidden_id='" . htmlspecialchars(strip_tags($this->	hidden_id)) . "', hidden_by='" . htmlspecialchars(strip_tags($this->hidden_by)) . "', hidden_user='" . htmlspecialchars(strip_tags($this->hidden_user)) ."'";
    	$stmt = $this->conn->prepare($query);
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num > 0) {
            return true;
        } else {
            //print_r($stmt->errorInfo());
        }
        return false;
    }

    public function getUserDatawithSocialID()
    {
        $query = "SELECT * FROM " . $this->table_user . " WHERE   user_social_id='" . htmlspecialchars(strip_tags($this->user_social_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    public function getUserDataByUserID()
    {
        $query = "SELECT * FROM " . $this->table_user . " WHERE   user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function getUserDeviceByUserID()
    {
        $query = "SELECT * FROM " . $this->table_devices . " WHERE   user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
   
    
    public function getMeetingDetailsByMeetingID()
    {
        $query = "SELECT * FROM " . $this->table_meeting . " WHERE meeting_id='" . htmlspecialchars(strip_tags($this->meeting_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    
    public function logoutUser(){
        $query="DELETE FROM " . $this->table_devices . " WHERE user_id=".$this->user_id;
        $stmt=$this->conn->prepare($query);
        if($stmt->execute())
        {
            return true;
        }
        return false;
    }
    
    public function saveMeeting(){
        $query="INSERT INTO " . $this->table_meeting . " SET 
    	meeting_id='" . htmlspecialchars(strip_tags($this->meeting_id)) . "',
    	sender_id='" . htmlspecialchars(strip_tags($this->sender_id)) . "',
    	meeting_status='" . htmlspecialchars(strip_tags($this->meeting_status)) . "',
    	meeting_password='" . htmlspecialchars(strip_tags($this->meeting_password)) . "',
    	receiver_id='" . htmlspecialchars(strip_tags($this->receiver_id)) ."'";
    	$stmt = $this->conn->prepare($query);
    	if ($stmt->execute()) {
        return true;
        } else {
            return false;
        }
    }
    
    public function insertProfileInfo(){
        $query = "UPDATE " . $this->table_user . " SET 
    	user_name='" . htmlspecialchars(strip_tags($this->user_full_name)) . "', 
    	first_name='" . htmlspecialchars(strip_tags($this->first_name)) . "',
    	last_name='" . htmlspecialchars(strip_tags($this->last_name)) . "',
    	user_activity_area='" . htmlspecialchars(strip_tags($this->user_activity_area)) . "', 
    	company_name='" . htmlspecialchars(strip_tags($this->company_name)) . "', 
    	user_registration_step = '2',
    	company_url	='" . htmlspecialchars(strip_tags($this->company_url)) . "',
    	occupation='" . htmlspecialchars(strip_tags($this->occupation)) . "',
    	job_history='" . htmlspecialchars(strip_tags($this->job_history)) . "',
    	skills='" . $this->skills . "' WHERE user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "'";
        $stmt = $this->conn->prepare($query);
       if ($stmt->execute()) {
          $query= "INSERT INTO " . $this->table_notification . " SET 
           user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "'";
           $stmt = $this->conn->prepare($query);
           $stmt->execute();
            return true;
        } else {
            return false;
        }
      
    }
    
    
    public function addNewDevice(){
        if($this->doesDeviceIdExist())
        {
        $this->removeDevice();
        }
        $query="INSERT INTO " . $this->table_devices . " SET 
    	device_id='" . htmlspecialchars(strip_tags($this->device_id)) . "',
    	user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "',
    	push_token='" . htmlspecialchars(strip_tags($this->push_token)) ."'";
    	$stmt = $this->conn->prepare($query);
    	 if ($stmt->execute()) {
        return true;
        } else {
            return false;
        }
    }
  
    
     public function saveUserPurpose(){
        $query = "INSERT INTO " . $this->table_user_purpose . " SET 
        purpose='" . htmlspecialchars(strip_tags($this->purpose_id)) . "', 
        user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "', 
    	skills='"  .$this->skill_id . "', 
    	funding='" . $this->funding_id . "', 
    	industry='" . $this->industry_id . "', 
    	alliance	='" . $this->alliance_id . "',
    	investment='" . $this->investment_id . "',
    	business_plan='" . htmlspecialchars(strip_tags($this->business_plan)) . "',
    	status='" . htmlspecialchars(strip_tags($this->status)) . "',
    	vision='" . htmlspecialchars(strip_tags($this->vision)) . "',
    	strength='" . htmlspecialchars(strip_tags($this->strength)) . "',
    	supplement='" . htmlspecialchars(strip_tags($this->supplement)) . "'";
        $stmt = $this->conn->prepare($query);
       if ($stmt->execute()) {
        $query = "UPDATE " . $this->table_user . " SET user_registration_step = '3' WHERE user_id = '" . $this->user_id . "'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
            return true;
        } else {
            return false;
        }
      
    }
    
    
public function getArray(){
     $query = "SELECT skills FROM " . $this->table_user_profile_info;
      $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}
    public function register()
    {
        // query to insert record
        $query = "INSERT INTO " . $this->table_user . " SET 
    	user_registration_step='1',
    	user_name='" . htmlspecialchars(strip_tags($this->user_name)) . "', 
    	first_name='" . htmlspecialchars(strip_tags($this->first_name)) . "', 
    	last_name='" . htmlspecialchars(strip_tags($this->last_name)) . "', 
    	user_email='" . htmlspecialchars(strip_tags($this->user_email)) . "', 
    	user_social_link='" . htmlspecialchars(strip_tags($this->user_social_link)) . "', 
    	user_login_type='" . htmlspecialchars(strip_tags($this->user_type)) . "', 
    	user_social_id='" . htmlspecialchars(strip_tags($this->user_social_id)) . "',
    	user_profile_photo='" .$this->user_profile_photo . "',
    	user_phone_number='" . htmlspecialchars(strip_tags($this->user_phone_number)) . "'";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
        return true;
        } else {
            return false;
        }
    }
    
    public function updateUserWorkStatus(){
        $query = "UPDATE " . $this->table_user . " SET 
    	company_name='" . htmlspecialchars(strip_tags($this->company_name)) . "', 
    	company_url	='" . htmlspecialchars(strip_tags($this->company_url)) . "',
    	occupation='" . htmlspecialchars(strip_tags($this->occupation)) . "',
    	job_history='" . htmlspecialchars(strip_tags($this->job_history)) . "',
    	skills='" . $this->skills . "' WHERE user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "'";
        $stmt = $this->conn->prepare($query);
       if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
      
    }
  
    
    public function updateAnnonymousStatus(){
         $query = "UPDATE " . $this->table_user . " SET 
    	annonymous_mode='" . htmlspecialchars(strip_tags($this->annonymous_mode)) . "'
    	WHERE user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "'";
        $stmt = $this->conn->prepare($query);
       if ($stmt->execute()) {
            return true;
        } else {
            return false;
         }
    }

    public function updateUserProfile(){
        $query = "UPDATE " . $this->table_user . " SET 
    	user_name='" . htmlspecialchars(strip_tags($this->user_full_name)) . "', 
    	first_name='" . htmlspecialchars(strip_tags($this->first_name)) . "',
    	last_name='" . htmlspecialchars(strip_tags($this->last_name)) . "',
    	user_activity_area='" . htmlspecialchars(strip_tags($this->user_activity_area)) . "', 
    	annonymous_mode='" . htmlspecialchars(strip_tags($this->annonymous_mode)) . "', 
    	facebook='" . htmlspecialchars(strip_tags($this->facebook)) . "', 
    	twitter	='" . htmlspecialchars(strip_tags($this->twitter)) . "',
    	linkdin='" . htmlspecialchars(strip_tags($this->linkdin)) . "',
    	github	='" . htmlspecialchars(strip_tags($this->github)) . "',
    	instagram='" . htmlspecialchars(strip_tags($this->instagram)) . "',
    	wantedly='" . htmlspecialchars(strip_tags($this->wantedly)) . "',
    	youtube='" . htmlspecialchars(strip_tags($this->youtube)) . "'
    	WHERE user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "'";
        $stmt = $this->conn->prepare($query);
       if ($stmt->execute()) {
            return true;
        } else {
            return false;
         }
        
    }
    
    public function updateUserNotificationSettings(){
        $query = "UPDATE " . $this->table_notification . " SET 
    	push_new_message='" . htmlspecialchars(strip_tags($this->push_new_message)) . "', 
    	push_recommend='" . htmlspecialchars(strip_tags($this->push_recommend)) . "', 
    	push_matching='" . htmlspecialchars(strip_tags($this->push_matching)) . "', 
    	push_realtime_talk='" . htmlspecialchars(strip_tags($this->push_realtime_talk)) . "', 
    	push_news	='" . htmlspecialchars(strip_tags($this->push_news)) . "',
    	email_new_message='" . htmlspecialchars(strip_tags($this->email_new_message)) . "',
    	email_recommend	='" . htmlspecialchars(strip_tags($this->email_recommend)) . "',
    	email_matching='" . htmlspecialchars(strip_tags($this->email_matching)) . "',
    	email_realtime_talk='" . htmlspecialchars(strip_tags($this->email_realtime_talk)) . "',
    	email_news='" . htmlspecialchars(strip_tags($this->email_news)) . "'
    	WHERE user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "'";
        $stmt = $this->conn->prepare($query);
       if ($stmt->execute()) {
            return true;
        } else {
            return false;
         }
    }
    
    public function updateMeetingStatus()
    {
        $query = "UPDATE " . $this->table_meeting . " SET meeting_status='" . htmlspecialchars(strip_tags($this->status)) . "' WHERE meeting_id='" . htmlspecialchars(strip_tags($this->meeting_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
         }
    }
    
    
    public function updateProfileImage()
    {
        $query = "UPDATE " . $this->table_user . " SET user_profile_photo = '" . $this->url . "' WHERE user_social_id = '" . $this->user_social_id . "'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
    public function updateBackgroundImage()
    {
        $query = "UPDATE " . $this->table_user . " SET user_background_photo = '" . $this->url . "' WHERE user_social_id = '" . $this->user_social_id . "'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
    
     public function updateProfileVideo()
    {
        $query = "UPDATE " . $this->table_user . " SET user_profile_video = '" . $this->url . "' WHERE user_social_id = '" . $this->user_social_id . "'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
    public function updateBackgroundVideo()
    {
        $query = "UPDATE " . $this->table_user . " SET user_background_video = '" . $this->url . "' WHERE user_social_id = '" . $this->user_social_id . "'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
    public function updateUserWithdrawStatus()
    {
        $query = "UPDATE " . $this->table_user . " SET withdraw_status = '" . $this->status . "' WHERE user_social_id = '" . $this->user_social_id . "'";
        $stmt = $this->conn->prepare($query);
         if ($stmt->execute()) {
            return true;
        } else {
            return false;
         }
    }
    public function updateUserLastActivityTime()
     {
        $query = "UPDATE " . $this->table_user . " SET activity_time = CURRENT_TIMESTAMP WHERE user_social_id = '" . $this->user_social_id . "'";
        $stmt = $this->conn->prepare($query);
         if ($stmt->execute()) { 
            return true;
        } else {
            return false;
         }
    }
    public function updateUserRecessStatus()
    {
        $query = "UPDATE " . $this->table_user . " SET recess_status = '" . $this->status . "' WHERE user_social_id = '" . $this->user_social_id . "'";
        $stmt = $this->conn->prepare($query);
         if ($stmt->execute()) {
            return true;
        } else {
            return false;
         } 
    }
     public function updateUserRealtimeStatus()
    {
        $query = "UPDATE " . $this->table_user . " SET realtime_talk = '" . $this->status . "' WHERE user_id = '" . $this->user_id . "'";
        $stmt = $this->conn->prepare($query);
         if ($stmt->execute()){
            return true;
        } else {
            return false;
         } 
    }
    
    public function test()
    {
        // query to insert record
        $query = "UPDATE " . $this->table_user . " SET 
    	user_email=" . htmlspecialchars(strip_tags($this->user_email)) . " WHERE user_social_id=" . $this->user_social_id;
        $stmt = $this->conn->prepare($query);

        return $query;
    }
}
