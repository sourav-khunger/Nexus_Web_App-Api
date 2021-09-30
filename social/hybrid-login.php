<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<?php
session_start();
include_once 'web-api/config/db.php';
include_once 'web-api/config/core.php';
include_once 'web-api/objects/user.php';
include_once 'firebase-notification/set.html';

// instantiate database and user object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$user = new User($db);
if(isset($_SESSION['social_id']))
{
    $user->user_social_id=$_SESSION['social_id'];
    $stmt=$user->getUserRegistrationStep();
    $step=$stmt->fetch(PDO::FETCH_ASSOC);
    if($step['step']=='1')
    {
            $newURL='profile-registration-step-1.php';
            header('Location: '.$newURL);
    }
    elseif($step['step']=='2')
            {
            $newURL='profile-registration-step-2.php';
            header('Location: '.$newURL);
    }
    else{
        $newURL='home.php';
        header('Location: '.$newURL);
    }
}




$config_linkdin = [
    'callback' => 'https://nexus.doozycodsystems.com/index.php?provider=linkedin',
    'keys'     => [
                    'id' => '78fg1ed7xkb0z2',
                    'secret' => 'npYmtpQjDbxseXjA'
                ],
    'scope'    => 'r_liteprofile r_emailaddress',
];
$config_facebook = [
    'callback' => 'https://nexus.doozycodsystems.com/index.php?provider=facebook',
    'keys'     => [
                    'id' => '526159768398018',
                    'secret' => '78edfc90f82876dd3ab4913f453a5dcc'
                ],
    //'scope'    => 'r_liteprofile r_emailaddress',
];
$config_twitter = [
    'callback' => 'https://nexus.doozycodsys.com/index.php?provider=twitter',
    'keys' => [
        'key' => '4gvuP5JDWI4Mb6Oboi41ldH02',
        'secret' => 'KeJXlHRyaXmHUSkf5Tb5v05ygICpbi4QK2X6vZXmZKDvsXVUTn',
    ],
];
if(isset($_REQUEST['provider']))
    {
    if($_REQUEST['provider']=='linkedin')
    {
    $adapter = new Hybridauth\Provider\LinkedIn( $config_linkdin );
    try {
    $adapter->authenticate();
    $userProfile = $adapter->getUserProfile();
    $user->user_type='linkdin';
    $_SESSION['social_id']=$userProfile->identifier;
     $_SESSION['user_datas']= $adapter->getUserProfile();
    }
    catch( Exception $e ){
    echo $e->getMessage() ;
    }
    }
    else if($_REQUEST['provider']=='facebook')
    {
    $adapter = new Hybridauth\Provider\Facebook( $config_facebook );
    try {
    $adapter->authenticate();
    $userProfile = $adapter->getUserProfile();
    $user->user_type='facebook';
    $_SESSION['social_id']=$userProfile->identifier;
   
    }
    catch( Exception $e ){
    echo $e->getMessage() ;
    }
    }
     else if($_REQUEST['provider']=='twitter')
    {
    $adapter = new Hybridauth\Provider\Twitter( $config_twitter );
    try {
    $adapter->authenticate();
    $userProfile = $adapter->getUserProfile();
    $user->user_type='twitter';
    $_SESSION['social_id']=$userProfile->identifier;
   
    }
    catch( Exception $e ){
    echo $e->getMessage() ;
    }
    }
// Save Data From Response
    $user->user_social_id=$_SESSION['social_id'];
    if($user->doesSocialIdExist())
    {
         $user->user_social_id=$_SESSION['social_id'];
         $id=$user->getUserIDWithSocialIDs();
         $_SESSION['user_id']=$id[user_id];
        if($user->doesUserRegisterProcessCompleted())
        {
           
            $newURL='home.php';
            header('Location: '.$newURL);
        }
         
        else{
            $stmt=$user->getUserRegistrationStep();
            $step=$stmt->fetch(PDO::FETCH_ASSOC);
            if($step['step']=='1')
            {
            $newURL='profile-registration-step-1.php';
            header('Location: '.$newURL);
            }
            elseif($step['step']=='2')
            {
            $newURL='profile-registration-step-2.php';
            header('Location: '.$newURL);
            }
        
        }
    }
    else{
	$user->user_name=$userProfile->displayName;
	$user->first_name=$userProfile->firstName;
	$user->last_name=$userProfile->lastName;
	$user->user_social_link=$userProfile->profileURL;
    $user->user_email=$userProfile->email;
    $user->user_phone_number=trim($userProfile->phone)?trim($userProfile->phone):"";
    $user->user_profile_photo=trim($userProfile->photoURL)?trim($userProfile->photoURL):"";
     if($user->register())
     {
         $user->user_social_id=$_SESSION['social_id'];
         $id=$user->getUserIDWithSocialIDs();
         $_SESSION['user_id']=$id[user_id];
         if($user->doesUserEmailExist()){
            $user->updateStep();
              $newURL='profile-registrartion-step-1.php';
             header('Location: '.$newURL);
         }
         else{
             $newURL='email-verification.php';
             header('Location: '.$newURL);
         }
    }
    
    }
}
?>
