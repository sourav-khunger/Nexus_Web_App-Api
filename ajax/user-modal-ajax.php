<?php
include_once 'connection.php';
$details->user_id =$_REQUEST['user_id'];

//$details->user_id ='11';

//Get User Profile Info Data
	
$stmt=$details->getUserProfileInfo();
$user_profile_data=$stmt->fetch(PDO::FETCH_ASSOC);
$skills_id=unserialize($user_profile_data[skills]);

foreach($skills_id as $value)
{
    $details->skill_id=$value;
    $skills[]=$details->getSkillByID();
}

$user_profile_data["skills"]=$skills;
$filterSkills=[];
$i=0;
$j=0;
$k=0;
foreach($skills as $skill)
{

    if(sizeof($filterSkills)=='0')
    {
    $i++;
    $j++;
    $filterSkills[$i]['main_parent']['skill_id']=$skill['skill_parent_id'];
    $filterSkills[$i]['main_parent']['skill_name_english']=$skill['Skill_parent_name_english'];
    $filterSkills[$i]['main_parent']['skill_name_japanese']=$skill['Skill_parent_name_japanese'];
    $filterSkills[$i]['main_parent']['children'][$j]['skill_id']=$skill['skill_id'];
    $filterSkills[$i]['main_parent']['children'][$j]['skill_name_english']=$skill['Skill_parent_name_english'];
    $filterSkills[$i]['main_parent']['children'][$j]['skill_name_japanese']=$skill['Skill_parent_name_japanese'];
    }
    else{
    if($filterSkills[$i]['main_parent']['skill_id']==$skill['skill_parent_id'])
    {
    $j++;
    $filterSkills[$i]['main_parent']['children'][$j]['skill_id']=$skill['skill_id'];
    $filterSkills[$i]['main_parent']['children'][$j]['skill_name_english']=$skill['Skill_parent_name_english'];
    $filterSkills[$i]['main_parent']['children'][$j]['skill_name_japanese']=$skill['Skill_parent_name_japanese'];
    }
    else if($filterSkills[$i]['main_parent']['children'][$j]['skill_id']==$skill['skill_parent_id'])
    {
    $k++;
    $filterSkills[$i]['main_parent']['children'][$j]['subchildren'][$k]['skill_id']=$skill['skill_id'];
    $filterSkills[$i]['main_parent']['children'][$j]['subchildren'][$k]['skill_name_english']=$skill['Skill_parent_name_english'];
    $filterSkills[$i]['main_parent']['children'][$j]['subchildren'][$k]['skill_name_japanese']=$skill['Skill_parent_name_japanese'];
    }
}
    
}

   // Get user_info Purposes
   
   $stmt=$details->getUserPurposes();
   $user_purposes=$stmt->fetchAll(PDO::FETCH_ASSOC);
   $i=0;
  foreach($user_purposes as $value)
  {
     $details->purpose_id=$value[purpose];
     $user_purposes[$i]["purpose"]=$details->getPurposeById();
     // Get Purpose Skills
     $skill_id=unserialize($value[skills]);
     sort($skill_id);
     foreach($skill_id as $skill)
     {
        $details->skill_id=$skill;
        $purpose_skills[]=$details->getSkillByID();
     }
$purposefilterSkills=[];
$l=0;
$j=0;
$k=0;
foreach($purpose_skills as $skill)
{

    if(sizeof($purposefilterSkills)=='0')
    {
    $l++;
    $j++;
    $purposefilterSkills[$l]['main_parent']['skill_id']=$skill['skill_parent_id'];
    $purposefilterSkills[$l]['main_parent']['skill_name_english']=$skill['Skill_parent_name_english'];
    $purposefilterSkills[$l]['main_parent']['skill_name_japanese']=$skill['Skill_parent_name_japanese'];
    $purposefilterSkills[$l]['main_parent']['children'][$j]['skill_id']=$skill['skill_id'];
    $purposefilterSkills[$l]['main_parent']['children'][$j]['skill_name_english']=$skill['Skill_parent_name_english'];
    $purposefilterSkills[$l]['main_parent']['children'][$j]['skill_name_japanese']=$skill['Skill_parent_name_japanese'];
    }
    else{
    if($purposefilterSkills[$l]['main_parent']['skill_id']==$skill['skill_parent_id'])
    {
    $j++;
    $purposefilterSkills[$l]['main_parent']['children'][$j]['skill_id']=$skill['skill_id'];
    $purposefilterSkills[$l]['main_parent']['children'][$j]['skill_name_english']=$skill['Skill_parent_name_english'];
    $purposefilterSkills[$l]['main_parent']['children'][$j]['skill_name_japanese']=$skill['Skill_parent_name_japanese'];
    }
    else if($purposefilterSkills[$l]['main_parent']['children'][$j]['skill_id']==$skill['skill_parent_id'])
    {
    $k++;
    $purposefilterSkills[$l]['main_parent']['children'][$j]['subchildren'][$k]['skill_id']=$skill['skill_id'];
    $purposefilterSkills[$l]['main_parent']['children'][$j]['subchildren'][$k]['skill_name_english']=$skill['Skill_parent_name_english'];
    $purposefilterSkills[$l]['main_parent']['children'][$j]['subchildren'][$k]['skill_name_japanese']=$skill['Skill_parent_name_japanese'];
    }
}
    
}
    $user_purposes[$i]["skills"]=$purposefilterSkills;
    unset($purpose_skills);
    unset($purposefilterSkills);
     
     // Get Purpose Funding
     
     $funding_id=unserialize($value[funding]);
     foreach($funding_id as $funding)
     {
        $details->funding_id=$funding;
        $purpose_funding[]=$details->getFundingByID();
     }
     $user_purposes[$i]["funding"]=$purpose_funding;
     unset($purpose_funding);
     
     // Get Purpose industry
     $industry_id=unserialize($value[industry]);
     foreach($industry_id as $industry)
     {
        $details->industry_id=$industry;
        $purpose_industry[]=$details->getIndustryByID();
     }
     $user_purposes[$i]["industry"]=$purpose_industry;
     unset($purpose_industry);
     
     // Get Purpose Investment
     
     $investment_id=unserialize($value[investment]);
     foreach($investment_id as $investment)
     {
        $details->investment_id=$investment;
        $purpose_investment[]=$details->getInvestmentByID();
     }
     $user_purposes[$i]["investment"]=$purpose_investment;
     unset($purpose_investment);

     // Get Purpose alliance
     
     $alliance_id=unserialize($value[alliance]);
     foreach($alliance_id as $alliance)
     {
        $details->industry_id=$alliance;
        $purpose_alliance[]=$details->getIndustryByID();
     }
     $user_purposes[$i]["alliance"]=$purpose_alliance;
     unset($purpose_alliance);
     
     $i++;
  }

  
    


//echo json_encode($user_purposes);








//print_r($filterSkills);






echo '<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
      <div class="popup-background-image">
       
          <img src="'.($user_profile_data[user_background_photo]!='' ? $user_profile_data[user_background_photo] : 'assets/images/user-modal/banner.png').'" class="background-image"><a href=""><img src="assets/images/icons/video-play.png"></a>
        <img src="'.($user_profile_data[user_profile_photo]!='' ? $user_profile_data[user_profile_photo] : 'assets/images/user.png').'"  class="profile-image"> 
        </div>
        <div class="header-content">
          <h6 class="user-name text-center">'.$user_profile_data[user_name].'</h6>
        
            <div class="social-icons">
          <a href="'.$user_profile_data[facebook].'" class="social-link"><img clas="social-icon" src="/assets/images/home/fb.png" /></a>
          <a href="'.$user_profile_data[twitter].'" class="social-link"><img clas="social-icon" src="/assets/images/home/twitter.png" /></a>
          <a href="'.$user_profile_data[instagram].'" class="social-link"><img clas="social-icon" src="/assets/images/home/insta.png" /></a>
          <a href="'.$user_profile_data[wantedly].'" class="social-link"><img clas="social-icon" src="/assets/images/sns/wantedly.png" /></a>
        <a href="'.$user_profile_data[linkdin].'" class="social-link"><img clas="social-icon" src="/assets/images/sns/link.png" /></a>
            <a href="'.$user_profile_data[github].'" class="social-link"><img clas="social-icon" src="/assets/images/sns/git.png" /></a>
             <a href="'.$user_profile_data[youtube].'" class="social-link"><img clas="social-icon" src="/assets/images/sns/yt.png" /></a>
    </div>
    <div id="activity"><h6 class="activity-area">'.$user_profile_data[user_activity_area].'</h6></div>
    <h6 class="work-status"><span id="occupation">'.$user_profile_data[occupation].'</span> / <span id="company_name">'.$user_profile_data[company_name].'</span></h6>
    </div>
</div>
<!----------- Modal Header ends Here ---------------------->

      <!-- Modal body -->
      
      <div class="modal-body popup-skills">
      <div class="modal-user-skills">';
  
for($i=1;$i<=sizeof($filterSkills); $i++){

echo '<div class="parent-skills-title">Skills:<span>'. $filterSkills[$i]['main_parent']['skill_name_english'].'</span></div>
           ';
for($j=1;$j<=sizeof($filterSkills[$i]['main_parent'][children]); $j++){            
echo '<div class="dark-box"><span>'.$filterSkills[$i]['main_parent']['children'][$j]['skill_name_english'].'</span></div>';
for($k=1; $k<=sizeof($filterSkills[$i]['main_parent'][children][$j][subchildren]); $k++){
echo '<div class="light-box"><span>'.$filterSkills[$i]['main_parent']['children'][$j]['subchildren'][$k]['skill_name_english'].'</span></div>';
}    
}            
}
echo   '</div><div class="job-history">
    <p class="title">Brief job history</p>
    <p class="content">'.$user_profile_data['job_history'].'</p>
    </div>

    <div class="popup-purposes"> 
          <div class="main-title">
              Purpose of Use
        </div>';
       // print_r($user_purposes);
      
        foreach($user_purposes as $purpose ){
    echo '<div class="purpose-content">
            <div class="titile"><h6 class="title">'.$purpose['purpose'][purpose_name_english].'</h6></div>
            <div class="popup-purpose-status">
                  <h6 class="required-sub-title">Status：<p class="strength-content">'.$purpose[status].'</p></h6>
                </div>
                
                <div class="popup-purpose-vision">
                  <h6 class="required-sub-title">Vision：<p class="strength-content">
                '.$purpose[vision].' </p></h6>
                </div>
                
            <div class="industry"><h6 class"industry"></h6></div>
            <div class="Required-resources">
                <h6 class="required-resources">Required resources：</h6>';
            foreach($purpose["skills"] as $skills){
               $parent=$skills['main_parent'];
              echo '<div class="popup-purpose-skills">';
              echo '<h6 class="required-title">Skills:'. $parent['skill_name_english'].'</h6>';
              echo '<div class="purpose-skills">
                    <div class="d-flex">
                    <div class="dark-box">';
                    foreach($parent['children'] as $children){
                     echo '<span>'.$children[skill_name_english].'</span>';
                
                        echo '</div>
                        
                    <div class="light-box">';
                    foreach($children[subchildren] as $sub){
                       echo '<span>'.$sub['skill_name_english'].'</span>';
                    }
                }
                  echo ' </div>
                </div>
                </div>
              </div>';
           }
              
                 echo '<div class"popup-purpose-funding">
                  <h6 class"required-title">Funding</h6>
                  <div class="light-box">';
                   if(sizeof($purpose[funding])==0){
                 echo '<span>Not Available</span>';
                      }
                      else { foreach($purpose[funding] as $funding){
                 echo '<span>'.$funding[funding_name].'</span>';
                      } }
                echo '</div>
                </div>
                
                <div class"popup-purpose-alliances">
                  <h6 class="required-title">Alliance</h6>
                  <div class="d-flex">';
                
                  echo '<div class="dark-box"><span>AdTech</span></div><div class="light-box"><span>Advertising</span></div>
                </div>
                </div>
                 <div class="popup-purpose-strength">
                  <h6 class="required-sub-title">What I have（Strength）:&nbsp;<p class="strength-content">'.$purpose[strength].'</p></h6>
                </div>
                <div class="popup-purpose-supplement">
                  <h6 class="required-sub-title">Supplement：<p class="strength-content">'.$purpose[supplement].'</p></h6>
                </div>';
                if($purpose[purpose][purpose_id]==6){
                echo '<div class="popup-purpose-investment">
                  <h6 class="required-title">Investment</h6>';
                  $investments=$purpose[investment];
                    foreach($investments as $investment){
                 echo '<div class="light-box"><span>VC</span><span>Angel</span></div>';
                    }
                echo '</div>';
                }
        echo '</div>';
   
   $i++;
    }
   echo  '</div>
      </div>
</div>
      <!-- Modal footer -->
      <div class="modal-footer">
          <button class="btn on" onclick=callUser('.$user_profile_data['user_id'].') >Talk Now</button><br/>
          <button class="btn hide-user" onclick=hideUser('.$user_profile_data['user_id'].') >hide</button><br/>
          
      </div>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
  
  </div>';
  
 