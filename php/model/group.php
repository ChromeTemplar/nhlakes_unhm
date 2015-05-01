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
}
