<?php
session_start();
	// include database and object files
	include_once '../config/db.php';
	include_once '../config/core.php';
	include_once '../objects/user.php';
	include_once '../vendor/autoload.php';

   $data = json_decode(file_get_contents("php://input"));

	use \Firebase\JWT\JWT;
	// instantiate database and user object
	$database = new Database();
	$db = $database->getConnection();
 
 // initialize token object

 
	// initialize object
    $user = new User($db);
    
    $user->user_social_id=$_SESSION['social_id']; 
    $stmt=$user->getUserDatawithSocialID();
    $user_data=$stmt->fetch(PDO::FETCH_ASSOC);
    $user->user_id=$user_data['user_id'];
 	$num=0; 
 
        foreach($data->purpose as $value){
        $user->purpose_id=$value->purposeId;
        // Serialize Skills Array
        $user->skill_id=serialize($value->skillId);
        $user->funding_id=serialize($value->fundingId);
        $user->industry_id=serialize($value->industryId);
        $user->alliance_id=serialize($value->allianceId);
        $user->investment_id=serialize($value->investmentId);
        $user->business_plan=addslashes($value->businessPlan);
        $user->status=$value->status;
        $user->vision=$value->vision;
        $user->strength=$value->strength;
        $user->supplement=$value->supplement;
        if($user->saveUserPurpose())
        {
            $num++;
        }
        }
       if($num>0)
       {
           $response['success']=1;
           $response['message']='Profile created Successfully.';
       }
        else{
             $response['success']=0;
             $response['message']='Profile creation failed.';
        }
 
        echo json_encode($response);
?>
 