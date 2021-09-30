<?php
session_start();
include_once 'web-api/config/db.php';
include_once 'web-api/config/core.php';
include_once 'web-api/objects/user.php';

// instantiate database and user object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$user = new User($db);
if(!empty($_SESSION))
{
$user->user_social_id=$_SESSION['social_id'];
$stmt=$user->getUserRegistrationStep();
$step=$stmt->fetch(PDO::FETCH_ASSOC);
echo $step['step'];
if($step['step']=='1')
 {
 $newURL='profile-registration-steps.php';
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
    <title>Email Verfication Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" href="assets/css/style.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <style>
     body{
         background-color:#E5E5E5;
     }
     </style>
  </head>
  <body>
      <section class="login">
      <div class="container login-form-card">
<div class="row">
    <div class="col logo-image mt-4">
        <img class="login-logo" src="assets/images/logo.png" height:"100px" width:"150px" >
    </div>
    </div>
    <div class="row">
        <div class="col text-center">
                <h4 class="heading-text">Please enter your e-mail address</h4>
            </div>
    </div>
    <form id="email-verfication" class="text-center p-4" method="post">
  <div class="form-group p-4">
    <input type="email" class="form-control" id="emailVerification" name="email" aria-describedby="emailHelp" required>
  </div>
  <p id="on-form-submit" style="display:none;">An email has send to <span id='email_span'></span>. Please complete the registration from the URL in the body of the email within 24 hours.</p>
  <button type="submit" id="submit" class="btn verify ">Send Verification Email</button>
 </form>
   </div>
</section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <?php echo $_SESSION['social_id'] ?>
<script>
$(document).ready(function() {
$("#email-verfication").submit(function(e){
 
   
    event.preventDefault();
     
    var social_id =<?php echo $_SESSION['social_id']; ?>;
    var email=$("#emailVerification").val();
    $('#on-form-submit').show();
    $('#next').show();
    $("#email_span").text(email);
    $("#submit").html("Send verification email <span style='color:#ff6a00'>again<span>");
    $('#submit').css("background-color", "black");
    
    
$.ajax({
                    url:'web-api/user/user-email-verification.php',
                    method:'POST',
                    data:{
                        email:email,
                        social_id:social_id
                    },
                  success:function(data){
                      alert(data);
                  }
                });
          
   
  
 })
});

</script>
  </body>
</html>