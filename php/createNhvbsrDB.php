
<?php

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
"LakeHosts" => "CREATE TABLE IF NOT EXISTS `LakeHosts` (
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
  `LakeHostID` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`LakeHostID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"SummerContacts" => "CREATE TABLE IF NOT EXISTS `SummerContacts` (
  `SummerContactID` int(11) NOT NULL,
  `LakeHostID` int(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `PrimaryPhone` varchar(20) NOT NULL,
  `SecondaryPhone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `MailingAddressID` int(11) NOT NULL,
  PRIMARY KEY (`SummerContactID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"AccessSites" => "CREATE TABLE IF NOT EXISTS `AccessSites` (
  `SiteName` varchar(75) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `State` char(2) NOT NULL,
  `Notes` varchar(1000) NOT NULL,
  `Waterbody` varchar(50) NOT NULL,
  `Ownership` varchar(20) NOT NULL,
  `SiteID` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`SiteID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"EmergencyContacts" => "CREATE TABLE IF NOT EXISTS `EmergencyContacts` (
  `ContactID` int(11) NOT NULL, 
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
  PRIMARY KEY (`ContactID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"LakeHostGroups" => "CREATE TABLE IF NOT EXISTS `LakeHostGroups` (
  `LakeHostGroupName` varchar(25) NOT NULL,
  `Notes` varchar(100) NOT NULL,
  `LakeHostGroupID` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`LakeHostGroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"LakeHostMembers" => "CREATE TABLE IF NOT EXISTS `LakeHostMembers` (
  `LakeHostID` int(11) NOT NULL,
  `LakeHostGroupID` int(11) NOT NULL,
  PRIMARY KEY (`LakeHostID`,`LakeHostGroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"MailingAddress" => "CREATE TABLE IF NOT EXISTS `MailingAddress` (
  `MailingAddressID` int(11) NOT NULL,
  `Address1` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `SummerContactID` int(11) NOT NULL,
  PRIMARY KEY (`MailingAddressID`),
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"MinorInfo" => "CREATE TABLE IF NOT EXISTS `MinorInfo` (
  `MinorContactID` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"Surveys" => "CREATE TABLE IF NOT EXISTS `Surveys` (
  `LakeHostID` int(11) NOT NULL,
  `SurveyID` int(11) NOT NULL auto_increment,
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
  PRIMARY KEY (`SurveyID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"Users" => "CREATE TABLE IF NOT EXISTS `Users` (
  `LakeHostID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `SiteID` int(11) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Username` char(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `UserID` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"WinterContacts" => "CREATE TABLE IF NOT EXISTS `WinterContacts` (
  `LakeHostID` int(11) NOT NULL,
  `WinterContactID` int(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `PrimaryPhone` varchar(20) NOT NULL,
  `SecondaryPhone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`WinterContactID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1"
);
//TODO: Change this to update existing tables and just add foreign key constraints.
// This is an ugly hack and it is memory consuming.........
$sql2 = 
array(
"LakeHosts" => "CREATE TABLE IF NOT EXISTS `LakeHosts` (
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
  `LakeHostID` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`LakeHostID`),
  FOREIGN KEY (`SummerContactID`) REFERENCES SummerContacts(`SummerContactID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"SummerContacts" => "CREATE TABLE IF NOT EXISTS `SummerContacts` (
  `SummerContactID` int(11) NOT NULL,
  `LakeHostID` int(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `PrimaryPhone` varchar(20) NOT NULL,
  `SecondaryPhone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `MailingAddressID` int(11) NOT NULL,
  PRIMARY KEY (`SummerContactID`),
  FOREIGN KEY (`LakeHostID`) REFERENCES LakeHosts(`LakeHostID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"AccessSites" => "CREATE TABLE IF NOT EXISTS `AccessSites` (
  `SiteName` varchar(75) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `State` char(2) NOT NULL,
  `Notes` varchar(1000) NOT NULL,
  `Waterbody` varchar(50) NOT NULL,
  `Ownership` varchar(20) NOT NULL,
  `SiteID` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`SiteID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"EmergencyContacts" => "CREATE TABLE IF NOT EXISTS `EmergencyContacts` (
  `ContactID` int(11) NOT NULL, 
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
  PRIMARY KEY (`ContactID`),
  FOREIGN KEY (`LakeHostID`) REFERENCES LakeHosts(`LakeHostID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"LakeHostGroups" => "CREATE TABLE IF NOT EXISTS `LakeHostGroups` (
  `LakeHostGroupName` varchar(25) NOT NULL,
  `Notes` varchar(100) NOT NULL,
  `LakeHostGroupID` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`LakeHostGroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"LakeHostMembers" => "CREATE TABLE IF NOT EXISTS `LakeHostMembers` (
  `LakeHostID` int(11) NOT NULL,
  `LakeHostGroupID` int(11) NOT NULL,
  PRIMARY KEY (`LakeHostID`,`LakeHostGroupID`),
  FOREIGN KEY (`LakeHostID`) REFERENCES LakeHosts(`LakeHostID`),
  FOREIGN KEY (`LakeHostGroupID`) REFERENCES LakeHostGroups(`LakeHostGroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"MailingAddress" => "CREATE TABLE IF NOT EXISTS `MailingAddress` (
  `MailingAddressID` int(11) NOT NULL,
  `Address1` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `SummerContactID` int(11) NOT NULL,
  PRIMARY KEY (`MailingAddressID`),
  FOREIGN KEY (`SummerContactID`) REFERENCES SummerContacts(`SummerContactID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"MinorInfo" => "CREATE TABLE IF NOT EXISTS `MinorInfo` (
  `MinorContactID` int(11) NOT NULL,
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
  PRIMARY KEY (`MinorContactID`),
  FOREIGN KEY (`LakeHostID`) REFERENCES LakeHosts(`LakeHostID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"Surveys" => "CREATE TABLE IF NOT EXISTS `Surveys` (
  `LakeHostID` int(11) NOT NULL,
  `SurveyID` int(11) NOT NULL auto_increment,
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
  PRIMARY KEY (`SurveyID`),
  FOREIGN KEY (`LakeHostID`) REFERENCES LakeHosts(`LakeHostID`),
  FOREIGN KEY (`SiteID`) REFERENCES AccessSites(`SiteID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"Users" => "CREATE TABLE IF NOT EXISTS `Users` (
  `LakeHostID` int(11) NOT NULL,
  `SiteID` int(11) NOT NULL,
  'GroupID' int(11) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Username` char(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `UserID` int(11) NOT NULL auto_increment,
  PRIMARY KEY (`UserID`),
  FOREIGN KEY (`LakeHostID`) REFERENCES LakeHosts(`LakeHostID`),
  FOREIGN KEY (`SiteID`) REFERENCES AccessSites(`SiteID`),
  FOREIGN KEY ('GroupID') REFERENCES LakeHostGroups('LakeHostGroupID')
) ENGINE=InnoDB DEFAULT CHARSET=latin1",
"WinterContacts" => "CREATE TABLE IF NOT EXISTS `WinterContacts` (
  `LakeHostID` int(11) NOT NULL,
  `WinterContactID` int(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `PrimaryPhone` varchar(20) NOT NULL,
  `SecondaryPhone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`WinterContactID`),
  FOREIGN KEY (`LakeHostID`) REFERENCES LakeHosts(`LakeHostID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1"
);

$statements = [$sql1, $sql2];

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
	$statements = setupSQL();
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
makeDb();

?>
