<?php 
/**
 * Main Database class. Application Model extends this
 */

class Database 
{
    var $host = 'localhost'; 
    var $user = 'root'; 
    var $pass = ''; 
    var $db   = 'nhvbsr'; 
     
    var $conn;                    // Database connection 
    var $last_query;            // Results of last query 
    var $last_sql;                // String that contains last sql query 
     
    var $show_errors = true;    // Whether or not to show error messages 
     
    /** 
     * Constructor function 
     * Connects and selects database 
     * 
     * @param    string   MySQL Host 
     * @param    string   MySQL Username 
     * @param    string   MySQL Password 
     * @param    string   MySQL Database name 
     * @return   link     Connection link 
     */ 
    function database($host = '', $user = '', $pass = '', $db = '') { 
     
        $host = !empty($host) ? $host : $this->host; 
        $user = !empty($user) ? $user : $this->user; 
        $pass = !empty($pass) ? $pass : $this->pass; 
        $db   = !empty($db)   ? $db   : $this->db; 
     
        $this->conn = mysqli_connect($host, $user, $pass, $db) or $this->error('Could not connect to database. Make sure settings are correct.'); 
       
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        if (is_resource($this->conn)) { 
            mysqli_select_db($db, $this->conn) or $this->error("Database '$db' could not be found."); 
            return $this->conn; 
        } 
         
        return false; 
     
    } 
    
    public function getInstance() 
    {
        $return->conn;
    }
     
    /** 
     * Execute a query on the database 
     * 
     * @param    string   SQL query to execute 
     * @return   query    The query executed 
     */ 
    function query($sql) { 
     
        is_resource($this->conn) || $this->Database(); 
        $this->last_sql = $sql; 
        
        
        $result = $this->last_query = mysqli_query($this->conn, $sql);
        
        if ( false===$result ) {
            printf("SQL error: %s\n", mysqli_error($this->conn));
        }else {
            return $result;
        }
    } 
     
    /** 
     * Very simple select 
     * 
     * @param    string   Table name to select from 
     * @param    string   What to order by 
     * @param    string   Where statement 
     * @param    string   Columns to select 
     * @return   result   Result of query 
     */ 
    function select($table, $orderby = 'id DESC', $where = '', $cols = '*', $limit = '') { 
        $orderby = !empty($orderby) ? "ORDER BY $orderby" : ''; 
        $where = !empty($where) ? "WHERE $where" : ''; 
        $limit = !empty($limit) ? "LIMIT $limit" : ''; 
        
        return $this->query("SELECT $cols FROM $table $where $orderby $limit"); 
     
    } 
     
    /** 
     * Performs an insert query 
     * 
     * @param    string   Table name to query 
     * @param    array    Associative array of Column => Value to insert 
     * @return   result   Result of query 
     */ 
    function insert($table, $data) { 
     
        if (!is_array($data)) 
            return false; 
             
        //foreach ($data as $col => $value) 
            //$data[$col] = $this->escape($value); 
         
        $cols = array_keys($data); 
        $vals = array_values($data); 
         
        $this->query("INSERT INTO $table (".implode(",", $cols).") VALUES ('".implode("','", $vals)."')"); 
        return mysqli_insert_id($this->conn); 
     
    } 
     
    /** 
     * Updates a row 
     * 
     * @param    string   Table name to query 
     * @param    array    Associtive array of columns to update 
     * @param    string   Where clause 
     * @return   result   Result of query 
     */ 
    function update($table, $data, $where) { 
     
        if (!is_array($data)) 
            return false; 
             
        foreach ($data as $col => $value) { 
            $vals[] = $col.' = '.$this->escape($value); 
        } 
         
        return $this->query("UPDATE $table SET ".implode(',', $vals)." WHERE $where"); 
     
    } 
     
    /** 
     * Delete a single row 
     * 
     * @param    string   Table name to query 
     * @param    string   The column to match against 
     * @param    string   Value to match against column 
     * @return   result   Result of query 
     */ 
    function delete($table, $where) { 
     
        return $this->query("DELETE FROM $table WHERE $where"); 
     
    } 
     
    /** 
     * Get results of query 
     * 
     * @param    string   Return as object or array 
     * @return   result   Result of query 
     */ 
    function get($type = 'object') { 
     
        $type = $type == 'object' ? 'mysql_fetch_object' : 'mysql_fetch_array'; 
     
        if (is_resource($this->last_query)) { 
            while($rows = $type($this->last_query)) 
                $results[] = $rows; 
        }
        else $this->error(); 
         
        return (!empty($results)) ? $results : null; 
     
    } 
     
    /** 
     * Get first result of query 
     * 
     * @param    string   Return as object or array 
     * @return   result   Result of query 
     */ 
    function get_first($type = 'object') { 
     
        $type = $type == 'object' ? 'mysql_fetch_object' : 'mysql_fetch_array'; 
         
        if (is_resource($this->last_query))
        {
            $result = $type($this->last_query); 
            
            if ( false===$result ) {
                printf("error: %s\n", mysqli_error($this->conn));
            }else {
                return $result;
            }
        }
        
        
     
    } 
     
    /** 
     * Escape strings 
     * 
     * @param    mixed    String to escape 
     * @return   string   Escaped string, ready for SQL insertion 
     */ 
    function escape($data) { 
     
        switch(gettype($data)) { 
            case 'string': 
                $data = "'".mysqli_real_escape_string($this->conn, $data)."'"; 
                break; 
            case 'boolean': 
                $data = (int) $data; 
                break; 
            case 'double': 
                $data = sprintf('%F', $data); 
                break; 
            default: 
                $data = ($data === null) ? 'null' : $data; 
        } 
         
        return (string) $data; 
     
    } 
     
    /** 
     * Show simple error messages to help aid development process 
     * 
     * @param    string   Custom error message to show 
     * @return   death    Error page 
     */ 
    function error($msg = '') { 
     
        if ($this->show_errors === true) { 
            $error = '<h1>Error!</h1>'; 
             
            if (!empty($msg)) 
                $error .= "$msg<br />"; 
                 
            if (mysql_error()) 
                $error .= '<b>MySQL Error:</b> '.mysql_error().'<br />'; 
                 
            if (isset($this->last_sql)) 
                $error .= '<b>SQL Statement:</b> '.$this->last_sql; 
             
            die($error); 
        } 
     
    }
    
/**
 *This function creates an associative array of sql statements
 *that will all execute inorder to build the database
 *simply add a sql statement with a key and off you go!
 *
 * DING DONG YO!!! ***IF YOU USE FOREIGN KEYS*** THE REFERENCE
 * TABLE MUST BE CREATED AFTER THE TABLE IT IS REFERENCING
 * OR SQL WILL SCREAM!!! SO PUT IT IN THE CORRECT ORDER!
 */
function setupSQL(){	
	$sql1 = 
array(
"lakeHost" => "CREATE TABLE IF NOT EXISTS `lakehost` (
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `LakeHostStatus` varchar(20) NOT NULL,
  `DateTrained` datetime NOT NULL,
  `Trainer` varchar(20) NOT NULL,
  `TrainingManualStatus` tinyint(1) NOT NULL,
  `MinorContact` int(11) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `SummerContactID` int(11) NOT NULL,
  `WinterContactID` int(11) NOT NULL,
  `HourlyRate` decimal(10,2) NOT NULL,
  `MinorContactID` int(11) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"summerContact" => "CREATE TABLE IF NOT EXISTS `summercontact` (
  `id` int(11) NOT NULL auto_increment,
  `LakeHostID` int(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `PrimaryPhone` varchar(20) NOT NULL,
  `SecondaryPhone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `MailingAddressID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"accessSite" => "CREATE TABLE IF NOT EXISTS `accesssite` (
  `SiteName` varchar(75) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `State` char(2) NOT NULL,
  `Notes` varchar(1000) NOT NULL,
  `Waterbody` varchar(50) NOT NULL,
  `Ownership` varchar(20) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"emergencyContact" => "CREATE TABLE IF NOT EXISTS `emergencycontact` (
  `id` int(11) NOT NULL auto_increment, 
  `LakeHostID` int(11) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Relationship` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `PrimaryPhone` varchar(20) NOT NULL,
  `SecondaryPhone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"lakeHostGroup" => "CREATE TABLE IF NOT EXISTS `lakehostgroup` (
  `LakeHostGroupName` varchar(25) NOT NULL,
  `Notes` varchar(100) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"lakeHostMember" => "CREATE TABLE IF NOT EXISTS `lakehostmember` (
  `LakeHostID` int(11) NOT NULL,
  `LakeHostGroupID` int(11) NOT NULL,
  PRIMARY KEY (`LakeHostID`,`LakeHostGroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"mailingAddress" => "CREATE TABLE IF NOT EXISTS `mailingaddress` (
  `id` int(11) NOT NULL auto_increment,
  `Address1` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `SummerContactID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"minorInfo" => "CREATE TABLE IF NOT EXISTS `minorinfo` (
  `id` int(11) NOT NULL auto_increment,
  `LakeHostID` int(11) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Relationship` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `PrimaryPhone` varchar(20) NOT NULL,
  `SecondaryPhone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"survey" => "CREATE TABLE IF NOT EXISTS `survey` (
  `LakeHostID` int(11) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `InputDate` date NOT NULL,
  `InspectionTime` time NOT NULL,
  `SiteID` int(11) NOT NULL,
  `LaunchStatus` varchar(10) NOT NULL,
  `RegistrationState` char(2) NOT NULL,
  `BoatType` varchar(30) NOT NULL,
  `PreviousInteraction` tinyint(1) NOT NULL,
  `LastSiteVisited` varchar(20) NOT NULL,
  `LastTownVisited` varchar(20) NOT NULL,
  `LastStateVisited` char(2) NOT NULL,
  `Drained` tinyint(1) NOT NULL,
  `Rinsed` tinyint(1) NOT NULL,
  `DryForFiveDays` tinyint(1) NOT NULL,
  `BoaterAwareness` varchar(10) NOT NULL,
  `SpecimenFound` tinyint(1) NOT NULL,
  `BowNumber` int(11) NOT NULL,
  `SentToDES` tinyint(1) NOT NULL,
  `Notes` varchar(1000) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"user" => "CREATE TABLE IF NOT EXISTS `user` (
  `LakeHostID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `SiteID` int(11) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Username` char(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"winterContact" => "CREATE TABLE IF NOT EXISTS `wintercontact` (
  `LakeHostID` int(11) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `PrimaryPhone` varchar(20) NOT NULL,
  `SecondaryPhone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1"
);
//TODO: Change this to update existing tables and just add foreign key constraints.
// This is an ugly hack and it is memory consuming.........
$sql2 = 
array(
"lakeHost" => "CREATE TABLE IF NOT EXISTS `lakehost` (
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `LakeHostStatus` varchar(20) NOT NULL,
  `DateTrained` datetime NOT NULL,
  `Trainer` varchar(20) NOT NULL,
  `TrainingManualStatus` tinyint(1) NOT NULL,
  `MinorContact` int(11) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `SummerContactID` int(11) NOT NULL,
  `WinterContactID` int(11) NOT NULL,
  `HourlyRate` decimal(10,2) NOT NULL,
  `MinorContactID` int(11) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`SummerContactID`) REFERENCES summercontact(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"summerContact" => "CREATE TABLE IF NOT EXISTS `summercontact` (
  `id` int(11) NOT NULL auto_increment,
  `LakeHostID` int(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `PrimaryPhone` varchar(20) NOT NULL,
  `SecondaryPhone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `MailingAddressID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`LakeHostID`) REFERENCES lakehost(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"accessSite" => "CREATE TABLE IF NOT EXISTS `accesssite` (
  `SiteName` varchar(75) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `State` char(2) NOT NULL,
  `Notes` varchar(1000) NOT NULL,
  `Waterbody` varchar(50) NOT NULL,
  `Ownership` varchar(20) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"emergencyContact" => "CREATE TABLE IF NOT EXISTS `emergencycontact` (
  `id` int(11) NOT NULL, 
  `LakeHostID` int(11) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Relationship` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `PrimaryPhone` varchar(20) NOT NULL,
  `SecondaryPhone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`LakeHostID`) REFERENCES lakehost(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"lakeHostGroup" => "CREATE TABLE IF NOT EXISTS `lakehostgroup` (
  `LakeHostGroupName` varchar(25) NOT NULL,
  `Notes` varchar(100) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"lakeHostMember" => "CREATE TABLE IF NOT EXISTS `lakehostmember` (
  `LakeHostID` int(11) NOT NULL,
  `LakeHostGroupID` int(11) NOT NULL,
  PRIMARY KEY (`LakeHostID`,`LakeHostGroupID`),
  FOREIGN KEY (`LakeHostID`) REFERENCES lakehost(`id`),
  FOREIGN KEY (`LakeHostGroupID`) REFERENCES lakehostgroup(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"mailingAddress" => "CREATE TABLE IF NOT EXISTS `mailingaddress` (
  `id` int(11) NOT NULL,
  `Address1` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `SummerContactID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`SummerContactID`) REFERENCES summercontact(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"minorInfo" => "CREATE TABLE IF NOT EXISTS `minorinfo` (
  `id` int(11) NOT NULL,
  `LakeHostID` int(11) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Relationship` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `PrimaryPhone` varchar(20) NOT NULL,
  `SecondaryPhone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`LakeHostID`) REFERENCES lakehost(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"survey" => "CREATE TABLE IF NOT EXISTS `survey` (
  `LakeHostID` int(11) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `InputDate` date NOT NULL,
  `InspectionTime` time NOT NULL,
  `SiteID` int(11) NOT NULL,
  `LaunchStatus` varchar(10) NOT NULL,
  `RegistrationState` char(2) NOT NULL,
  `BoatType` varchar(30) NOT NULL,
  `PreviousInteraction` tinyint(1) NOT NULL,
  `LastSiteVisited` varchar(20) NOT NULL,
  `LastTownVisited` varchar(20) NOT NULL,
  `LastStateVisited` char(2) NOT NULL,
  `Drained` tinyint(1) NOT NULL,
  `Rinsed` tinyint(1) NOT NULL,
  `DryForFiveDays` tinyint(1) NOT NULL,
  `BoaterAwareness` varchar(10) NOT NULL,
  `SpecimenFound` tinyint(1) NOT NULL,
  `BowNumber` int(11) NOT NULL,
  `SentToDES` tinyint(1) NOT NULL,
  `Notes` varchar(1000) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`LakeHostID`) REFERENCES lakehost(`id`),
  FOREIGN KEY (`SiteID`) REFERENCES accesssite(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"user" => "CREATE TABLE IF NOT EXISTS `user` (
  `LakeHostID` int(11) NOT NULL,
  `SiteID` int(11) NOT NULL,
  'GroupID' int(11) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Username` char(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`LakeHostID`) REFERENCES lakehost(`id`),
  FOREIGN KEY (`SiteID`) REFERENCES accesssite(`id`),
  FOREIGN KEY ('GroupID') REFERENCES lakehostgroup('id')
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"winterContact" => "CREATE TABLE IF NOT EXISTS `wintercontact` (
  `LakeHostID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `PrimaryPhone` varchar(20) NOT NULL,
  `SecondaryPhone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`LakeHostID`) REFERENCES lakehost(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1"
);

$statements = [$sql1,$sql2];

return $statements;
}


// This function simply runs the queries
// Will print a success message for each query as well as any error messages
// Could be formatted better but I suck...
function makeDb(){
	// THIS SHOULD ONLY BE USED IN DEV ENVIRONMENT!!!!
	// NEEDS TO BE CHANGED WHEN USED TO UPDATE THE SERVER!!
	$con =  new mysqli("localhost","root","","nhvbsr");
        
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//Call our function to get the assoc array....
	$statements = $this->setupSQL();
	//I added this crappy noob workaround because I'm lazy and don't have time
        //to do it the right way...
        // The script was failing because it was trying to add foreign keys
        //before the reference table existed
        // so now we make all the tables, then go back and make them again with
        // all their relative foreign keys... Like I said its a terrible way.
	foreach($statements as $queries){
		//okay loop through... each value is a sql query so execute it...
		foreach($queries as $key => $val){
			$res = $con->query($val);
			
			// prep the statement for security....
			if($stmt = $con->prepare($val)){
			$stmt->execute();
			}
			//if it was no good print the error....
			if (!$res) {
				printf("<br /> Error at Key: $key: %s\n", $con->error);
			}
			// otherwise print a success msg....
			else
				echo "<br /> The table '$key' was successfully created! <br />";
		}
	}
	
}


}
