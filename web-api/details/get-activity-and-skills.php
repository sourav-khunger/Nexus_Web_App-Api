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
      
    // Get All Purpose Function  
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
    

	
    $response["success"]=1;
    $response["activity"]=$activity_data;
    $response["skills"]=$skills_data;
    echo json_encode($response);
	   
	
	
