<?php
session_start();
include_once 'web-api/config/db.php';
include_once 'web-api/config/core.php';
include_once 'web-api/objects/user.php';
include_once 'web-api/objects/details.php';
// instantiate database and user object
$database = new Database();
$db = $database->getConnection();

// initialize object
$user = new User($db);
$details = new details($db);


$details->user_social_id=$_SESSION['social_id'];
$id=$details->getUserIDWithSocialID();
$_SESSION['user_id']=$id[user_id];
if(isset($_SESSION['social_id'])&&$_SESSION['social_id']!='')
{
    $user->user_social_id=$_SESSION['social_id'];
    $stmt=$user->getUserRegistrationStep();
    $step=$stmt->fetch(PDO::FETCH_ASSOC);
     if($step['step']=='2')
            {
            $newURL='profile-registration-step-2.php';
            header('Location: '.$newURL);
    }
    else if($step['step']=='1')
    {
         $newURL='profile-registration-step-1.php';
        header('Location: '.$newURL);
    }
}
else{
     $newURL='index.php';
     header('Location: '.$newURL);
}
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/js/toast/jquery.toast.css">

<title>Title</title>
</head>
<header>
<nav class="navbar navbar-light bg-light text-center">
  <div class="top-bar col-12">
  <h6 class="header-text">自己紹介動画をアップロードすると優先的にレコメンドされます</h6>
</div>
</nav>
<div class="container header">
  <div class="row">
      <div class="col">   
      <div class="img-fluid">
        <a href="home.php"><img class="logo" src="assets/images/logo.png" width="150" height="120" alt=""></a>
</div>
      </div>
      <div class="col text-right">
          <a href="#"><img src="assets/images/icons/notification.png" class="bubble"></a>
          <a class="chat-open" href="#"><img src="assets/images/icons/message.png" class="bubble"></a>
          <a href="user-profile.php"><img height='40px' width='40px' id="mini_user_image" src="assets/images/icons/profile-icon.png" class="profile-icon"></a>
    </div>   
</div>
<?php if($page=="home") { ?>
  <div class="scrollmenu" id="myDIV">
      <a class="menu filter-button active" data-filter="all">All Purpose</a>
  
  <?php 
  	$stmt=$details->getAllPurpose();
	$purpose_data=$stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach($purpose_data as $purpose)
  {
  echo '<a class="menu filter-button" data-filter="'.$purpose['purpose_id'].'" >'.$purpose['purpose_name_english'].'</a>';
  }
  ?>
  
 </div>
<?php } ?>
</div>
</header>
<div id="chatbox" class="chatbox-hide">
    
</div>
<body>

