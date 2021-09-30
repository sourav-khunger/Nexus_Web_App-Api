  <?php include_once('template-parts/header.php');?>
<?php 
    //Get All Activites
    $stmt=$details->getAllActivities();
    $activity_data=$stmt->fetchAll(PDO::FETCH_ASSOC);

    //Get All Skills

	$stmt=$details->getAllSkills();
	$skills=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $childs = array();
    foreach($skills as &$item) $childs[$item['skill_parent_id']][] = &$item;
    unset($item);

    foreach($skills as &$item) if (isset($childs[$item['skill_id']]))
        $item['children'] = $childs[$item['skill_id']];
    unset($item);

    $skills_data = $childs[0];

?>


<div class="container">
	<div class="row">
		<div class="col-lg-12">

            <div class="card hovercard">
                <div class="cardheader" style="background: url('assets/images/banner.jpg');">
                <a href=""><img src="assets/images/icons/video-play.png"/></a>
                </div>
                <div class="avatar">
                    <img id="user_image" alt="" src="assets/images/user.png">
                    <label for="update-profile-picture">
                    <a>Edit</a>
                    </label>
                    <input id="update-profile-picture" class="image" type="file" name="file" onchange="previewProfileFile(this);" required="">
                </div>
            </div>
        </div>
	</div>
  <div class="row">
    <div class="col-md-3 mb-3">
        <ul class="nav flex-column" id="myTab" role="tablist">
  <li class="inactive pu">Profile</li>
  <li class="nav-item pu">
    <a class="active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true">Profile</a>
  </li>
  <li class="nav-item pu">
    <a class="" id="current-job-tab" data-toggle="tab" href="#current-job" role="tab" aria-controls="current-job" aria-selected="true">Current Job</a>
  </li>
  <li class="nav-item pu">
    <a class="" id="purpose-list-tab" data-toggle="tab" href="#purpose-list" role="tab" aria-controls="purpose-list" aria-selected="true">Purpose List</a>
  </li>
  <li class="nav-item pu">
    <a class="" id="annonymous-mode-tab" data-toggle="tab" href="#annonymous-mode" role="tab" aria-controls="annonymous-mode" aria-selected="false">Annonymous Mode</a>
  </li>
  <li class="inactive pu">Settting</li>
  <li class="nav-item pu">
    <a class="" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications" aria-selected="false">Notifications</a>
  </li>
  <li class="nav-item pu">
    <a class="" id="email-address-tab" data-toggle="tab" href="#email-address" role="tab" aria-controls="email-address" aria-selected="false">Email Address</a>
  </li>
  <li class="nav-item pu">
    <a class="" id="sign-out-tab" data-toggle="modal" data-target="#logout" role="tab" aria-controls="sign-out" aria-selected="false">Sign Out</a>
  </li>
  <li class="nav-item pu">
    <a class="" id="account-recess-tab" data-toggle="tab" href="#account-recess" role="tab" aria-controls="account-recess" aria-selected="false">Account Recess/Delete</a>
  </li>
</ul>
    </div>
    
    <!-- /.col-md-4 -->
<div class="col-md-6">
<div class="tab-content" id="myTabContent">

<!--------- Profile tab ------------>

<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
<form>
<div class="row cstm">
<div class="col-md-6">
    <div class="form-group">
        <label for="InputFullName"><span class="required">required</span><span class="pu_heading">Full Name</span></label>
            <input type="text" class="form-control" id="InputFirstName" required value="<?php if(!empty($user_data['first_name'])){ echo $user_data['first_name']; } else { ?> <?php } ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
<div class="custom-control custom-switch">
    <label class="annony">Annonymous Mode</label>
  <input type="checkbox" class="custom-control-input" id="annoymousToggle">
  <label class="custom-control-label" for="annoymousToggle"></label>
</div>
<input type="text" class="form-control" id="InputLastName" required value="<?php if(!empty($user_data['last_name'])){ echo $user_data['last_name']; } else { ?> <?php } ?>">
</div>
</div>
</div>
<div class="form-group col-md-12">
    <label for="SNS"><span class="optional">any</span><span class="pu_heading">Link SNS</span></label>
    <div class="custom-input-box d-flex"><img class="social-icon" src="assets/images/sns/fb2.png" height='20px' width='20px' /><input type="text" class="form-control" id="fb2su"  placeholder="https://www.facebook.com/"><img class="toggle-icon" src="assets/images/sns/toggle.png" height='15px' width='27px' /></div>
    <div class="custom-input-box d-flex"><img class="social-icon" src="assets/images/sns/fb.png" height='20px' width='20px' /><input type="text" class="form-control" id="fbsu"  placeholder="https://www.facebook.com/"><img class="toggle-icon" src="assets/images/sns/toggle.png" height='15px' width='27px' /></div>
    <div class="custom-input-box d-flex"><img class="social-icon" src="assets/images/sns/wantedly.png" height='20px' width='20px' /><input type="text" class="form-control" id="wtsu"  placeholder="https://www.wantedly.com/id/"><img class="toggle-icon" src="assets/images/sns/toggle.png" height='15px' width='27px' /></div>
    <div class="custom-input-box d-flex"><img class="social-icon" src="assets/images/sns/twitter.png" height='20px' width='20px' /><input type="text" class="form-control" id="twsu"  placeholder="https://twitter.com/"><img class="toggle-icon" src="assets/images/sns/toggle.png" height='15px' width='27px' /></div>
    <div class="custom-input-box d-flex"><img class="social-icon" src="assets/images/sns/insta.png" height='20px' width='20px' /><input type="text" class="form-control" id="istsu"  placeholder="https://www.instagram.com/"><img class="toggle-icon" src="assets/images/sns/toggle.png" height='15px' width='27px' /></div>
    <div class="custom-input-box d-flex"><img class="social-icon" src="assets/images/sns/link.png" height='20px' width='20px' /><input type="text" class="form-control" id="linksu"  placeholder="https://"><img class="toggle-icon" src="assets/images/sns/toggle.png" height='15px' width='27px' /></div>
    <div class="custom-input-box d-flex"><img class="social-icon" src="assets/images/sns/git.png" height='20px' width='20px' /><input type="text" class="form-control" id="gitsu"  placeholder="https://github.com/"><img class="toggle-icon" src="assets/images/sns/toggle.png" height='15px' width='27px' /></div>
    <div class="custom-input-box d-flex"><img class="social-icon" src="assets/images/sns/yt.png" height='20px' width='20px' /><input type="text" class="form-control" id="ytsu"  placeholder="https://www.youtube.com/channel/"><img class="toggle-icon" src="assets/images/sns/toggle.png" height='15px' width='27px' /></div>
</div>
  <div class="form-group col-md-12">
        <label for="activityArea"><span class="required">required</span><span class="pu_heading">Activity Area</span></label>
        <select id="InputActivity" class="activity selectpicker">
 <?php if(!empty($user_data['user_activity_area'])){ 
echo "<option value=".$user_data[user_activity_area].' >'.ucwords($user_data[user_activity_area])."</option>"; } 
else{
?>
    <option hidden >Choose your activity area</option>
<?php } ?>
    <?php foreach($activity_data as $activity)
    { 
    echo '<option value='.$activity['activity_name_english'].' >'.ucwords($activity['activity_name_english']).'</option>';
    } ?>
</select>
</div>
<div class="btn-next">
<button type="submit" id="update_sns" class="btn btn-steps on">Save</button>
</div>
</form>
</div>
 <!-------------- current job tab -------------------> 
  
  <div class="tab-pane fade" id="current-job" role="tabpanel" aria-labelledby="current-job-tab">
   <div class="form-group">
                <h3 class="form-subtitle">
                    Current Work
                    </h3>
        <label for="InputCompanyName"><span class="optional">optional</span>Comapany's name</label>
            <input type="text" class="form-control" id="InputCompanyName">
            </div> <div class="form-group">
        <label for="InputCompanyUrl"><span class="optional">optional</span>Comapany's URL</label>
            <input type="text" class="form-control" id="InputCompanyUrl">
            </div>
            <div class="form-group">
        <label for="InputOccupation"><span class="required">required</span>Occupation</label>
            <input type="text" class="form-control" id="InputOccupation">
            </div>
            <div class="form-group">
        <label for="InputBriefJobHistory"><span class="required">required</span>Brief Job History</label>
          <textarea class="form-control" id="InputBriefJobHistory" rows="3" ></textarea>
          
            </div>
              <div class="form-group">
        <label for="InputSkills"><span class="required">required</span>Skills</label>
        <div id="skill_wrapper">
       <a href="" data-toggle="modal" data-target="#skill-section" id="skills"><div id="InputSkillss"><input type="text" class="form-control" id="InputSkills" name='skills[]' placeholder="Please select your skills" disabled></div></a>
      
       </div>
       </div>
       <div class="btn-next">
<button type="submit" id="update_job" class="btn btn-steps">Save</button>
</div>
</div>
 <!-------------- Purpose list tab ------------------->  
  
  <div class="tab-pane fade" id="purpose-list" role="tabpanel" aria-labelledby="purpose-list-tab">
 
 <div class="form-data">
<div class="form-fields text-left" id="fields">
<div class="form-group purposeGroup" id="purposes_data">
<label for="purposeSelect"><span class="required">required</span>Purpose</label>
<select id="purposeSelect"  class="activity selectpicker" onchange="myFunction(this.id)">
<option hidden >Please choose purpose</option>
    <?php foreach($purpose_data as $purposes)
    { 
    echo '<option value='.$purposes['purpose_id'].'>'.$purposes['purpose_name_english'].'</option>';
    } ?>
</select>
</div>
<div class="form-group status hide" id="status">
        <label for="statusSelect"><span class="required">required</span>Status</label>
        <select id="statusSelect" class="activity selectpicker">
    <option hidden >Please choose Status</option>
    <?php foreach($status_data as $status)
    { 
    echo '<option value='.$status['status_id'].'>'.$status['status_name_english'].'</option>';
    } ?>
</select>
</div>

</div>
</div>
<div class="add-btn-div">
<button id="add_more" class="btn">Add More</button> 
</div>
<div class="btn-next">
<button type="submit" id="step-3-register" class="btn btn-steps">Start</button>
</div>   
 
  </div>
  
 <!-------------- Annonymous mode tab ------------------->  
  
  <div class="tab-pane fade" id="annonymous-mode" role="tabpanel" aria-labelledby="annonymous-mode-tab">
  <h2 class="annonymous-title">Annonymous Mode</h2>
    <p>When anonymous mode is turned on, your information except the following information will be private.</p>
    <ul>
    <li>-Activity area</li>
    <li>-Occupation</li>
    <li>-skill</li>
     <li>-purpose of use</li>
     </ul>
    <p>Even if you turn on anonymous make, your all profile information will be shown to matched people.</p>
<div class="btn-next">
    
<button type="submit" id="annonymous_mode" class="btn btn-steps"></button>
</div>
  </div>
  
 <!-------------- Notification tab ------------------->  
 
  <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
  <h2 class="notification-title">Notification Setting</h2>
  <!--------------- Push Notifications -------------------->
  <div class="push-notifications">
   <h2 class="push-title">Push Notifications</h2>  
   <div class="custom-control custom-switch">
    <label class="annony">New Message</label>
  <input type="checkbox"  class="custom-control-input" id="pushnewmessage">
  <label class="custom-control-label" for="pushnewmessage"></label>
</div>

 <div class="custom-control custom-switch">
    <label class="annony">Recommend & Matching</label>
  <input type="checkbox"  class="custom-control-input" id="pushrecommend">
  <label class="custom-control-label" for="pushrecommend"></label>
</div>

 <div class="custom-control custom-switch">
    <label class="annony">Realtime talk<br><span class="warning-mode" id="pwarning"></span></label>
  <input type="checkbox"  class="custom-control-input" id="pushrealtime">
  <label class="custom-control-label" for="pushrealtime"></label>
</div>

 <div class="custom-control custom-switch">
    <label class="annony">News from our service</label>
  <input type="checkbox"  class="custom-control-input" id="pushnewservice">
  <label class="custom-control-label" for="pushnewservice"></label>
</div>
</div>
<!---------- Message Notifications----------------------->

 <div class="message-notifications">
   <h2 class="text-title">Message Notification</h2>  
   <div class="custom-control custom-switch">
    <label class="annony">New Message</label>
  <input type="checkbox"  class="custom-control-input" id="txtnewmessage">
  <label class="custom-control-label" for="txtnewmessage"></label>
</div>
<div class="custom-control custom-switch">
    <label class="annony">Recommend & Matching</label>
  <input type="checkbox"  class="custom-control-input" id="txtrecommend">
  <label class="custom-control-label" for="txtrecommend"></label>
</div>
 <div class="custom-control custom-switch">
    <label class="annony">Realtime talk<br><span class="warning-mode" id="twarning"></span></label>
  <input type="checkbox"  class="custom-control-input" id="txtrealtime">
  <label class="custom-control-label" for="txtrealtime"></label>
</div>
 <div class="custom-control custom-switch">
    <label class="annony">News from our service</label>
  <input type="checkbox"  class="custom-control-input" id="txtnewservice">
  <label class="custom-control-label" for="txtnewservice"></label>
</div>
</div>
<div class="btn-next">
<button type="submit" id="save_notifications" class="btn btn-steps on">Save</button>
</div>
</div>
  
  <!-------------- Email address tab ------------------->  
  
  <div class="tab-pane fade" id="email-address" role="tabpanel" aria-labelledby="email-address-tab">
  <h2 class="email-title">Email Address</h2>
 
  <div class="current-email">
  <h2 class="title">Current Email</h2>
  <p class="email" id="user_email"></p>
  </div>
  
   <div class="new-email">
  <h2 class="title">New Email Address</h2>
  <input type="text" class="form-control" id="InputNewEmail">
  <p id="on-form" style="display:none;">An email has send to <span id='email_span'></span>. Please complete the registration from the URL in the body of the email within 24 hours.</p>
  </div>
  <div class="btn-next">
<button type="submit" id="send_confirmation_email" class="btn btn-steps on">Send Confirmation Email</button>
</div>
  </div>
  
  <!-------------- Sign out tab ------------------->  
  
  <!--<div class="tab-pane fade" id="sign-out" role="tabpanel" aria-labelledby="sign-out-tab">-->
  <!--<h2>Sign Out</h2>-->
  <!--  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, eveniet earum. Sed accusantium eligendi molestiae quo hic velit nobis et, tempora placeat ratione rem blanditiis voluptates vel ipsam? Facilis, earum!</p>-->
  <!--</div>-->
  
  <!-------------- Account recess mode tab ------------------->  
  
  <div class="tab-pane fade" id="account-recess" role="tabpanel" aria-labelledby="account-recess-tab">
  <h2 class="recess-title">Recess/Delete</h2>
 
  <div class="recess">
  <h2 class="title">Recess</h2>
 <p class="content" id="recess_content"></p>
 <div class="btn-next">
<button type="submit" id="recess_mode_btn"  class="btn btn-steps on">Turn on the recess mode</button>
</div>
  </div>
  
   <div class="delete">
  <h2 class="title">Delete</h2>
   <p class="content">When you unsubscribe, all data including previous matches and messages will be deleted.</p>
   <div class="btn-next">
<button type="submit" id="delete_mode_btn" data-toggle="modal" data-target="#delete-account" class="btn btn-steps on">Delete</button>
</div>
  </div>
  
</div>



</div>

</div>
    <!-- /.col-md-8 -->
  </div>
  
  
  
</div>
<!-- /.container -->



<!---------------------- Modal Box Skills ------------------->

<div class="modal fade" id="skill-section" tabindex="-1" role="dialog" aria-labelledby="skill-section" aria-hidden="true">
    
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close skills" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-header">
        <h5 class="modal-title" id="skill-section">Skills<span>âš¡</span></h5>
      </div>
      <div class="modal-body">
<div class="row skill-box">
    <div class="col-md-6">
        <h4 class="skill-head">1. Select category</h4>
      <div class="overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-light" style="max-height: 246px;">
     <ul class="skill_ul">
<?php foreach($skills_data as $skills) {
    if($skills[skill_parent_id]=='0'){
     echo '<a class="cursor filter-button" data-filter="skill_'.$skills['skill_id'].'"><li class="skill_li" >'.$skills['skill_name_english'].'</li></a>';
    }
}
     ?>
    </ul>
      </div>
        </div>
    <div class="col-md-6">
         <h4 class="skill-head">2. Select Skills</h4>
         <div id="child-skills" class="overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-light" style="max-height: 246px; min-height: 246px;">
            <div id="onskill-hide" class="flex-column cstm justify-content-center align-items-center" style="display:flex;">
            <h4 class="ssc">Select categories</h4> 
            </div>
            <?php echo'<ul class="skills">';
      foreach($skills_data as $skills){
        if($skills['children']){
            $children=$skills['children'];
            foreach($children as $child){
                echo'<li class="filter skill_'.$skills['skill_id'].'"><input name="skill_ids" class="me-1" data-name="'.$child['skill_name_english'].'" type="checkbox" value="'.$child['skill_id'].'" aria-label="..."><span class="skill_name">'.$child['skill_name_english'].'</span></li>';
                if($child['children'])
                {
                    echo '<li><ul class="skills">';
                    $subchild=$child['children'];
                    foreach($subchild as $sub){
                       echo'<li class="filter skill_'.$skills['skill_id'].'"><input name="skill_ids"  class="me-1" type="checkbox" data-name="'.$sub['skill_name_english'].'" value="'.$sub['skill_id'].'" aria-label="..."><span class="skill_name">'.$sub['skill_name_english'].'</span></li>'; 
                    }
                    echo '</ul></li>';
                }
                
            
            }
        }
    }
echo '</ul>'; ?>
      </div>
    </div>
    </div>
      </div>
      <div class="modal-footer">
       <button type="button"  id="save-skills" class="btn save-skills">DONE</button>
       <br/>
        <button type="button" class="btn cancle-skills" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-------------------- Skills Modal Ends Here -------------------------------->

<!--------------------- Recess Modal ----------------------------------------->
<div class="modal fade modal-box-my" id="recess-mode" tabindex="-1" role="dialog" aria-labelledby="recess-mode" aria-hidden="true">
    
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close skills" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-header">
        <h5 class="modal-title" id="recess-mode">Turned on the recess mode<span>ðŸ˜´</span></h5>
      </div>
      <div class="modal-body">
      Your information will not be displayed as matching candidates.
      turn off the recess mode to  resume.
      </div>
      <div class="modal-footer">
       <button type="button" data-dismiss="modal" aria-label="Close" class="btn main-on">DONE</button>
      </div>
    </div>
  </div>
</div>

<!--------------------- Recess Modal Ends here ----------------------------------------->


<!--------------------- Delete Modal ----------------------------------------->
<div class="modal fade modal-box-my" id="delete-account" tabindex="-1" role="dialog" aria-labelledby="delete-account" aria-hidden="true">
    
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close skills" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-header">
        <h5 class="modal-title" id="delete-account">Do you really want to delete your account?<span>ðŸ˜¢</span></h5>
      </div>
      <div class="modal-body">
      <div class="part-1">
      <p>Deleted data cannot be restoredã€‚Also, this operation cannot be undone.</p>
      </div>
      <div class="part-2">
      <p>I'm sorry I didn't meet your expectations.<br/>
      Please tell us the reason to improve the service.</p>
    <textarea class="form-control" id="reasonOfDelete" rows="3"></textarea>
      </div>
      </div>
      <div class="modal-footer">
       <button type="button" data-dismiss="modal" aria-label="Close" class="btn main-on">DONE</button>
      </div>
    </div>
  </div>
</div>

<!--------------------- Delete Modal Ends here ----------------------------------------->


<div class="modal fade modal-box-my" id="logout" tabindex="-1" role="dialog" aria-labelledby="logout" aria-hidden="true">
    
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close skills" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-header">
        <h5 class="modal-title" id="logout">Do you really want to Logout?<span>😢</span></h5>
      </div>
      <div class="modal-body">
      <!---- Content here ---------->
      </div>
      <div class="modal-footer">
       <button type="button" id="sign_out" onclick="signout();" class="btn main-on">Yes</button>
       <br>
       <button type="button" data-dismiss="modal" aria-label="Close" class="btn cancle">cancle</button>
      </div>
    </div>
  </div>
</div>


<!-----------Logout Modal Ends Here---------->

<?php include_once('template-parts/footer.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="assets/js/toast/jquery.toast.js"></script>

<script>
$(document).ready(function () {
var social_id ="<?php echo $_SESSION['social_id']; ?>";

getUSERData();

function getUSERData(){

  $.ajax({
            url:'web-api/details/get-user-data.php',
            method:'POST',
            data:{
                user_social_id:social_id
                },
                success:function(data){
              
                    var demo=JSON.parse(data);
                    
                    localStorage.setItem('user_id',demo.User_profile_data.user_id);
                    $("#InputFirstName").val(demo.User_profile_data.first_name);
                    $("#InputLastName").val(demo.User_profile_data.last_name);
                    $("#fb2su").val(demo.User_profile_data.user_social_link);
                    $("#fbsu").val(demo.User_profile_data.facebook);
                    $("#wtsu").val(demo.User_profile_data.wantedly);
                    $("#twsu").val(demo.User_profile_data.twitter);
                    $("#istsu").val(demo.User_profile_data.instagram);
                    $("#linksu").val(demo.User_profile_data.linkdin);
                    $("#gitsu").val(demo.User_profile_data.github);
                    $("#ytsu").val(demo.User_profile_data.youtube);
                    $("#InputActivity").val(demo.User_profile_data.user_activity_area);
                    $("#InputCompanyName").val(demo.User_profile_data.company_name);
                    $("#InputCompanyUrl").val(demo.User_profile_data.company_url);
                    $("#InputOccupation").val(demo.User_profile_data.occupation);
                    $("#InputBriefJobHistory").html(demo.User_profile_data.job_history);
                    $("#user_image").attr("src", demo.User_profile_data.user_profile_photo);
                    $("#user_email").html(demo.User_profile_data.user_email);
                    $("#mini_user_image").attr("src", demo.User_profile_data.user_profile_photo);
                     if(demo.User_profile_data.recess_status=='true')
                     {
                      $("#recess_mode_btn").attr('recess-mode', 'on');
                      $("#recess_mode_btn").addClass("on");
                      $("#recess_mode_btn").html('Turn off the Recess Mode');
                      $("#recess_mode_btn").removeClass("off");
                      $("#recess_content").html('Turn Off recess mode to show your information to matching candidates.');
                     }
                     else if(demo.User_profile_data.recess_status=='false')
                    {
                      $("#recess_mode_btn").attr('recess-mode','off');
                      $("#recess_mode_btn").addClass("off");
                      $("#recess_mode_btn").html('Turn on the Recess Mode');
                      $("#recess_mode_btn").removeClass("on");
                      $("#recess_content").html('if you turnn on the recess mode, your information will not be displayed as matching candidates.You can change the recess mode to OFF any time.');
                     }

                    if(demo.user_settings.push_new_message=='true')
                    {
                      $("#pushnewmessage").prop('checked', true);  
                    }
                    else{
                        $("#pushnewmessage").prop('checked', false);  
                    }
                    if(demo.user_settings.push_recommend=='true')
                    {
                      $("#pushrecommend").prop('checked', true);  
                    }
                    else{
                        $("#pushrecommend").prop('checked', false);  
                        
                    }
                    if(demo.user_settings.push_realtime_talk=='true')
                    {
                      $("#pushrealtime").prop('checked', true);  
                      $("#pwarning").html("");
                    }
                    else{
                        $("#pushrealtime").prop('checked', false);  
                        $("#pwarning").html("â€»When using You must always turn on push notifications.");
                    }
                    
                    if(demo.user_settings.push_news=='true')
                    {
                      $("#pushnewservice").prop('checked', true);  
                    }
                    else{
                        $("#pushnewservice").prop('checked', false);  
                    }
                    if(demo.user_settings.email_new_message=='true')
                    {
                      $("#txtnewmessage").prop('checked', true);  
                    }
                    else{
                        $("#txtnewmessage").prop('checked', false);  
                    }
                    if(demo.user_settings.email_recommend=='true')
                    {
                      $("#txtrecommend").prop('checked', true);  
                    }
                    else{
                        $("#txtrecommend").prop('checked', false);  
                    }
                    if(demo.user_settings.email_realtime_talk=='true')
                    {
                      $("#txtrealtime").prop('checked', true);  
                      $("#twarning").html("");
                    }
                    else{
                        $("#txtrealtime").prop('checked', false);  
                        $("#twarning").html("â€»When using You must always turn on push notifications.");
                    }
                    if(demo.user_settings.email_news=='true')
                    {
                      $("#txtnewservice").prop('checked', true);  
                    }
                    else{
                        $("#txtnewservice").prop('checked', false);  
                    }
                    if(demo.User_profile_data.annonymous_mode=='true')
                    {
                      $("#annoymousToggle").prop('checked', true);  
                      $("#annonymous_mode").addClass("on");
                      $("#annonymous_mode").removeClass("off");
                      $("#annonymous_mode").html('Annonymous Mode On');
                    }
                    else if(demo.User_profile_data.annonymous_mode=='false'){
                      $("#annoymousToggle").prop('checked', false);  
                      $("#annonymous_mode").addClass("off");
                      $("#annonymous_mode").removeClass("on");
                      $("#annonymous_mode").html('Annonymous Mode Off');
                    }
                  }
                });
}


var user_id=localStorage.getItem('user_id');



$("#recess_mode_btn").click(function (e) { 
    e.preventDefault();
    var status;
    var mode=$(this).attr('recess-mode');
    if(mode=="on")
    {
        status='false';
        msg='Recess mode turned OFF';
    }
    else if(mode=="off")
    {
        status='true';
        msg='Recess mode turned ON';
    }      
   var jsonData = JSON.stringify({"user_id":user_id,"status": status});
    $.ajax({
            type: "POST",
            url: "web-api/user/update-recess-status.php",
            data: jsonData,
            dataType: "json",
            contentType: "application/json",
            success: function (response) {
            if(response.success==1)
            {
              
            }
            getUSERData();
                                        }
        });  
});  

$("#update_job").click(function (e){
e.preventDefault();
 var company_name=$("#InputCompanyName").val();
 var company_url=$("#InputCompanyUrl").val();
 var occupation=$("#InputOccupation").val();
 var job_history=$("#InputBriefJobHistory").val();
//  var wantedly=$("#wtsu").val();
 var jsonData =JSON.stringify({"user_id":user_id,
                               "company_name": company_name,
                               "company_url":company_url,
                               "occupation":occupation,
                               "job_history":job_history,
                                 });
 console.log('user_work',jsonData);
  $.ajax({
            type: "POST",
            url: "web-api/user/update-user-work-status.php",
            data: jsonData,
            dataType: "json",
            contentType: "application/json",
            success: function (response) {
            if(response.success==1)
            {
            $.toast({
            heading: 'Dear User',
            text: response.message,
            position: 'top-right',
            loaderBg: 'black',
            bgColor:'#FF3A99',
            icon: 'success',
            textColor: '#FFFF',
            hideAfter: 3000,
            stack: 6
        });
         getUSERData();
        }
        }
        });  
                                 
                                 
                                 
})

$("#update_sns").click(function (e) { 
    e.preventDefault();
    var first_name=$("#InputFirstName").val();
    var last_name=$("#InputLastName").val();
    var user_social_link=$("#fb2su").val();
    var facebook=$("#fbsu").val();
    var wantedly=$("#wtsu").val();
    var twitter=$("#twsu").val();
    var instagram=$("#istsu").val();
    var linkdin=$("#linksu").val();
    var github=$("#gitsu").val();
    var youtube=$("#ytsu").val();
    var user_activity_area=$("#InputActivity").val();
    
    var jsonData =JSON.stringify({"user_id":user_id,
                                  "first_name": first_name,
                                  "last_name":last_name,
                                  "facebook":facebook,
                                  "wantedly":wantedly,
                                  "twitter":twitter,
                                  "instagram":instagram,
                                  "linkdin":linkdin,
                                  "github":github,
                                  "youtube":youtube,
                                  "user_activity_area":user_activity_area,
                                  "user_social_link":user_social_link
                                 });
    
    $.ajax({
            type: "POST",
            url: "web-api/user/update-user-profile.php",
            data: jsonData,
            dataType: "json",
            contentType: "application/json",
            success: function (response) {
            if(response.success==1)
            {
            $.toast({
            heading: 'Dear User',
            text: response.message,
            position: 'top-right',
            loaderBg: 'black',
            bgColor:'#FF3A99',
            icon: 'success',
            textColor: '#FFFF',
            hideAfter: 3000,
            stack: 6
        });
         getUSERData();
        }
        }
        });  
}); 



$("#annonymous_mode").click(function (e) { 
    e.preventDefault();

    if($("#annoymousToggle").prop("checked") == true){
        annonymous_mode='false';  
        msg='Annonymous mode turned OFF.';
        }
    else if($("#annoymousToggle").prop("checked") == false){
        annonymous_mode='true';
        msg='Annonymous mode turned ON.';
        }
      
   var jsonData = JSON.stringify({"user_id":user_id,"annonymous_mode": annonymous_mode});
    $.ajax({
            type: "POST",
            url: "web-api/user/update-annonymous-status.php",
            data: jsonData,
            dataType: "json",
            contentType: "application/json",
            success: function (response) {
            if(response.success==1)
            {
            $.toast({
            heading: 'Dear User',
            text: msg,
            position: 'top-right',
            loaderBg: 'black',
            bgColor:'#FF3A99',
            icon: 'success',
            textColor: '#FFFF',
            hideAfter: 3000,
            stack: 6
        });
        }
        getUSERData();
    }
    });        

});












$("#annoymousToggle").change(function (e) { 
    e.preventDefault();
    var annonymous_mode;
    var msg;
    if($(this).prop("checked") == true){
    annonymous_mode='true';  
    msg='Annonymous mode turned ON.';
    }
    else if($(this).prop("checked") == false){
    annonymous_mode='false';
    msg='Annonymous mode turned OFF.';
    }
 var jsonData = JSON.stringify({"user_id":user_id,"annonymous_mode": annonymous_mode});
    $.ajax({
            type: "POST",
            url: "web-api/user/update-annonymous-status.php",
            data: jsonData,
            dataType: "json",
            contentType: "application/json",
            success: function (response) {
            if(response.success==1)
            {
            $.toast({
            heading: 'Dear User',
            text: msg,
            position: 'top-right',
            loaderBg: 'black',
            bgColor:'#FF3A99',
            icon: 'success',
            textColor: '#FFFF',
            hideAfter: 3000,
            stack: 6
        });
        }
        getUSERData();
    }
    });
    
});



$("#send_confirmation_email").click(function (e) { 
    e.preventDefault();
    var email=$("#InputNewEmail").val();
    $('#on-form').show();
    $("#email_span").text(email);
    var social_id ='<?php echo $_SESSION['social_id']; ?>';
            $.ajax({
                    url:'web-api/user/update-email-address.php',
                    method:'POST',
                    data:{
                        email:email,
                        social_id:social_id
                    },
                  success:function(response){
                    
                       if(response.success==1)
                        {  
                                
                         }
                  }
                });
});



$("#save_notifications").click(function (e) { 
    e.preventDefault();
     var user_id=localStorage.getItem('user_id');
     var push_new_message;
     var push_recommend;
     var push_matching;
     var push_realtime_talk;
     var push_news;
     var email_new_message;
     var email_recommend;
     var email_matching;
     var email_realtime_talk;
     var email_news;
     if($("#pushnewmessage").prop("checked") == true){
         push_new_message='true';
     }
     else if($("#pushnewmessage").prop("checked") == false){
        push_new_message='false';
     }
     if($("#pushrecommend").prop("checked") == true){
         push_recommend='true';
         push_matching='true';
     }
     else if($("#pushrecommend").prop("checked") == false){
        push_recommend='false';
        push_matching='true';
     }
     if($("#pushrealtime").prop("checked") == true){
         push_realtime_talk='true';
     }
     else if($("#pushrealtime").prop("checked") == false){
        push_realtime_talk='false';
     }
     if($("#pushnewservice").prop("checked") == true){
         push_news='true';
     }
     else if($("#pushnewservice").prop("checked") == false){
        push_news='false';
     }
     if($("#txtrecommend").prop("checked") == true){
         email_recommend='true';
         email_matching='true';
     }
     else if($("#txtrecommend").prop("checked") == false){
        email_recommend='false';
        email_matching='false';
     }
     if($("#txtrealtime").prop("checked") == true){
         email_realtime_talk='true';
     }
     else if($("#txtrealtime").prop("checked") == false){
        email_realtime_talk='false';
     }
     if($("#txtnewmessage").prop("checked") == true){
         email_new_message='true';
     }
     else if($("#txtnewmessage").prop("checked") == false){
        email_new_message='false';
     }
     if($("#txtnewservice").prop("checked") == true){
         email_news='true';
     }
     else if($("#txtnewservice").prop("checked") == false){
        email_news='false';
     }
     var jsonData = JSON.stringify({"user_id":user_id,"push_new_message": push_new_message, "push_recommend":push_recommend, "push_matching":push_matching, "push_realtime_talk":push_realtime_talk, "push_news":push_news, "email_new_message":email_new_message,"email_realtime_talk":email_realtime_talk,"email_matching":email_matching,"email_recommend":email_recommend,"email_news":email_news});
        $.ajax({
            type: "POST",
            url: "web-api/user/update-notfication-setting.php",
            data: jsonData,
            dataType: "json",
            contentType: "application/json",
            success: function (response) {
            getUSERData();
     $.toast({
            heading: 'Dear User',
            text: 'Your notifications settings updated successfully.',
            position: 'top-right',
            loaderBg: '#0000',
            bgColor:'#FF3A99',
            icon: 'success',
            textColor: '#FFFF',
            hideAfter: 3000,
            stack: 6
        });
            
            }
            });
     
     
     
     
     
     
});

});

</script>



<!----------- Update notification Setting ------------------------>





<script>
$(document).ready(function(){
$('.filter').hide('1000');
    $(".filter-button").click(function(){
       
        
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
             $('#onskill-hide').hide();
        }
        else
        {
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            $('#onskill-hide').hide();
            
        }
    });
    
    if ($(".filter-button").removeClass("active")) {
$(this).removeClass("active");
}
$(this).addClass("active");

});
</script>
<script>

$(document).ready(function () {
var tmp = [];
var SkillName = [];
$("input[name='skill_ids']").change(function() {

  var checked =$(this).val();
  var name ="<div class='demoSkills'>"+($(this).attr('data-name'))+"</div>";
      
    if ($(this).is(':checked')) {
      tmp.push(checked);
      SkillName.push(name);
     
    }else{
    tmp.splice($.inArray(checked, tmp),1);
    SkillName.splice($.inArray(name, SkillName),1);
    }
  });

$('#save-skills').on('click', function () {

var inputSkills='<input type="text" class="form-control" id="InputSkills" name="skills[]" placeholder="Please select your skills" disabled>';
if (Array.isArray(SkillName) && SkillName.length) {
  document.getElementById("InputSkillss").innerHTML=(SkillName.join(" "));
}
else{
document.getElementById("InputSkillss").innerHTML=inputSkills;
$("#InputSkillss").css('background', '#fffff');
$("#InputSkillss").css('padding', '0px');
}
$("#InputSkillss").css('background', '#f7f7f7');
$("#InputSkillss").css('padding', '5px');
$('#skill-section').modal('hide'); 
});


});






function signout()
{
   //$("#logout").modal.('hide');
    $.toast({
            heading: 'Dear User',
            text: 'logging out...',
            position: 'top-right',
            loaderBg: '#0000',
            bgColor:'#FF3A99',
            icon: 'warning',
            textColor: '#FFFF',
            hideAfter: 3000,
            stack: 6
    });
    var delay = 2000; 
    var url = 'https://nexus.doozycodsystems.com/logout.php'
    setTimeout(function(){ window.location = url; }, delay);
}



</script>
<script>
$("#pushrealtime").change(function (e) { 
    e.preventDefault();
    if($(this).prop("checked") == false){
    $("#pwarning").html("â€»When using You must always turn on push notifications.");
    }
    else{
        $("#pwarning").html("");
    }
});

$("#txtrealtime").change(function (e) { 
    e.preventDefault();
    if($(this).prop("checked") == false){
        $("#twarning").html("â€»When using You must always turn on push notifications.");  
        }
        else{
            $("#twarning").html("");
        }
    
});

</script>
<script>
function previewProfileFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
            $("#user_image").attr("src", reader.result);
            $("#mini_user_image").attr("src",reader.result);
             const data = reader.result.replace("data:", "").replace(/^.+,/, "");
                
              var jsonData = JSON.stringify({"data": data});
                 $.ajax({
                     type: "POST",
                     url: "web-api/user/update-user-profile-picture.php",
                     data: jsonData,
                     dataType: "json",
                     contentType: "application/json",
                     success: function (response) {
                    if(response.success==1)
                    {
                        $.toast({
            heading: 'Dear User',
            text: "Profile picture update successfully.",
            position: 'top-right',
            loaderBg: 'black',
            bgColor:'#FF3A99',
            icon: 'success',
            textColor: '#FFFF',
            hideAfter: 3000,
            stack: 6
        });
                    }
                   
                }
        });  
               
               
               
               
               
            }
             

            reader.readAsDataURL(file);
        }
    }
</script>
