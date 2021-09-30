<?php
class Details
{
    // database connection and table name
    private $conn;
    private $table_purpose = "purpose_category";
    private $table_activity = "activity_area";
    private $table_industry = "industries";
    private $table_skills = "skills";
    private $table_buisness="buisness_status";
    private $table_funding="buisness_funding";
    private $table_investment="Investment";
    private $table_user="user_info";
    private $table_setting="user_notification_setting";
    private $table_user_purpose="user_purpose_of_use";

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
      public function getUserSettings()
    {
        $query = "SELECT * FROM ". $this->table_setting ." WHERE user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function getAllPurpose()
    {
        $query = "SELECT * FROM ". $this->table_purpose;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
     public function getUserProfileInfo()
    {
        $query = "SELECT * FROM ". $this->table_user ." WHERE user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function getAllUserId()
    {
        $query = "SELECT user_id FROM ". $this->table_user ." WHERE user_id!='" . htmlspecialchars(strip_tags($this->user_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    
    public function getAllTalkLaterUserId()
    {
        $query = "SELECT user_id FROM ". $this->table_user ." WHERE user_id!='" . htmlspecialchars(strip_tags($this->user_id)) . "' AND TIMEDIFF(CURRENT_TIMESTAMP,activity_time) > '00:02:00.000000'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
     public function getAllRealTimeTalkUserId()
    {
        $query = "SELECT user_id FROM ". $this->table_user ." WHERE user_id!='" . htmlspecialchars(strip_tags($this->user_id)) . "' AND realtime_talk='true' AND TIMEDIFF(CURRENT_TIMESTAMP,activity_time) < '00:02:00.000000'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    public function  getUserPurposes()
    {
        $query = "SELECT * FROM ". $this->table_user_purpose." WHERE user_id='" . htmlspecialchars(strip_tags($this->user_id)) . "'";;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    public function getPurposeById()
    {
        $query = "SELECT * FROM ". $this->table_purpose." WHERE purpose_id='" . htmlspecialchars(strip_tags($this->purpose_id)) . "'";;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data=$stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    
     public function getAllInvestments()
    {
        $query = "SELECT * FROM ". $this->table_investment;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
     public function getAllindustries()
     {
          $query = "SELECT * FROM ". $this->table_industry;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
     }
       public function getAllActivities()
    {
        $query = "SELECT * FROM ". $this->table_activity;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
     public function getAllSkills()
    {
        $query = "SELECT * FROM ". $this->table_skills;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
     public function getAllBuisnessStatus()
    {
        $query = "SELECT * FROM ". $this->table_buisness;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
      public function getAllFunding()
    {
        $query = "SELECT * FROM ". $this->table_funding;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
      public function getSkillByID()
    {
        $query ="SELECT s1.skill_id as skill_id, s1.skill_parent_id as skill_parent_id,  s1.skill_name_english as skill_name_english, s1.skill_name_japanese	 as skill_name_japanese	, s2.skill_name_japanese as Skill_parent_name_japanese,  s2.skill_name_english as Skill_parent_name_english from ". $this->table_skills ." s1 LEFT OUTER JOIN ". $this->table_skills ." s2 ON s1.skill_parent_id = s2.skill_id WHERE s1.skill_id='" . htmlspecialchars(strip_tags($this->skill_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data=$stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    
   public function  getFundingByID()
     {
        $query = "SELECT * FROM ". $this->table_funding ." WHERE funding_id='" . htmlspecialchars(strip_tags($this->funding_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data=$stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    
    public function  getIndustryByID()
     {
        $query ="SELECT i1.industry_id as industry_id, i1.industry_parent_id as industry_parent_id,  i1.industry_name_english as industry_name_english, i1.industry_name_japanese as industry_name_japanese	, i2.industry_name_japanese as industry_parent_name_japanese,  i2.industry_name_english as industry_parent_name_english from ". $this->table_industry ." i1 LEFT OUTER JOIN ". $this->table_industry ." i2 ON i1.industry_parent_id = i2.industry_id WHERE i1.industry_id='" . htmlspecialchars(strip_tags($this->industry_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data=$stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    
    public function  getInvestmentByID()
     {
        $query = "SELECT * FROM ". $this->table_investment ." WHERE investment_id='" . htmlspecialchars(strip_tags($this->investment_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data=$stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
public function getUserIDWithSocialID(){
    $query = "SELECT user_id FROM ". $this->table_user ." WHERE user_social_id='" . $this->user_social_id . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $id=$stmt->fetch(PDO::FETCH_ASSOC);
        return $id;
}
    
    
}
