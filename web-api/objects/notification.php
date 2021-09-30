<?php
	class Notification{
	 
		// database connection and table name
		private $conn;
	    private $table_user = "user_info";
        private $table_notification = "user_notifications";
       
       
       
      
		// constructor with $db as database connection
		public function __construct($db){
			$this->conn = $db;
		}
		
		public function getTime(){
		    
		    $query="SELECT TIMEDIFF('$this->time','$this->time1') as time";
		   $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
          }
		
		 public function saveNotification(){
        $query="INSERT INTO " . $this->table_notification . " SET 
    	sender_id='" . htmlspecialchars(strip_tags($this->sender_id)) . "',
    	reciever_id='" . htmlspecialchars(strip_tags($this->reciever_id)) . "',
    	read_status='" . htmlspecialchars(strip_tags($this->read_status)) . "',
         time='" . htmlspecialchars(strip_tags($this->time)) . "',
    	notifications='" . htmlspecialchars(strip_tags($this->notifications)) . "'";
    	$stmt = $this->conn->prepare($query);
    	if ($stmt->execute()) {
        return true;
        } else {
            return false;
        }
    
    }
    
    
     public function getNotification(){
        $query = "SELECT notification_id, sender_id, reciever_id, read_status, time
       , notifications FROM " . $this->table_notification . " WHERE reciever_id='" . htmlspecialchars(strip_tags($this->reciever_id)) ."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    
       }
       
       public function updateStatusNotification(){
       
        $query = "UPDATE " . $this->table_notification . " SET 
    	read_status='" . htmlspecialchars(strip_tags($this->read_status)) . "'
        WHERE notification_id='" . htmlspecialchars(strip_tags($this->notification_id)) . "'";
        $stmt = $this->conn->prepare($query);
       if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
      
   
  
       }
		
		
		
		
		
		
		
		
		
	}
		