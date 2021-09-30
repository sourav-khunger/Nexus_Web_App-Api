<?php
include_once 'connection.php';
$details->user_id =$_REQUEST['user_id'];


//Get User Profile Info Data
	
$stmt=$details->getUserProfileInfo();
$user_profile_data=$stmt->fetch(PDO::FETCH_ASSOC);
$status='reject';

echo ' <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <div class="calling-modal-avatar">
     <img src="'.$user_profile_data[user_profile_photo].'" class="Calling-User" />      
      </div>
      </div>
      <div class="modal-body">
      <div class="calling-user-content text-center">
        <h6 class="username">'.$user_profile_data[user_name].'</h6>
        <span class="sub-text">Ringing....</span>
      </div>
      </div>
      <div class="modal-footer">
       <button type="button" id="'.$user_profile_data[user_id].'" data-status="cencel" onclick="cancleCall(this.id);" aria-label="Close" class="btn cancle"><img class="call-icon" src="assets/images/icons/cancle.png"></button>
      </div>
    </div>
  </div>';