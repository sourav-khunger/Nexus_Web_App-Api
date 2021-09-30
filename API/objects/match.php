<?php
class match
{

    // database connection and table name
    private $conn;
    private $table_match = "user_talk_later_match";
    private $table_chat = "chat";
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    
    public function doesChatAlreadyExist(){
         $query = "SELECT * FROM " . $this->table_chat . " WHERE chat_id='" . htmlspecialchars(strip_tags($this->match_id)). "'";
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
    
    public function doesSenderIdNotSame(){
         $query = "SELECT * FROM " . $this->table_match . " WHERE match_id='" . htmlspecialchars(strip_tags($this->match_id)) . "' AND sender_id!='".htmlspecialchars(strip_tags($this->sender_id))."'";
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
    
    public function doesMatchedIdExist(){
         $query = "SELECT * FROM " . $this->table_match . " WHERE match_id='" . htmlspecialchars(strip_tags($this->match_id)) . "'";
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
    
    
    
     public function createNewMatch(){
        $query = "INSERT INTO " . $this->table_match . " SET 
        match_id='" . htmlspecialchars(strip_tags($this->match_id)) . "', 
        sender_id='" . htmlspecialchars(strip_tags($this->sender_id)) . "', 
        receiver_id='" . htmlspecialchars(strip_tags($this->receiver_id)) . "', 
    	status='"  .$this->status . "'"; 
        $stmt = $this->conn->prepare($query);
       if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
      
    }
    
    public function completeMatch(){
        $query = "UPDATE " . $this->table_match . " SET 
        status='" . htmlspecialchars(strip_tags($this->status)) . "'
    	WHERE match_id='" . htmlspecialchars(strip_tags($this->match_id)) . "'";
        $stmt = $this->conn->prepare($query);
       if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
      
    }
    
    public function AddToChat(){
        $query = "INSERT INTO " . $this->table_chat . " SET 
        chat_id='" . htmlspecialchars(strip_tags($this->match_id)) . "', 
        created_by='" . htmlspecialchars(strip_tags($this->receiver_id)) . "', 
    	joined_user='" . htmlspecialchars(strip_tags($this->sender_id)) . "'";
    	$stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return true;
         } else {
            return false;
        }
    }
    
    
    
}
?>
