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

		
	///////////////////////////////////////////
	///////////////////////////////////////////
	// Section 1 - All Summaries //////////////
	///////////////////////////////////////////
	///////////////////////////////////////////
	
	
	// Displays the totals for all States. Sums the summary entries to create totals by state.
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

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now())"))) {
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
	
	
	
	///////////////////////////////////////////
	///////////////////////////////////////////
	// Section 2 - Group By Ramp //////////////
	///////////////////////////////////////////
	///////////////////////////////////////////
	
	
	
	function allStatesRamp($table = 'summary s, boatramp b', $cols= 'b.name as "Boat Ramp",
												SUM(s.NH) as NH, 
												SUM(s.ME) as ME,
												SUM(s.MA) as MA, 
												SUM(s.VT) as VT, 
												SUM(s.CT) as CT, 
												SUM(s.RI) as RI,
												SUM(s.NY) as NY,
												SUM(s.other) as Other
												') {
        $mysqli = $this->conn;
		
		
		
        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.boatRampID = b.ID AND YEAR(s.summaryDate) = YEAR(Now()) GROUP BY b.name"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Shows totals for all Boat Types
    function allBoatTypesRamp($table = 'summary s, boatramp b', $cols= 'b.name as "Boat Ramp",
												SUM(s.inboardOutboard) as "I/O", 
												SUM(s.pwc) as "PWC Jet",
												SUM(s.canoeKayak) as "Canoe/Kayak",
												SUM(s.sail) as "Sail Boat",
												SUM(s.otherBoatType) as "Other"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.boatRampID = b.ID AND YEAR(s.summaryDate) = YEAR(Now()) GROUP BY b.name"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }

	// Show totals for Previously Interacted and Never Interacted.
	function allPreviousInteractionsRamp($table = 'summary s, boatramp b', $cols= 'b.name as "Boat Ramp",
												SUM(s.previous) as "Previously Interacted", 
												SUM(s.notPrevious) as "Never Interacted"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.boatRampID = b.ID AND YEAR(s.summaryDate) = YEAR(Now()) GROUP BY b.name"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
       
        return $this->process($stmt);
    }
	
	// Displays totals for Drained and Not Drained.
	function allDrainedRamp($table = 'summary s, boatramp b', $cols= 'b.name as "Boat Ramp",
												SUM(s.drained) as "Drained", 
												SUM(s.notDrained) as "Not Drained"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.boatRampID = b.ID AND YEAR(s.summaryDate) = YEAR(Now()) GROUP BY b.name"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Rinsed and Not rinsed.
	function allRinsedRamp($table = 'summary s, boatramp b', $cols= 'b.name as "Boat Ramp",
												SUM(s.rinsed) as "Rinsed", 
												SUM(s.notRinsed) as "Not Rinsed"
												
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.boatRampID = b.ID AND YEAR(s.summaryDate) = YEAR(Now()) GROUP BY b.name"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Dried and Not dried.
	function allDriedRamp($table = 'summary s, boatramp b', $cols= 'b.name as "Boat Ramp",
												SUM(s.dry5) as "Dried", 
												SUM(s.notDry5) as "Not Dried"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.boatRampID = b.ID AND YEAR(s.summaryDate) = YEAR(Now()) GROUP BY b.name"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Low Awareness, Medium Awareness, High Awareness.
	function allAwarenessRamp($table = 'summary s, boatramp b', $cols= 'b.name as "Boat Ramp",
												SUM(s.awarenessLow) as "Low Awareness", 
												SUM(s.awarenessMedium) as "Medium Awareness", 
												SUM(s.awarenessHigh) as "High Awareness"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.boatRampID = b.ID AND YEAR(s.summaryDate) = YEAR(Now()) GROUP BY b.name"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Species Found and Species Not Found.
	function allSpeciesFoundRamp($table = 'summary s, boatramp b', $cols= 'b.name as "Boat Ramp",
												SUM(s.speciesFoundYes) as "Species Found", 
												SUM(s.speciesFoundNo) as "Species Not Found"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.boatRampID = b.ID AND YEAR(s.summaryDate) = YEAR(Now()) GROUP BY b.name"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Sent to DES and Not Sent to DES.
	function allSpecimenSentRamp($table = 'summary s, boatramp b', $cols= 'b.name as "Boat Ramp",
												SUM(s.sentDesYes) as "Sent to DES", 
												SUM(s.sentDesNo) as "Not Sent to DES"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.boatRampID = b.ID AND YEAR(s.summaryDate) = YEAR(Now()) GROUP BY b.name"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	
	
	///////////////////////////////////////////
	///////////////////////////////////////////
	// Section 3 - Group By Lake Host Group////
	///////////////////////////////////////////
	///////////////////////////////////////////
	
	
	
	
	
		// Displays the totals for all States. Sums the summary entries to create totals by state.
    function allStatesGroup($table = 'summary s, lakehostgroup l', $cols= 'l.lakeHostGroupName as "Group Name",
												SUM(s.NH) as NH, 
												SUM(s.ME) as ME,
												SUM(s.MA) as MA, 
												SUM(s.VT) as VT, 
												SUM(s.CT) as CT, 
												SUM(s.RI) as RI,
												SUM(s.NY) as NY,
												SUM(s.other) as Other
												') {
        $mysqli = $this->conn;
		
		
		
        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.lakeHostGroupID = l.ID
																   AND YEAR(s.summaryDate) = YEAR(Now()) 
																   GROUP BY l.lakeHostGroupName"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Shows totals for all Boat Types
    function allBoatTypesGroup($table = 'summary s, lakehostgroup l', $cols= 'l.lakeHostGroupName as "Group Name",	
												SUM(s.inboardOutboard) as "I/O", 
												SUM(s.pwc) as "PWC Jet",
												SUM(s.canoeKayak) as "Canoe/Kayak",
												SUM(s.sail) as "Sail Boat",
												SUM(s.otherBoatType) as "Other"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.lakeHostGroupID = l.ID
																   AND YEAR(s.summaryDate) = YEAR(Now()) 
																   GROUP BY l.lakeHostGroupName"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }

	// Show totals for Previously Interacted and Never Interacted.
	function allPreviousInteractionsGroup($table = 'summary s, lakehostgroup l', $cols= 'l.lakeHostGroupName as "Group Name",	
												SUM(s.previous) as "Previously Interacted", 
												SUM(s.notPrevious) as "Never Interacted"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.lakeHostGroupID = l.ID
																   AND YEAR(s.summaryDate) = YEAR(Now()) 
																   GROUP BY l.lakeHostGroupName"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Drained and Not Drained.
	function allDrainedGroup($table = 'summary s, lakehostgroup l', $cols= 'l.lakeHostGroupName as "Group Name",
												SUM(s.drained) as "Drained", 
												SUM(s.notDrained) as "Not Drained"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.lakeHostGroupID = l.ID
																   AND YEAR(s.summaryDate) = YEAR(Now()) 
																   GROUP BY l.lakeHostGroupName"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Rinsed and Not rinsed.
	function allRinsedGroup($table = 'summary s, lakehostgroup l', $cols= 'l.lakeHostGroupName as "Group Name",
												SUM(s.rinsed) as "Rinsed", 
												SUM(s.notRinsed) as "Not Rinsed"
												
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.lakeHostGroupID = l.ID
																   AND YEAR(s.summaryDate) = YEAR(Now()) 
																   GROUP BY l.lakeHostGroupName"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Dried and Not dried.
	function allDriedGroup($table = 'summary s, lakehostgroup l', $cols= 'l.lakeHostGroupName as "Group Name",
												SUM(s.dry5) as "Dried", 
												SUM(s.notDry5) as "Not Dried"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.lakeHostGroupID = l.ID
																   AND YEAR(s.summaryDate) = YEAR(Now()) 
																   GROUP BY l.lakeHostGroupName"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Low Awareness, Medium Awareness, High Awareness.
	function allAwarenessGroup($table = 'summary s, lakehostgroup l', $cols= 'l.lakeHostGroupName as "Group Name",
												SUM(s.awarenessLow) as "Low Awareness", 
												SUM(s.awarenessMedium) as "Medium Awareness", 
												SUM(s.awarenessHigh) as "High Awareness"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.lakeHostGroupID = l.ID
																   AND YEAR(s.summaryDate) = YEAR(Now()) 
																   GROUP BY l.lakeHostGroupName"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Species Found and Species Not Found.
	function allSpeciesFoundGroup($table = 'summary s, lakehostgroup l', $cols= 'l.lakeHostGroupName as "Group Name",	
												SUM(s.speciesFoundYes) as "Species Found", 
												SUM(s.speciesFoundNo) as "Species Not Found"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.lakeHostGroupID = l.ID
																   AND YEAR(s.summaryDate) = YEAR(Now()) 
																   GROUP BY l.lakeHostGroupName"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Sent to DES and Not Sent to DES.
	function allSpecimenSentGroup($table = 'summary s, lakehostgroup l', $cols= 'l.lakeHostGroupName as "Group Name",	
												SUM(s.sentDesYes) as "Sent to DES", 
												SUM(s.sentDesNo) as "Not Sent to DES"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE s.lakeHostGroupID = l.ID
																   AND YEAR(s.summaryDate) = YEAR(Now()) 
																   GROUP BY l.lakeHostGroupName"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	///////////////////////////////////////////
	///////////////////////////////////////////
	// Section 4 - All Summaries By Date///////
	///////////////////////////////////////////
	///////////////////////////////////////////
	
	
	// Displays the totals for all States. Sums the summary entries to create totals by state.
    function allDateStates($table = '', $cols= '	DATE_FORMAT(summaryDate,"%m/%d/%Y") as "Date", 
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
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now()) GROUP BY summaryDate"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Shows totals for all Boat Types
    function allDateBoatTypes($table = '', $cols= '	DATE_FORMAT(summaryDate,"%m/%d/%Y") as "Date", SUM(inboardOutboard) as "I/O", 
												SUM(pwc) as "PWC Jet",
												SUM(canoeKayak) as "Canoe/Kayak",
												SUM(sail) as "Sail Boat",
												SUM(otherBoatType) as "Other"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now()) GROUP BY summaryDate"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }

	// Show totals for Previously Interacted and Never Interacted.
	function allDatePreviousInteractions($table = '', $cols= '	DATE_FORMAT(summaryDate,"%m/%d/%Y") as "Date", SUM(previous) as "Previously Interacted", 
												SUM(notPrevious) as "Never Interacted"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now()) GROUP BY summaryDate"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Drained and Not Drained.
	function allDateDrained($table = '', $cols= '	DATE_FORMAT(summaryDate,"%m/%d/%Y") as "Date", SUM(drained) as "Drained", 
												SUM(notDrained) as "Not Drained"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now()) GROUP BY summaryDate"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Rinsed and Not rinsed.
	function allDateRinsed($table = '', $cols= '	DATE_FORMAT(summaryDate,"%m/%d/%Y") as "Date", SUM(rinsed) as "Rinsed", 
												SUM(notRinsed) as "Not Rinsed"
												
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now()) GROUP BY summaryDate"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Dried and Not dried.
	function allDateDried($table = '', $cols= '	DATE_FORMAT(summaryDate,"%m/%d/%Y") as "Date", SUM(dry5) as "Dried", 
												SUM(notDry5) as "Not Dried"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now()) GROUP BY summaryDate"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Low Awareness, Medium Awareness, High Awareness.
	function allDateAwareness($table = '', $cols= '	DATE_FORMAT(summaryDate,"%m/%d/%Y") as "Date", SUM(awarenessLow) as "Low Awareness", 
												SUM(awarenessMedium) as "Medium Awareness", 
												SUM(awarenessHigh) as "High Awareness"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now()) GROUP BY summaryDate"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Species Found and Species Not Found.
	function allDateSpeciesFound($table = '', $cols= '	DATE_FORMAT(summaryDate,"%m/%d/%Y") as "Date", SUM(speciesFoundYes) as "Species Found", 
												SUM(speciesFoundNo) as "Species Not Found"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now()) GROUP BY summaryDate"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Displays totals for Sent to DES and Not Sent to DES.
	function allDateSpecimenSent($table = '', $cols= 'DATE_FORMAT(summaryDate,"%m/%d/%Y") as "Date", SUM(sentDesYes) as "Sent to DES", 
												SUM(sentDesNo) as "Not Sent to DES"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare. Selects data from the summary table to be displayed on the report page. */ 
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table WHERE YEAR(summaryDate) = YEAR(Now()) GROUP BY summaryDate"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }

    
}
