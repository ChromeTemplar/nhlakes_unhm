<?php

class LakeGroupStats extends Model
{
    /**
    * Constructor
    **/
    function __construct()
    {   
        /*** Set table name ***/
        if (empty($this->table)) {  
            $this->table = 'Summary';
        }         

       /*** use parent model to connect to DB ***/
        parent::connectToDb();
    }
    
    function getSurveyTotalByGroup($Username) 
    {
        $mysqli = $this->conn;
        
        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT COUNT(*) as surveyTotal  FROM LakeHostGroup
            JOIN Summary ON Summary.lakeHostGroupID = LakeHostGroup.ID
            JOIN LakeHostMember ON LakeHostMember.lakeHostGroupID = LakeHostGroup.ID
            JOIN User ON User.ID = LakeHostMember.UserID
            WHERE User.UserName = ? AND (SummaryDate BETWEEN '2014-12-31' AND '2016-01-01');"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("s", $Username))) {
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
        if (!($stmt = $mysqli->prepare("SELECT COUNT(*) as surveyTotal FROM Summary INNER JOIN User ON Summary.UserID = User.ID WHERE (User.UserName = ?) AND (SummaryDate BETWEEN '2014-12-31' AND '2016-01-01');"))) {
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

    function getUser($currentUserID)
    {
    	//connect to mysqli
    	$mysqli = $this->conn;
    
    	/* Prepared statement, stage 1: prepare */
    	if (!($stmt = $mysqli->prepare("SELECT ID as surveyTotal from User  WHERE (User.UserName = ?);"))) {
    		
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
        if (!($stmt = $mysqli->prepare("SELECT COUNT(*) as surveyTotal FROM Summary WHERE SummaryDate BETWEEN '2014-12-31' AND '2016-01-01'"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }      
        $result = $stmt->get_result();
        $total = $result->fetch_assoc();
        return $total['surveyTotal'];
    }
    
    function getlakeHostGroupName($Username)
    {
    	$mysqli = $this->conn;
    	
    	if (!($stmt = $mysqli->prepare("SELECT LakeHostGroup.lakeHostGroupName FROM LakeHostGroup
        JOIN LakeHostMember ON LakeHostMember.lakeHostGroupID = LakeHostGroup.ID
        JOIN User ON User.ID = LakeHostMember.UserID
        WHERE User.UserName = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!($stmt->bind_param("s", $Username))) {
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
