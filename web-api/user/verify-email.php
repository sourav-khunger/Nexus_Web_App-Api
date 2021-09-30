<?php
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/user.php';
	$database = new Database();
	$db = $database->getConnection();

	// initialize object
	$user = new user($db);

if(isset($_REQUEST["nexusverification"])&&isset($_REQUEST["txn"]))
{
    $user->user_email=base64_decode($_REQUEST["nexusverification"]);
    $user->user_social_id=base64_decode($_REQUEST["txn"]);
    if($user->verifyUserEmail())
    {
    if(!isset($_REQUEST["update"])){
      $user->updateStep();
    }
       header("Location:https://nexus.doozycodsystems.com/web-api/page/success/");
    }
}
else{
   header("Location:https://nexus.doozycodsystems.com/web-api/page/error/");
die(); 
}

?>