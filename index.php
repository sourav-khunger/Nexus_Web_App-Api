<?php include_once('template-parts/login-header.php'); 
require_once 'vendor/autoload.php';
require_once 'social/hybrid-login.php';
?>
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
                <button class="facebook social-login-button" onclick="location.href='?provider=facebook';" ?><i class="fab fa-facebook" aria-hidden="true"></i>Facebook</button>
            </div>
    </div>
     <div class="row">
        <div class="col text-center p-2">
                   <button class="twitter social-login-button"  onclick="location.href='?provider=twitter';" ><i class="fab fa-twitter" aria-hidden="true"></i>Twitter</button>
            </div>
    </div>
     <div class="row">
        <div class="col text-center p-2">
        <button class="linkdin social-login-button" onclick="location.href='?provider=linkedin';"><i class="fab fa-linkedin-in"></i>Linkedin</button>
            </div>
    </div>
    <div class="row">
        <div class="col text-center p-2">
                     <p class="normal-text"> We won’t post to SNS without your permission.</p>
                 
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pou">-->
<!--  Launch demo modal-->
<!--</button>-->
            </div>
    </div>
   </div>
</section>


<!-- Modal -->
<div class="modal fade" id="pou" tabindex="-1" role="dialog" aria-labelledby="pou" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pou">We do not accept using any purpose of below</h5>
        
      </div>
      <div class="modal-body">
          <div class="checkboxs">
  <label class="main">
      <input type="checkbox">
      <span class="w3docs"></span><br>
     Using for dating purpose   
 </label><br/>
  <label class="main">
      <input type="checkbox">
      <span class="w3docs"></span><br>
     Using for one sided business purpose   
 </label><br/>
  <label class="main">
      <input type="checkbox">
      <span class="w3docs"></span><br>
    Using for network business /MLM/religion purpose etc   
 </label><br/>
  <!--<input type="checkbox"  class="tick" name="checkbox3">-->
  <!--<label class="check" for="checkbox3"> Using for network business /MLM/religion purpose etc</label><br><br>-->
  </div>
  <h3 class="heading">※If you violate the regulations more than a certain number of times, your account will be stop</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="submitpop">Sign Up</button><br/>
        <button type="button" class="cancel cbtn" data-dismiss="modal">Cancel</button>
        </div>
     
    </div>
  </div>
</div>
<?php include_once('template-parts/login-footer.php'); ?>
