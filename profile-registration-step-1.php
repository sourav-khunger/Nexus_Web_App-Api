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

if(isset($_SESSION['social_id']))
{
    $user->user_social_id=$_SESSION['social_id'];
    $stmt=$user->getUserRegistrationStep();
    $step=$stmt->fetch(PDO::FETCH_ASSOC);
   
    if($step['step']=='2')
            {
            $newURL='profile-registration-step-2.php';
            header('Location: '.$newURL);
    }
    else if($step['step']=='3')
    {
         $newURL='home.php';
        header('Location: '.$newURL);
    }
}

if(isset($_SESSION['social_id']))
{
     
    $user->user_social_id=$_SESSION['social_id'];
    $stmt=$user->getUserDatawithSocialID();
    $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
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
}

else{
    $newURL='index.php';
    header('Location: '.$newURL);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Profile Registration Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/js/toast/jquery.toast.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <style>
    body{
         background-color:#E5E5E5;
     }
    </style>
  </head>
  <body>

<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 p-0 mt-3 mb-2">
            <div class="card profile-data">
                <div class="logo-image">
                <img class="login-logo" src="assets/images/logo.png" height:"100px" width:"150px" >
                </div>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="account" class="active done"><strong>SNS Registration</strong></li>
                                <li id="payment" class="active done"><strong>Profile Info</strong></li>
                                <li id="payment" class="in_progress"><strong>The purpose of use</strong></li>
                            </ul> <!-- fieldsets -->
                             <h4 class="heading-text">Profile Info</h4>
                             <p class="normal-text">Can be changed later</p>
                             <div class="avatar-profile">
                             <label for="profile-picture">
                             <img id="previewImg" src="<?php if(!empty($user_data['user_profile_photo'])){ echo $user_data['user_profile_photo']; } else { ?>assets/images/user.png <?php } ?> "alt="Placeholder">
                             </label>
                             <input id="profile-picture" class="image" type="file" name="file" onchange="previewFile(this);" required>
                </div>
    <div class="form-fields text-left">
        <div class="form-group">
        <label for="InputFullName"><span class="required">required</span>Full Name</label>
            <input type="text" class="form-control" id="InputFullName" required value="<?php if(!empty($user_data['user_name'])){ echo $user_data['user_name']; } else { ?> <?php } ?>">
    </div>
    
<div class="form-group">
        <label for="activityArea"><span class="required">required</span>Activity Area</label>
        <select id="InputActivity" class="activity selectpicker">
    <option hidden >Choose your activity area</option>
    <?php foreach($activity_data as $activity)
    { 
    echo '<option value='.$activity['activity_name_english'].' >'.ucwords($activity['activity_name_english']).'</option>';
    } ?>
</select>
</div>
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
            <input type="text" class="form-control" id="InputOccupation" required>
            </div>
            <div class="form-group">
        <label for="InputBriefJobHistory"><span class="required">required</span>Brief Job History</label>
          <textarea class="form-control" id="InputBriefJobHistory" rows="3"></textarea>
          
            </div>
              <div class="form-group">
        <label for="InputSkills"><span class="required">required</span>Skills</label>
        <div id="skill_wrapper">
       <a href="" data-toggle="modal" data-target="#skill-section" id="skills"><div id="InputSkillss"><input type="text" class="form-control" id="InputSkills" name='skills[]' placeholder="Please select your skills" disabled></div></a>
      
       </div>
    <!--<div class="add-btn-div">-->
    <!--<button id="add_more" class="btn">Add More</button> -->
    <!--</div>-->
            </div>
            <div class="btn-next">
             <button type="submit" id="step-2-register" class="btn btn-steps">Next</button>
             </div>
              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="skill-section" tabindex="-1" role="dialog" aria-labelledby="skill-section" aria-hidden="true">
    
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close skills" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-header">
        <h5 class="modal-title" id="skill-section">Skills<span>⚡</span></h5>
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
        <button type="button" class="btn cancle-skills" data-dismiss="modal">Cancle</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/profile-steps.js"></script>
<script src="assets/js/button-color.js"></script>
<script src="assets/js/toast/jquery.toast.js"></script>
<script src="assets/js/custom/registration-step1.js"></script>
</body>
</html>