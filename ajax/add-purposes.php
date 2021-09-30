<?php
include_once '../web-api/config/db.php';
include_once '../web-api/config/core.php';
include_once '../web-api/objects/user.php';
include_once '../web-api/objects/details.php';

// instantiate database and user object

$database = new Database();
$db = $database->getConnection();
$details = new details($db);
$details->purpose_id=$_REQUEST['purpose_id'];
    
if($details->purpose==1)
{
echo'<ul class="skills">';
      foreach($skills_data as $skills){
        if($skills['children']){
            $children=$skills['children'];
            foreach($children as $child){
            if($child['skill_parent_id']==$details->skill_id){
                echo'<li><input name="skill_ids" class="me-1" onclick="saveInArray('.$child['skill_id'].')" type="checkbox" value="'.$child['skill_id'].'" aria-label="..."><span class="skill_name">'.$child['skill_name_english'].'</span></li>';
                if($child['children'])
                {
                    echo '<li><ul class="skills">';
                    $subchild=$child['children'];
                    foreach($subchild as $sub){
                       echo'<li><input name="skill_ids" onclick="saveInArray('.$sub['skill_id'].')" class="me-1" type="checkbox" value="'.$sub['skill_id'].'" aria-label="..."><span class="skill_name">'.$sub['skill_name_english'].'</span></li>'; 
                    }
                    echo '</ul></li>';
                }
                }
            
            }
        }
    }
echo '</ul>';
}