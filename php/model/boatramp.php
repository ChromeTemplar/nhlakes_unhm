<?php

class BoatRamp extends Model
{

    var $host = "localhost";
    var $user = "root";
    var $pass = '';
    var $db = "NHVBSR";

    function __construct($id ="")
    {   
        if (empty($this->table)) {  
            $this->table = get_class($this); 
        }         
         
        if (!empty($id)) { 
            $this->id = $id; 
        } 

       $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or $this->error('Could not connect to database. Make sure settings are correct.'); 

    }

    function addBoatRamp($data) {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("INSERT INTO BoatRamp (State, Name, waterbodyID, townID, Notes) VALUES (?,?,?,?,?)"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("ssiis", $data['State'], $data['Name'], $data['waterbodyID'], $data['townID'], $data['Notes']))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }

    function at_id() {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT * FROM BoatRamp WHERE BoatRampID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $this->id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        return $this->process($stmt);
    }


    function updateBoatRamp($data) {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("UPDATE BoatRamp SET State = ?, Name = ?, waterbodyID = ?, townID = ?, Notes = ? WHERE boatrampID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("ssiisi", $data['State'], $data['Name'], $data['waterbodyID'], $data['townID'], $data['Notes'], $this->id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }

    function deleteBoatRamp() {
        $mysqli = $this->conn;
        
        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("DELETE FROM BoatRamp WHERE boatrampID = ?"))) {
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

