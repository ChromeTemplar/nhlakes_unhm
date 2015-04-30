<?php

/**
File: Model: Report.php
Date: 4/27/2015
Author: Reporting Group 2015
Info: Contains database connection function and functions query the database to pull data from the summary table to be displayed on the report page.
**/

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

        /*** Creates connection to the Database ***/
       $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or $this->error('Could not connect to database. Make sure settings are correct.'); 
    } 
	
	// *** Functions below are queries for the Reporting Page for each section *** ///
	
	// Displays the totals for all States. Sums the summary entries to create totals by state.
    function allStates($table = '', $cols= '	boatRampID,
												SUM(NH) as NH, 
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

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now()) GROUP BY boatRampID"))) {
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

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now())"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }

	// Show totals for Previously Interacted and Never Interacted.
	function allPreviousInteractions($table = '', $cols= '	SUM(previous) as "Previously Interacted", 
												SUM(notPrevious) as "Never Interacted"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now())"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Drained and Not Drained.
	function allDrained($table = '', $cols= '	SUM(drained) as "Drained", 
												SUM(notDrained) as "Not Drained"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now())"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Rinsed and Not rinsed.
	function allRinsed($table = '', $cols= '	SUM(rinsed) as "Rinsed", 
												SUM(notRinsed) as "Not Rinsed"
												
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now())"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Dried and Not dried.
	function allDried($table = '', $cols= '	SUM(dry5) as "Dried", 
												SUM(notDry5) as "Not Dried"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now())"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Low Awareness, Medium Awareness, High Awareness.
	function allAwareness($table = '', $cols= '	SUM(awarenessLow) as "Low Awareness", 
												SUM(awarenessMedium) as "Medium Awareness", 
												SUM(awarenessHigh) as "High Awareness"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now())"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Species Found and Species Not Found.
	function allSpeciesFound($table = '', $cols= '	SUM(speciesFoundYes) as "Species Found", 
												SUM(speciesFoundNo) as "Species Not Found"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now())"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Sent to DES and Not Sent to DES.
	function allSpecimenSent($table = '', $cols= '	SUM(sentDesYes) as "Sent to DES", 
												SUM(sentDesNo) as "Not Sent to DES"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now())"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
    
}
