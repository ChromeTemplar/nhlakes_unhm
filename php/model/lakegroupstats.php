<?php

class LakeGroupStats extends Model
{
    /*** Set Class Attribute Variables ***/
    var $host = "localhost";
    var $user = "root";
    var $pass = '';
    var $db = "NHVBSR";

    /**
    * Constructor
    **/
    function __construct()
    {   
        /*** Set table name ***/
        if (empty($this->table)) {  
            $this->table = 'summary';
        }         

        /*** Create Connection to DB ***/
       $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or $this->error('Could not connect to database. Make sure settings are correct.'); 
    }
    
    function getSurveyTotalByGroup($lakeHostGroupID) 
    {
        $mysqli = $this->conn;
        
        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT COUNT(*) as surveyTotal FROM summary WHERE lakeHostGroupID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $lakeHostGroupID))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }      
        $result = $stmt->get_result();
        $total = $result->fetch_assoc();
        return $total['surveyTotal'];
    }
    
    function getSurveyTotalByUser($userID) 
    {
        $mysqli = $this->conn;
        
        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT COUNT(*) as surveyTotal FROM summary WHERE userID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $userID))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }      
        $result = $stmt->get_result();
        $total = $result->fetch_assoc();
        return $total['surveyTotal'];
    }
    
    function getSurveyTotal() 
    {
        $mysqli = $this->conn;
        
        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT COUNT(*) as surveyTotal FROM summary"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }      
        $result = $stmt->get_result();
        $total = $result->fetch_assoc();
        return $total['surveyTotal'];
    }
    
    function getlakeHostGroupName($username)
    {
    	$mysqli = $this->conn;
    	
    	if (!($stmt = $mysqli->prepare("SELECT lakehostgroup.lakeHostGroupName FROM lakehostgroup
        JOIN lakehostmember ON lakehostmember.lakeHostGroupID = lakehostgroup.ID
        JOIN user ON user.ID = lakehostmember.userID
        WHERE user.userName = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!($stmt->bind_param("s", $username))) {
        	echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }      
        $result = $stmt->get_result();
        $total = $result->fetch_assoc();
        return $total['lakeHostGroupName'];
    }

    
}
