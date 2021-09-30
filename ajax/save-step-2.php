<?php
include_once 'connection.php';
$user->user_social_id=$_SESSION['social_id'];
$user->user_full_name=$_REQUEST['name'];
$name=(explode(" ",$user->user_full_name));
$user->first_name=$name[0];
$user->last_name=$name[1];
$user->user_activity_area=$_REQUEST['activity_area'];
$user->company_name=$_REQUEST['company_name']?$_REQUEST['company_name']:"";
$user->company_url=$_REQUEST['company_url']?$_REQUEST['company_url']:"";
$user->occupation=$_REQUEST['occupation'];
$user->job_history=$_REQUEST['job_history'];
// Serialize Skills Array
$skills=serialize($_REQUEST['skills']);
$user->skills=$skills;
$stmt=$user->getUserDatawithSocialID();
$user_data=$stmt->fetch(PDO::FETCH_ASSOC);
$user->user_id=$user_data['user_id'];
//Save Profile Photo
if($user->insertProfileInfo())
{
 echo "success";
}
else{
     echo "failed";
 }
