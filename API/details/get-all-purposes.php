<?php
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/details.php';
	
	use \Firebase\JWT\JWT;
	$data = json_decode(file_get_contents("php://input"));	
	
	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();
	
	// initialize object
	$details = new details($db);
    
    // Get All Purposes  
	$stmt=$details->getAllPurpose();
	$purpose_data=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
	//Get All Buisness Status
	$stmt=$details->getAllBuisnessStatus();
	$status_data=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
	//Get All Fundings
	$stmt=$details->getAllFunding();
	$funding_data=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
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
    
    
    //Get All Investments
    $stmt=$details->getAllInvestments();
	$investment_data=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
    
    
    $response["success"]=1;
    $response["purpose"]=$purpose_data;
    $response["status"]=$status_data;
    $response["funding"]=$funding_data;
    $response["industries"]=$industries_data;
    $response["alliances"]=$industries_data;
    $response["skills"]=$skills_data;
    $response["investment"]=$investment_data;
    echo json_encode($response);
	   
	
	
