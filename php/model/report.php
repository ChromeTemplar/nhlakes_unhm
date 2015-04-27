<?php

class report extends Model
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
            $this->table = "summary"; 
        }         

        /*** Create Connection to DB ***/
       $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or $this->error('Could not connect to database. Make sure settings are correct.'); 
    } 
	
	// *** Functions below are all queries for the Reporting Page for each section *** ///
	
	// Shows totals for all States
    function allStates($table = '', $cols= '	SUM(NH) as NH,
												SUM(ME) as ME,
												SUM(MA) as MA, 
												SUM(VT) as VT, 
												SUM(CT) as CT, 
												SUM(RI) as RI,
												SUM(NY) as NY,
												SUM(other) as Other
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Shows totals for all Boat Types
    function allBoatTypes($table = '', $cols= '	SUM(inboardOutboard) as "I/O", 
												SUM(pwc) as "PWC Jet",
												SUM(canoeKayak) as "Canoe/Kayak",
												SUM(sail) as "Sail Boat",
												SUM(otherBoatType) as "Other"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }

	function allPreviousInteractions($table = '', $cols= '	SUM(previous) as "Previously Interacted", 
												SUM(notPrevious) as "Never Interacted"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	function allDrained($table = '', $cols= '	SUM(drained) as "Drained", 
												SUM(notDrained) as "Not Drained"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }

	function allRinsed($table = '', $cols= '	SUM(rinsed) as "Rinsed", 
												SUM(notRinsed) as "Not Rinsed"
												
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	function allDried($table = '', $cols= '	SUM(dry5) as "Dried", 
												SUM(notDry5) as "Not Dried"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	function allAwareness($table = '', $cols= '	SUM(awarenessLow) as "Low Awareness", 
												SUM(awarenessMedium) as "Medium Awareness", 
												SUM(awarenessHigh) as "High Awareness"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	function allSpeciesFound($table = '', $cols= '	SUM(speciesFoundYes) as "Species Found", 
												SUM(speciesFoundNo) as "Species Not Found"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	function allSpecimenSent($table = '', $cols= '	SUM(sentDesYes) as "Sent to DES", 
												SUM(sentDesNo) as "Not Sent to DES"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// *** Functions above are all queries for the Reporting Page ***///
    
}
