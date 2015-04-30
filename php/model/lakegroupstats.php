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
    
    function getSurveyTotalByGroup($username) 
    {
        $mysqli = $this->conn;
        
        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT COUNT(*) as surveyTotal  FROM lakehostgroup
            JOIN summary ON summary.lakeHostGroupID = lakehostgroup.ID
            JOIN lakehostmember ON lakehostmember.lakeHostGroupID = lakehostgroup.ID
            JOIN user ON user.ID = lakehostmember.userID
            WHERE user.userName = ? AND (SummaryDate BETWEEN '2014-12-31' AND '2016-01-01');"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("s", $username))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }      
        $result = $stmt->get_result();
        $total = $result->fetch_assoc();
        return $total['surveyTotal'];
    }
	
    function getSurveyTotalByUser($currentUserID) 
    {
		//connect to mysqli
        $mysqli = $this->conn;
		
        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT COUNT(*) as surveyTotal FROM summary INNER JOIN User ON summary.userID = user.ID WHERE (user.userName = ?) AND (summaryDate BETWEEN '2014-12-31' AND '2016-01-01');"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("s", $currentUserID))) {
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
        if (!($stmt = $mysqli->prepare("SELECT COUNT(*) as surveyTotal FROM summary WHERE summaryDate BETWEEN '2014-12-31' AND '2016-01-01'"))) {
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

    
    //Function to get total number of surveys completed at a specified by ramp by boatRampID
    //Returns the number of surveys completed.
	function getSurveyTotalByBoatramp($boatRampID)
	{
		$mysqli = $this->conn;
        
        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT COUNT(*) as surveyTotal FROM Summary WHERE (boatRampID = ?) AND (SummaryDate BETWEEN '2014-12-31' AND '2016-01-01')"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
		
		/* Prepared statement, stage 2: bind and execute */ 
		if (!($stmt->bind_param("i", $boatRampID))) {
			echo "Binding paramaters failed: (" . $stmt->errno . ")" . $stmt->error;
		} 

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }      
        $result = $stmt->get_result();
        $total = $result->fetch_assoc();
        return $total['surveyTotal'];
	}
    
}
