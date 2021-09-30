<?php

    $details->user_id=$_SESSION['user_id'];
	//Get User Profile Info Data
	$stmt=$details->getAllRealTimeTalkUserId();
	$user_id=$stmt->fetchAll(PDO::FETCH_ASSOC);
	if(!empty($user_id))
   {
	foreach($user_id as $value){
	$details->user_id = $value[user_id];
	$stmt=$details->getUserProfileInfo();
    $user_profile_data=$stmt->fetch(PDO::FETCH_ASSOC);
	$skills_id=unserialize($user_profile_data[skills]);
   
    foreach($skills_id as $value)
    {
        $details->skill_id=$value;
        $skills[]=$details->getSkillByID();
    }
   $user_profile_data["skills"]=$skills;
   
   
   
   
   
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
     foreach($skill_id as $skill)
     {
        $details->skill_id=$skill;
        $purpose_skills[]=$details->getSkillByID();
          foreach($purpose_skills as $key=> $skills)
        {
             $details->skill_id=$skills["skill_parent_id"];
             $parent_name=$details->getSkillByID();
             $purpose_skills[$key]['parent_name_english']=$parent_name["skill_name_english"];
             $purpose_skills[$key]['parent_name_japanese']=$parent_name["skill_name_japanese"];
        }
     }
     $user_purposes[$i]["skills"]=$purpose_skills;
     unset($purpose_skills);
     
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
   $stmt=$details->getUserSettings();
   $user_settings=$stmt->fetch(PDO::FETCH_ASSOC);
  
    
   
   $alluser->user_profile_data=$user_profile_data;
   $alluser->User_purposes=$user_purposes;
   $alluser->user_settings=$user_settings;
   $realtime_users[]=$alluser;
   unset($alluser);
   unset($user_profile_data);
   unset($user_purposes);
   unset($user_settings);
}
   $response["success"]=1;
   $response["message"]="User Proflie Data.";
   $response["allusers"]=$realtime_users;
}

   //echo json_encode($response);

?>
 