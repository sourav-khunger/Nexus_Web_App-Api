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

// print_r($_SESSION); 

if(isset($_SESSION['social_id']))
{
    {
    $user->user_social_id=$_SESSION['social_id'];
    $stmt=$user->getUserRegistrationStep();
    $step=$stmt->fetch(PDO::FETCH_ASSOC);
   
  if($step['step']=='3')
    {
         $newURL='home.php';
        header('Location: '.$newURL);
    }
    else if($step['step']=='1')
     {
         $newURL='profile-registration-step-1.php';
        header('Location: '.$newURL);
    }
}
     
    $user->user_social_id=$_SESSION['social_id'];
    $stmt=$user->getUserDatawithSocialID();
    $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get All purposes
	$stmt=$details->getAllPurpose();
	$purpose_data=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
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
    
    //Get All Industries
	$stmt=$details->getAllindustries();
	$industries=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $childs = array();
    foreach($industries as &$item) $childs[$item['industry_parent_id']][] = &$item;
    unset($item);

    foreach($industries as &$item) if (isset($childs[$item['industry_id']]))
        $item['children'] = $childs[$item['industry_id']];
    unset($item);

    $industries_data = $childs[0];
    
    //Get All Fundings
	$stmt=$details->getAllFunding();
	$funding_data=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
		
	//Get All Buisness Status
	$stmt=$details->getAllBuisnessStatus();
	$status_data=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
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
                                <li id="account" class="active done"><strong>Profile Info</strong></li>
                                <li id="payment" class="active"><strong>The purpose of use</strong></li>
                            </ul> <!-- fieldsets -->
                            <!--<h4>This page in Under Construction.</h4>-->
                             <h4 class="heading-text">Purpose of Use</h4>
                             <p class="normal-text">Can be changed later</p>
<div class="form-data">
<div class="form-fields text-left" id="fields">
 
 

<div class="form-group purpose" id="purposes_data">
<label for="purposeSelect"><span class="required">required</span><span id="purpose_counter">First</span> Purpose</label>
<select id="purposeSelect" data-index="0" class="activity selectpicker required_for_purpose" onchange="myFunction(this.id)">
<option hidden >Please choose purpose</option>
    <?php foreach($purpose_data as $purposes)
    { 
    echo '<option value='.$purposes['purpose_id'].'>'.$purposes['purpose_name_english'].'</option>';
    } ?>
</select>
</div>

<!------------------ Status Starts here -------------------->

<div class="form-group status hide" id="status">
    <label for="statusSelect"><span class="required">required</span>Status</label>
    <select id="statusSelect" required class="activity selectpicker" data-index="0" onchange="statusPush(this.id)">
    <option hidden >Please choose Status</option>
    <?php foreach($status_data as $status)
    { 
    echo '<option value="'.$status['status_name_english'].'">'.$status['status_name_english'].'</option>';
    } ?>
</select>
</div>


<!------------------- Status Ends Here ----------------------->

<!-------------- Industry Fields ------------------->


<div id="industryInput" class="form-group industry hide"> 
    <label for="InputIndustry"><span class="required">required</span>type of Industry</label> 
    <div id="skill_wrapper outer"> 
      <a href=""data-index="0" onclick="industryPush(this.id)" data-toggle="modal" data-target="#industry-section" id="industry">
        <div id="InputIndustryy" class="required_for_purpose"><input data-index="0" type="text" class="required_for_purpose form-control pointer" id="InputIndustry" name="industry[]"  placeholder="Please select your industry" disabled>
      </div>
    </a>
   </div>
</div>

<!----------- Industry Fields Ends Here ------------->

<!---------- Vision Fields starts Here -------------->



<div id="visionInput" class="form-group vision hide">
  <label for="vision"><span class="optional">any</span>vision</label>
  <div id="skill_wrapper">
 <input data-index="0" type="text" class="form-control" onchange="visionPush(this.id)" id="vision">
 </div>
</div>

<!----------- Vison Fields Ends here ---------------->


<!-------------- Buisness fileds starts here ---------------->

<div id="buisnessInput" class="form-group buisness hide">
<label for="InputBusinessContent"><span class="required">required</span>Business Plan</label><textarea data-index="0" onchange="businessPush(this.id)" class="required_for_purpose form-control" id="InputBusinessContent" rows="3">
</textarea>
</div>

<!------------  Buisness Fields Ends here----------------->


<!------------  Required resources  Fields Starts here----------------->
<div id="required_resources" class="resources hide">
<label for="required"><span class="required">required</span>Required resources </label>

<!------------- Skills Starts here ------------------->

<div id="skillsInput" class="form-group skills"><lable for="skills" class="withCheckbox">
<div id="skillscheck" data-toggle="modal" data-index="0" onclick="skillsPush(this.id)" data-target="#skill-section" class="custom-checkbox skills_check" >
<image src="assets/images/check.png" />
</div>skills</lable>
<a href="" data-toggle="modal" data-index="0" onclick="skillsPush(this.id)" data-target="#skill-section" id="skillscheck"><div class="required_for_purpose" id="InputSkillss"><input data-index="0"  type="text" class="form-control pointer required_for_purpose" id="InputSkills" name="skills[]" placeholder="Please select your skills" disabled>
</div>
</a>
</div>

<!------------- Skills Ends here ------------------->

<!------------- Funding Starts here ----------------->


<div id ="fundingInput" class="form-group"><lable for="funding" class="withCheckbox">
    <div  id="funding" data-toggle="modal" data-index="0" onclick="fundingPush(this.id)" data-target="#funding-section" class="custom-checkbox funding_check" ><image src="assets/images/check.png" /></div>Funding</lable><a href="" data-index="0" onclick="fundingPush(this.id)" data-toggle="modal" data-target="#funding-section" id="funding"><div id="Inputfundingss" class="required_for_purpose"><input type="text"  data-index="0" class="required_for_purpose pointer form-control" id="InputFunding" name="funding[]" placeholder="Please select funding" disabled></div>
    </a>
 </div>


<!--------------Funding Ends here --------------->

<!-------------- Alliances Starts here -------------->

<div id ="alliancesInput" class="form-group"><lable for="alliances" class="withCheckbox">
    <div data-toggle="modal" data-index="0" onclick="alliancePush(this.id)" data-target="#alliances-section" class="custom-checkbox alliances_check" ><image src="assets/images/check.png" /></div>Alliance</lable><a href="" data-toggle="modal" data-index="0" onclick="alliancePush(this.id)" data-target="#alliances-section" id="alliances"><div id="InputAlliancess"><input type="text" data-index="0" class="pointer form-control" id="InputAlliances" name="alliances[]" placeholder="Please select alliances" disabled></div>
</a>
</div>

<!-------------- Alliances ends here --------------->



</div>

<!------------  Required resources Ends here----------------->

<!--------------Strength starts here------------------->


<div id="strengthInput" class="form-group hide strength">
<label for="strength"><span class="optional">optional</span>Strength</label><div id="skill_wrapper"><input data-index="0" onchange="strengthPush(this.id)" type="text" class="form-control" id="strength" name="strength"></div></div>

<!--------------Strength ends here------------------->


<!--------------Supplement starts here------------------->


<div id="supplementInput" class="form-group hide supplement"><label for="supplement">
    <span class="optional">optional</span>Supplement</label><div id="skill_wrapper"> <input data-index="0" type="text" value="" class="form-control" onchange="supplementPush(this.id)"  id="supplement"></div></div>

<!--------------- Supplement Ends here ------------------>

<!--------------- Type of Investment   ----------------->


<div id ="InvestmentInput" class="form-group hide investment"><lable for="investment" class="withCheckbox">
    <div data-index="0" onclick="investmentPush(this.id)" id="investment" data-toggle="modal" data-target="#investment-section" class="custom-checkbox investment_check" >
        <image src="assets/images/check.png" /></div>Investment</lable>
        <a href="" data-index="0" onclick="investmentPush(this.id)" data-toggle="modal" data-target="#investment-section" id="investment">
            <div id="Inputinvestmentss"><input type="text" class="pointer form-control" data-index="0" id="InputInvestment" name="investment[]" placeholder="Please select investment" disabled>
    </div>
    </a>
 </div>



<!--------------- Type of Investment Ends here ------------->









</div>
</div>
<div class="add-btn-div">
    <a id="add_more" class="btn hide">Add Other Purpouse</a> 
</div>
           <div class="btn-next">
<button type="submit" id="step-3-register" class="btn btn-steps">Start</button>
             </div>             </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!------------ SKill model box ------------------->
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
     echo '<a class="cursor filter-button_skills" data-filter="skill_'.$skills['skill_id'].'"><li class="skill_li" >'.$skills['skill_name_english'].'</li></a>';
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
            <?php echo'<ul class="skills" id="skills_check">';
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
        <button type="button" class="btn cancle-skills clear-select" data-dismiss="modal">Cancle</button>
      </div>
    </div>
  </div>
</div>

<!------------ SKill model box Ends here ------------------->

<!------------------------ Funding modal box --------------------------------->


<div class="modal fade" id="funding-section" tabindex="-1" role="dialog" aria-labelledby="skill-section" aria-hidden="true">
    
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close skills" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-header">
        <h5 class="modal-title" id="skill-section">Funding<span>⚡</span></h5>
      </div>
      <div class="modal-body">
<div class="row skill-box">
     <div class="col-md-12">
         <h4 class="skill-head text-center">Select Fundings</h4>
         <div id="child-skills" class="overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-light" style="max-height: 246px; min-height: 246px;">
            <?php echo'<ul class="skills" id="funding_check">';
      foreach($funding_data as $funding){
                echo'<li class="funding_'.$funding['funding_id'].'"><input name="funding_ids" class="me-1" data-name="'.$funding['funding_name_english'].'" type="checkbox" value="'.$funding['funding_id'].'" aria-label="..."><span class="skill_name">'.$funding['funding_name_english'].'</span></li>';
                }
echo '</ul>'; ?>
      </div>
    </div>
</div>
      </div>
      <div class="modal-footer">
       <button type="button"  id="save-funding" class="btn save-skills">DONE</button>
       <br/>
        <button type="button" class="btn cancle-skills clear-select" data-dismiss="modal">Cancle</button>
      </div>
    </div>
  </div>
</div>

<!--------------------- Funding box ends here ------------------------------->

<!--------------------- Investment Modal Starts here ------------------------>

<div class="modal fade" id="investment-section" tabindex="-1" role="dialog" aria-labelledby="investment-section" aria-hidden="true">
    
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close skills" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-header">
        <h5 class="modal-title" id="skill-section">Investment<span>⚡</span></h5>
      </div>
      <div class="modal-body">
<div class="row skill-box">
     <div class="col-md-12">
         <h4 class="skill-head text-center">Select Investment</h4>
         <div id="child-skills" class="overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-light" style="max-height: 246px; min-height: 246px;">
            <?php echo'<ul class="skills" id="investment_check">';
      foreach($funding_data as $funding){
                echo'<li class="funding_'.$funding['funding_id'].'"><input name="investment_ids" class="me-1" data-name="'.$funding['funding_name_english'].'" type="checkbox" value="'.$funding['funding_id'].'" aria-label="..."><span class="skill_name">'.$funding['funding_name_english'].'</span></li>';
                }
echo '</ul>'; ?>
      </div>
    </div>
</div>
      </div>
      <div class="modal-footer">
       <button type="button"  id="save-investment" class="btn save-skills">DONE</button>
       <br/>
        <button type="button"  class="btn cancle-skills clear-select" data-dismiss="modal">Cancle</button>
      </div>
    </div>
  </div>
</div>


<!------------------- Investment Modal Ends here ----------------------------->

<!----- Industry Modal Box Starts Here ---------------->
<div class="modal fade" id="industry-section" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close skills" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-header">
        <h5 class="modal-title" id="skill-section">Industries<span>⚡</span></h5>
      </div>
      <div class="modal-body">
<div class="row skill-box">
    <div class="col-md-6">
        <h4 class="skill-head">1. Select category</h4>
      <div class="overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-light" style="max-height: 246px;">
          <ul class="skill_ul">
<?php foreach($industries_data as $industry) {
    if($industry[industry_parent_id]=='0'){
     echo '<a class="cursor filter-button_industry" data-filter="industry_'.$industry['industry_id'].'"><li class="skill_li" >'.$industry['industry_name_english'].'</li></a>';
    }
}
     ?>
    </ul>
      </div>
        </div>
    <div class="col-md-6">
         <h4 class="skill-head">2. Select Industries</h4>
         <div id="child-industry" class="overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-light" style="max-height: 246px; min-height: 246px;">
             <div id="onindustry-hide" class="flex-column cstm justify-content-center align-items-center" style="display:flex;">
            <h4 class="ssc">Select categories</h4> 
            </div>
    <?php echo'<ul class="skills" id="industry_check">';
      foreach($industries_data as $industry){
        if($industry['children']){
            $children=$industry['children'];
            foreach($children as $child){
                echo'<li class="filter industry_'.$industry['industry_id'].'"><input name="industry_ids" class="me-1" data-name="'.$child['industry_name_english'].'" type="checkbox" value="'.$child['industry_id'].'" aria-label="..."><span class="skill_name">'.$child['industry_name_english'].'</span></li>';
                if($child['children'])
                {
                    echo '<li><ul class="skills">';
                    $subchild=$child['children'];
                    foreach($subchild as $sub){
                       echo'<li class="filter skill_'.$industry['industryid'].'"><input name="industry_ids"  class="me-1" type="checkbox" data-name="'.$sub['industry_name_english'].'" value="'.$sub['industry_id'].'" aria-label="..."><span class="skill_name">'.$sub['industry_name_english'].'</span></li>'; 
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
       <button type="button"  id="save-industry" class="btn save-skills">DONE</button>
       <br/>
        <button type="button"  class="btn cancle-skills clear-select" data-dismiss="modal">Cancle</button>
      </div>
    </div>
  </div>
</div>
<!-------------------- Industry Modal Box ends here --------------------->

<!----- Alliances Modal Box Starts Here ---------------->
<div class="modal fade" id="alliances-section" tabindex="-1" role="dialog" aria-labelledby="skill-section" aria-hidden="true">
    
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close skills" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-header">
        <h5 class="modal-title" id="skill-section">Alliances<span>⚡</span></h5>
      </div>
      <div class="modal-body">
<div class="row skill-box">
    <div class="col-md-6">
        <h4 class="skill-head">1. Select category</h4>
      <div class="overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-light" style="max-height: 246px;">
          <ul class="skill_ul">
<?php foreach($industries_data as $industry) {
    if($industry[industry_parent_id]=='0'){
     echo '<a class="cursor filter-button_alliances" data-filter="alliances_'.$industry['industry_id'].'"><li class="skill_li" >'.$industry['industry_name_english'].'</li></a>';
    }
}
     ?>
    </ul>
      </div>
        </div>
    <div class="col-md-6">
         <h4 class="skill-head">2. Select Alliances</h4>
         <div id="child-industry" class="overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-light" style="max-height: 246px; min-height: 246px;">
             <div id="onalliances-hide" class="flex-column cstm justify-content-center align-items-center" style="display:flex;">
            <h4 class="ssc">Select categories</h4> 
            </div>
             <?php echo'<ul id="alliance_check" class="skills">';
      foreach($industries_data as $industry){
        if($industry['children']){
            $children=$industry['children'];
            foreach($children as $child){
                echo'<li class="filter alliances_'.$industry['industry_id'].'"><input name="alliances_ids" class="me-1" data-name="'.$child['industry_name_english'].'" type="checkbox" value="'.$child['industry_id'].'" aria-label="..."><span class="skill_name">'.$child['industry_name_english'].'</span></li>';
                if($child['children'])
                {
                    echo '<li><ul class="skills">';
                    $subchild=$child['children'];
                    foreach($subchild as $sub){
                       echo'<li class="filter allances'.$industry['industryid'].'"><input name="alliances_ids"  class="me-1" type="checkbox" data-name="'.$sub['industry_name_english'].'" value="'.$sub['industry_id'].'" aria-label="..."><span class="skill_name">'.$sub['industry_name_english'].'</span></li>'; 
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
       <button type="button" id="save-alliances" class="btn save-skills">DONE</button>
       <br/>
        <button type="button"  class="btn cancle-skills clear-select" data-dismiss="modal">Cancle</button>
      </div>
    </div>
  </div>
</div>
<script>

</script>
<!-------------------- Alliances Modal Box ends here --------------------->




<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/profile-steps.js"></script>
<script src="assets/js/button-color.js"></script>
<script src="assets/js/toast/jquery.toast.js"></script>
<script src="assets/js/custom/registration-step2.js"></script>
</body>
</html>