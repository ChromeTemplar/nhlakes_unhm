<?php

class BoatRamp extends Model
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
        
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or $this->error('Could not connect to database. Make sure settings are correct.');
    }


    /**
    * Adds a new Boat Ramp to the DB with the given $data
    *
    * @param Array $data : Array containing all of the $_POST data passed in by form
    *
    **/
    function addBoatRamp($data)
    {
        $mysqli = $this->conn;
        
        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("INSERT INTO BoatRamp (state, name, waterbodyID, townID, notes) VALUES (?,?,?,?,?)"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("ssiis", $data['state'], $data['name'], $data['waterbodyID'], $data['townID'], $data['notes']))) {
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
        if (!($stmt = $mysqli->prepare("SELECT * FROM BoatRamp WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $this->id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        return $this->process($stmt);
    }


    /**
    * Updates a Boatramp row in the DB
    *
    * @param Array $data : Array containing $_POST data passed in by the form
    **/
    function updateBoatRamp($data) 
    {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("UPDATE BoatRamp SET state = ?, name = ?, waterbodyID = ?, townID = ?, notes = ? WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("ssiisi", $data['state'], $data['name'], $data['waterbodyID'], $data['townID'], $data['notes'], $this->id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }

    /**
    * Deletes a Boat Ramp from the DB
    **/
    function deleteBoatRamp() 
    {
        $mysqli = $this->conn;
        
        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("DELETE FROM BoatRamp WHERE ID = ?"))) {
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

