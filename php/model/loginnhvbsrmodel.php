<?php

/**
 * This class is for extracting the person information from 
 * the database. 
 * @author sridhar
 *
 */
	
class loginNHVBSRmodel extends Model {
	
	var $username; 
	var $password;
	
	/*** Set Class Attribute Variables ***/
	var $host = "localhost";
	var $user = "root";
	var $pass = '';
	var $db = "NHVBSR";
	
	
	public function __construct() {
		
		/*** Create Connection to DB ***/
		$this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or $this->error('Could not connect to database. Make sure settings are correct.');
		
	}
	
	/***
	 * this method is used for extracting the user information
	 * from the person table with the user name and password 
	 * passed by the user. 
	 */
 	public function getPersonDetails($username, $password) {
 		$selectFromPerson = "SELECT ID, roleID, firstName, lastName, phoneNumber, userName, email, (SHA1(password)) AS password, over18, verified,  activeUser FROM user WHERE userName = ? and password = SHA1(?)";
 		
 		//the connection object created from the database 
 		// class is used to extract the user information from the table and
 		// returns the result object to the user 
		$statement = $this->conn->prepare($selectFromPerson);
		$statement->bind_param('ss',$username,$password);
		
                return $this->process($statement);
 	}
 	
 	/***
 	 * Inserts a record with session details in the  
 	 */
 	public function setSessionDetail($sessionId, $sessionKeyVal, $sessionStatus) {
 		
 		$insertIntoSession = "INSERT INTO sessionDetail VALUES (?, ?, ?)";
 		
 		$statement = $this->conn->prepare($insertIntoSession);
 		$statement->bind_param('sss',$sessionId, $sessionKeyVal, $sessionStatus);
 		$statement->execute();
 		
 	}
 	
 	/***
	 * check for the active session in the session table for continuing the next page  
 	 */
 	public function checkSessionDetails($sessionKeyVal, $sessionStatus) {
 		$selectActiveSession = "SELECT sessionId, sessionKeyVal, sessionStatus sessionDetail from sessionDetail where sessionKeyVal = ? and sessionStatus = ?";
 		
 		$statement = $this->conn->prepare($selectActiveSession);
 		$statement->bind_param('ss', $sessionKeyVal, $sessionStatus);
 		
                return $this->process($statement);
 	}
 	
 	/***
 	 *  The below code is to deactivate a session when the user logsoff of the system
 	 */
 	public function deactivateSession($sessionKeyVal, $sessionStatus) {
 		$deactivateActiveSession = "DELETE FROM sessionDetail WHERE sessionKeyVal = ? and sessionStatus = ?";
 		$statement = $this->conn->prepare($deactivateActiveSession); 
 		$statement->bind_param('ss', $sessionKeyVal, $sessionStatus);
 		$statement->execute();
 	}
 	
 	
}