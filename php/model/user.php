<?php

class user extends Model
{
    /*** Set Class Attribute Variables ***/
    var $host = "localhost";
    var $user = "root";
    var $pass = '';
    var $db = "NHVBSR";

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

        /*** Create Connection to DB ***/
       $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or $this->error('Could not connect to database. Make sure settings are correct.'); 
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
			firstName, 
			lastName, 
			phoneNumber, 
			userName, 
			email, 
			password, 
			over18,
			verified) 
			
			VALUES (?,?,?,?,?,?,SHA1(?),?,?)"))) {
			
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
		// Creates array of firstName & lastName
		$userNameArray = array($data['firstName'], $data['lastName']);
		// Combines firstName & lastName and adds a . in the middle
		$userName = implode(".",$userNameArray);
		//$userName is created as firstName.lastName
		
        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("issssssii",
		
			$data['roleID'],
			$data['firstName'],
			$data['lastName'],
			$data['phoneNumber'],
			$userName,
			$data['email'],
			$data['password'],
			$data['over18'],
			$data['verified']
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
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("UPDATE user SET 
				
				roleID = ?, 
				firstName = ?,
				lastName = ?, 
				phoneNumber = ?, 
				userName = ?, 
				email = ?, 
				password = ?, 
				over18 = ?, 
				verified = ? 
										WHERE ID = ?"))) {
										
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("issssssii",
		
				$data['roleID'],
				$data['firstName'],
				$data['lastName'],
				$data['phoneNumber'],
				$data['userName'],
				$data['email'],
				$data['password'],
				$data['over18'],
				$data['verified'],
				
								$this->id))) {
								
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }

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
