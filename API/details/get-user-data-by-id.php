<?php
// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/details.php';
	include_once '../objects/token.php';
	include_once '../vendor/autoload.php';
	
	use \Firebase\JWT\JWT;
	$data = json_decode(file_get_contents("php://input"));   
	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();
	
	
	// initialize object
	$details = new details($db);
	$bearer = new Token();
	$details->token =$bearer->getBearerToken();


    $details->user_id =trim($data->user_id);

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
    $childs = array();
    foreach($purpose_skills as &$item) $childs[$item['skill_parent_id']][] = &$item;
    unset($item);

    foreach($purpose_skills as &$item) if (isset($childs[$item['skill_id']]))
        $item['children'] = $childs[$item['skill_id']];
    unset($item);


    $skills_data = $childs;
    
    // echo json_encode($skills_data);
    $user_purposes[$i]["skills"]=$skills_data;
    unset($skills_data);
    unset($childs);
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
    
     $response["success"]=1;
     $response["message"]="User Proflie Data.";
     $response["User_profile_data"]=$user_profile_data;
     $response["User_purposes"]=$user_purposes;
     $response["user_settings"]=$user_settings;
     echo json_encode($response);
 
