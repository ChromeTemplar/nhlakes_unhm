<?php

class group extends Model
{
    /**
    * Constructor
    **/
    function __construct($id ="")
    {   
        /*** Set table name ***/
        if (empty($this->table)) {  
            $this->table = 'LakeHostGroup'; 
        }         
         
         /*** Set ID ***/
        if (!empty($id)) { 
            $this->id = $id; 
        } 

        /*** use parent model to connect to DB ***/
        parent::connectToDb();
    } 

    function addgroup($data)
    {
    	$mysqli = $this->conn;
    
    	if (empty($table))
    		$table = $this->table;
    
    	/* Prepared statement, stage 1: prepare */
    	if (!($stmt = $mysqli->prepare("INSERT INTO LakeHostGroup (lakeHostGroupName, notes) VALUES (?,?)"))) {
    			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    	}
    	    
    	/* Prepared statement, stage 2: bind and execute */
    	if (!($stmt->bind_param("ss", $data['lakeHostGroupName'], $data['notes']))) {
    		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    	}
    	
    	if (!$stmt->execute()) {
    		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    	}
    }
    
    //fills a drop down menu, see Group index for usage example
    function dropDownto($table, $field, $iD, $dropDownID) {
    	$queryArray = array();
    	$html ="";
    	//$mysqli = $this->conn;
    	//$mysqli = Util::connect();
    	$mysqli = $this->conn;
    	$query = "SELECT ".$iD.",".$field." FROM ".$table." ORDER BY ".$field." ASC";
    	$stmt = $mysqli->query($query);
    	if ($stmt->num_rows > 0) {
    		while($row = $stmt->fetch_assoc()) {
    			$queryArrayID = $row[$iD];
    			$queryArrayField = $row[$field];
    			$queryArray[$queryArrayID] = $queryArrayField;
    		}
    	}
    	$html .= "<select id= $dropDownID required>";
    	foreach($queryArray as $key => $value) {
    		$html .= "<option value=$key>$value</option>\n";
    	}
    	return $html;
    }
}
