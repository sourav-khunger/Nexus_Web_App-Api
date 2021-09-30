<?php
class chat
{

    // database connection and table name
    private $conn;
    private $table_chat = "chat";

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    
    public function doesChatBoxExist()
    {

        $query = "SELECT * FROM " . $this->table_chat . " WHERE chat_id='" . htmlspecialchars(strip_tags($this->chat_id)) . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num > 0) {
            return true;
        } else {
            //print_r($stmt->errorInfo());
        }
        return false;
    }
    
     public function addNewChat(){
        $ok=true;
        if($this->doesChatBoxExist())
        {
             $ok=false;
             $error="Chat Already Exist.";
        }
        if($ok){
        $query="INSERT INTO " . $this->table_chat . " SET 
        chat_id='" . htmlspecialchars(strip_tags($this->chat_id)) . "',
    	created_by='" . htmlspecialchars(strip_tags($this->created_by)) . "',
    	joined_user='" .  htmlspecialchars(strip_tags($this->joined_user)) .  "'";
    	$stmt = $this->conn->prepare($query);
    	
    	if ($stmt->execute()) {
        return true;
        } else {
        return false;
        }
        }
    }
    
    public function getAllChatMembersByChatID(){
        
        $query="SELECT *  from " . $this->table_chat . " WHERE created_by='" . htmlspecialchars(strip_tags($this->user_id)) . "' OR joined_user='" . htmlspecialchars(strip_tags($this->user_id)) . "'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    
}
