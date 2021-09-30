<?php
include_once '../web-api/config/db.php';
include_once '../web-api/config/core.php';
include_once '../web-api/objects/user.php';
include_once '../web-api/objects/details.php';

// instantiate database and user object

$database = new Database();
$db = $database->getConnection();
$details = new details($db);
$details->industry_id=$_REQUEST['industry_id'];

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
    
echo'<ul class="skills">';
      foreach($industries_data as $industry){
        if($industry['children']){
            $children=$industry['children'];
            foreach($children as $child){
            if($child['industry_parent_id']==$details->industry_id){
                echo'<li><input name="skill_ids" id="checkAll" class="me-1" onclick="saveInArray('.$child['industry_id'].')" type="checkbox" value="'.$child['industry_id'].'" aria-label="..."><span class="skill_name">'.$child['industry_name_english'].'</span></li>';
                if($child['children'])
                {
                    echo '<li><ul class="skills">';
                    $subchild=$child['children'];
                    foreach($subchild as $sub){
                       echo'<li><input name="skill_ids" onclick="saveInArray('.$sub['industry_id'].')" class="me-1" type="checkbox" value="'.$sub['industry_id'].'" aria-label="..."><span class="skill_name">'.$sub['industry_name_english'].'</span></li>'; 
                    }
                    echo '</ul></li>';
                }
                }
            
            }
        }
    }
echo '</ul>';