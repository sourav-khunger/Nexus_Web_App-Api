<?php
//initialize facebook sdk
require 'vendor/autoload.php';
session_start();
$fb = new Facebook\Facebook([
 'app_id' => '526159768398018',
 'app_secret' => '78edfc90f82876dd3ab4913f453a5dcc',
 'default_graph_version' => 'v2.5',
]);
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional
try {
if (isset($_SESSION['facebook_access_token'])) {
$accessToken = $_SESSION['facebook_access_token'];
} else {
  $accessToken = $helper->getAccessToken();
}
} catch(Facebook\Exceptions\facebookResponseException $e) {
// When Graph returns an error
echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
if (isset($accessToken)) {
if (isset($_SESSION['facebook_access_token'])) {
$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
} else {
// getting short-lived access token
$_SESSION['facebook_access_token'] = (string) $accessToken;
  // OAuth 2.0 client handler
$oAuth2Client = $fb->getOAuth2Client();
// Exchanges a short-lived access token for a long-lived one
$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
// setting default access token to be used in script
$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
}
// redirect the user to the profile page if it has "code" GET variable
if (isset($_GET['code'])) {
header('Location: profile.php');
}
// getting basic info about user
try {
$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
$requestPicture = $fb->get('/me/picture?redirect=false&height=200'); //getting user picture
$picture = $requestPicture->getGraphUser();
$profile = $profile_request->getGraphUser();
$fbid = $profile->getProperty('id');           // To Get Facebook ID
$fbfullname = $profile->getProperty('name');   // To Get Facebook full name
$fbemail = $profile->getProperty('email');    //  To Get Facebook email
$fbpic = "<img src='".$picture['url']."' class='img-rounded'/>";
# save the user nformation in session variable
$_SESSION['fb_id'] = $fbid.'</br>';
$_SESSION['fb_name'] = $fbfullname.'</br>';
$_SESSION['fb_email'] = $fbemail.'</br>';
$_SESSION['fb_pic'] = $fbpic.'</br>';
} catch(Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
echo 'Graph returned an error: ' . $e->getMessage();
session_destroy();
// redirecting user back to app login page
header("Location: ./");
exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
echo 'Facebook SDK returned an error: ' . $e->getMessage();
exit;
}
} else {
// replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used            
$loginUrl = $helper->getLoginUrl('http://nexus.dev.doozycodsys.com/login.php', $permissions);
}
?>
<?php include_once('template-parts/login-header.php'); ?>
      <section class="login">
      <div class="container login-form-card">
<div class="row">
    <div class="col logo-image mt-4">
        <img class="login-logo" src="assets/images/logo.png" height:"100px" width:"150px" >
    </div>
    </div>
    <div class="row">
        <div class="col text-center">
                <h4 class="heading-text">Registering as a new user with social account Sign up/ Sign in</h4>
            </div>
    </div>
    <div class="row">
        <div class="col text-center">
                <p class="normal-text">By clicking on Sign up, you agree to the <a href="">terms</a> and <a href="">conditions</a> of that license.
</p>
            </div>
    </div>
     <div class="row">
        <div class="col text-center p-2">
                <button class="facebook social-login-button" onclick="location.href='<?php echo $loginUrl; ?>';"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</button>
            </div>
    </div>
     <div class="row">
        <div class="col text-center p-2">
                   <button class="twitter social-login-button" data-toggle="modal" data-target="#signUpModel"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</button>
            </div>
    </div>
     <div class="row">
        <div class="col text-center p-2">
        <button class="linkdin social-login-button" onclick="location.href='https://doozycodsys.com/NEXUS/Web/email-verification.php';"><i class="fa fa-linkdin" aria-hidden="true"></i>Linkdin</button>
            </div>
    </div>
    <div class="row">
        <div class="col text-center p-2">
                     <p class="normal-text"> We won’t post to SNS without your permission.</p>
            </div>
    </div>
   </div>
</section>
<?php include_once('template-parts/login-footer.php'); ?>