<?php

class user extends Model
{
    /**
    * Constructor
    **/
    function __construct($id ="")
    {   
        /*** Set table name ***/
        if (empty($this->table)) {  
            $this->table = get_class($this); 
        }         
         
         /*** Set ID ***/
        if (!empty($id)) { 
            $this->id = $id; 
        } 

        /*** use parent model to connect to DB ***/
        parent::connectToDb();
    } 
    
    /**
     * Adds a new Person to the DB with the given $data
     *
     * @param Array $data : Array containing all of the $_POST data passed in by form
     *
     **/
    function adduser($data)
    {
        $mysqli = $this->conn;
        
        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("INSERT INTO user (
		
			roleID,
        	coordinatorID,	 
			firstName, 
			lastName, 
			phoneNumber, 
			userName, 
			email, 
			password, 
        	activeUser) 
			
			VALUES (?,?,?,?,?,?,?,SHA1(?),?)"))) {
			
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
		// Creates array of firstName & lastName
		$userNameArray = array($data['firstName'], $data['lastName']);
		// Combines firstName & lastName and adds a . in the middle
		$userName = implode(".",$userNameArray);
		//$userName is created as firstName.lastName
		
		// Creates array for phone number using areaCode, phoneBegin, phoneEnd
		$phoneNumberArray = array($data['areaCode'], $data['phoneBegin'], $data['phoneEnd']); 
		// Combines areaCode, phoneBegin, and phoneEnd and adds hyphens inbetween to produce a phone number
		$phoneNumber = implode("-",$phoneNumberArray);
		
		
		$activeUser = 1;
		
		
        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("isssssssi",
		
			$data['roleID'],
        	$data['coordinatorID'],	
			$data['firstName'],
			$data['lastName'],
			$phoneNumber,
			$userName,
			$data['email'],
			$data['password'],
			//$data['over18'],    Unecessary values
			//$data['verified'],  for the moment
        	$activeUser
									))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }


    /**
    * Selects a single item if ID is set 
    **/
    function at_id() 
    {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT * FROM user WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $this->id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        return $this->process($stmt);
    }


    /**
    * Updates a Person row in the DB
    *
    * @param Array $data : Array containing $_POST data passed in by the form
    **/
    function updateuser($data) 
    {
		$i = 0;
    	foreach($data as $value){
    		$i++;
    	}
        $mysqli = $this->conn;
        
        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("UPDATE user SET 
				
        		roleID = ?,
        		coordinatorID = CONCAT(coordinatorID, ',', ?), 
				firstName = ?,
				lastName = ?, 
				phoneNumber = ?,
				email = ?, 
				password = SHA1(?)
										WHERE ID = ?"))) {
										
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        // Creates array for phone number using areaCode, phoneBegin, phoneEnd
        $phoneNumberArray = array($data['areaCode'], $data['phoneBegin'], $data['phoneEnd']);
        // Combines areaCode, phoneBegin, and phoneEnd and adds hyphens inbetween to produce a phone number
        $phoneNumber = implode("-",$phoneNumberArray);        
        
        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("issssssi",
		
				$data['roleID'],
        		$data['coordinatorID'],
				$data['firstName'],
				$data['lastName'],
				$phoneNumber,
				$data['email'],
				$data['password'],
				//$data['over18'],		Unecessary values
				//$data['verified'],	for the moment
				
								$this->id))) {
								
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }
	
	function activateUser()
    {
    	$int = 1;
    	
     	$mysqli = $this->conn;
        
        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("UPDATE user SET 
        		activeUser = ?
        			WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        
        if (!($stmt->bind_param("ii", 
        		$int, 
        			$this-> id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }  
    
    }
	
    function deactivateUser()
    {
    	$int = 0;
    	 
    	$mysqli = $this->conn;
    
    	/* Prepared statement, stage 1: prepare */
    	if (!($stmt = $mysqli->prepare("UPDATE user SET 
    			activeUser = ?
    				WHERE ID = ?"))) {
    		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    	}
    
    	/* Prepared statement, stage 2: bind and execute */
    
    	if (!($stmt->bind_param("ii", 
    			$int, 
    				$this-> id))) {
    		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    	}
    
    	if (!$stmt->execute()) {
    		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    	}
    
    }
	
	
//////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////// DEPRICATED /////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
    /**
    * Deletes a User from the DB
    **/
    function deleteuser() 
    {
        $mysqli = $this->conn;
        
        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("DELETE FROM user WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $this->id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }  
    }

    
    
}
