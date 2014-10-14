<?php

class db1 {

	private $mysqli;
	
	function __construct(){
	
		$mysqli = new mysqli("localhost", "colby", "commoncolby", "nhvbsr");
		
		if (mysqli_connect_errno()) {
		  printf("Connection failed: %s<br />", mysqli_connect_error());
		  exit();
		}
	}
	function getSurvey($survey_id) {
	
		//return survey data 		
		
		 $stmt = $this->mysqli->prepare("select * from boaterSurvey where surveyID=?");
		 
		 if (!$stmt) {
			printf("prepare( ) failed: (%s) %s", $this->mysqli->errno, $this->mysqli->error);
		} else {
			//$nickName = "UNH";
			$stmt->bind_param("i",$survey_id);
			$stmt->execute( );
			//$stmt->bind_param("UNH");
			
			$surveyResult = array();
			
			$stmt->bind_result($surveyID, $lakeHostID, $inputDate, $inputTime, $launchStatus, $registrationState,
			$boatType, $previousInteraction, $lastSiteVisited, $lastTownVisited, $lastStateVisited, $drained, $rinsed,
			$dryForFiveDays, $boaterAwareness, $sentToDES, $bowNumber);

			$stmt->fetch();
			$surveyResult = array('surveyID'=>"$surveyID",'lakeHostID'=>"$lakeHostID",'inputDate'=>"$inputDate",'inputTime'=>"$inputTime",'launchStatus'=>"$launchStatus",
			'registrationState'=>"$registrationState",'boatType'=>"$boatType",'previousInteraction'=>"$previousInteraction",'lastSiteVisited'=>"$lastSiteVisited",
			'lastTownVisited'=>"$lastTownVisited",'lastStateVisited'=>"$lastStateVisited",'drained'=>"$drained",'rinsed'=>"$rinsed",'dryForFiveDays'=>"$dryForFiveDays",
			'boaterAwareness'=>"$boaterAwareness",'sentToDES'=>"$sentToDES",'bowNumber'=>"$bowNumber");

			 /* close statement */
			$stmt->close( );
		}

		return $surveyResult;
	
	}

	public function getGroupSurveys($user_id) {
	//This function checks the database for surveys conducted by this specific user.
	
	$LakeHosts = array();
	
	
	$mysqli = new mysqli("localhost", "colby", "commoncolby", "nhvbsr");
	$surveyResult = array('surveyID'=>array(),'inputTime'=>array(),'launchStatus'=>array(),'registrationState'=>array(),'boatType'=>array());
		
		if (mysqli_connect_errno()) {
		   printf("Connection failed: %s<br />", mysqli_connect_error());
		   exit();
		}
		
		$stmt = $mysqli->prepare("select GroupID from Users where UserID=?");
		 
		 if (!$stmt) {
			printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
		} else {
			//$nickName = "UNH";
			$stmt->bind_param("i", $user_id);
			$stmt->execute( );
			//$stmt->bind_param("UNH");
			
			$stmt->bind_result($GroupID);

			$stmt->fetch();
			 /* close statement */
			$stmt->close( );
		}
		
		
		$stmt = $mysqli->prepare("select lakeHostID from LakeHostMembers where LakeHostGroupID=?");
		 
		 if (!$stmt) {
			printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
		} else {
			//$nickName = "UNH";
			$stmt->bind_param("i", $GroupID);
			$stmt->execute( );
			//$stmt->bind_param("UNH");
			
			$stmt->bind_result($LakeHostID);

			while ($stmt->fetch()) {
				$LakeHosts[] = $LakeHostID;
			}
			 /* close statement */
			$stmt->close( );
		}
		
		$today = getdate();
		$year = $today['year'];
		$day = $today['mday'];
		$month = $today['mon'];
		$date = "$year"."-"."$month"."-"."$day";
 
		//$date = "2013-01-03";
		$numberOfLakeHosts = count($LakeHosts);
		
		
		for ($i = 1; $i<$numberOfLakeHosts; $i++ ) {
		$LakeHostID = $LakeHosts[$i-1];
		$stmt = $mysqli->prepare("select SurveyID,InspectionTime,LaunchStatus,RegistrationState,BoatType from Surveys where LakeHostID=? and InputDate=CURDATE()");
		 
		 if (!$stmt) {
			printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
		} else {
			//$nickName = "UNH";
			$stmt->bind_param("i", $LakeHostID);
			$stmt->execute( );
			//$stmt->bind_param("UNH");
			
			$stmt->bind_result($surveyID,$inputTime, $launchStatus, $registrationState,$boatType);

			while ($stmt->fetch()) {

			array_push($surveyResult['surveyID'],$surveyID);
			array_push($surveyResult['inputTime'],$inputTime);
			array_push($surveyResult['launchStatus'],$launchStatus);
			array_push($surveyResult['registrationState'],$registrationState);
			array_push($surveyResult['boatType'],$boatType);
			
			}
			 /* close statement */
			$stmt->close( );
		}
		}
		return $surveyResult;
	
	}
	
	public function getSiteName($site_id) {
		$mysqli = new mysqli("localhost", "colby", "commoncolby", "nhvbsr");
				
		if (mysqli_connect_errno()) {
		   printf("Connection failed: %s<br />", mysqli_connect_error());
		   exit();
		}
		
		$stmt = $mysqli->prepare("select SiteName from AccessSites where SiteID=?");
		 
		 if (!$stmt) {
			printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
		} else {
			//$nickName = "UNH";
			$stmt->bind_param("i", $site_id);
			$stmt->execute( );
			//$stmt->bind_param("UNH");
			
			$stmt->bind_result($SiteName);

			$stmt->fetch();
			 /* close statement */
			$stmt->close( );
		}
		return $SiteName;
	}
	
	public function getAccessSites() {
		$accessSites = array('SiteID'=>array(),'SiteName'=>array());
		$mysqli = new mysqli("localhost", "colby", "commoncolby", "nhvbsr");
				
		if (mysqli_connect_errno()) {
		   printf("Connection failed: %s<br />", mysqli_connect_error());
		   exit();
		}
		
		$stmt = $mysqli->prepare("select * from AccessSites");
		 
		 if (!$stmt) {
			printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
		} else {
			//$nickName = "UNH";
			$stmt->execute( );
			//$stmt->bind_param("UNH");
			
			$stmt->bind_result($SiteID,$SiteName);

			while($stmt->fetch()) {
			array_push($accessSites['SiteID'],$SiteID);
			array_push($accessSites['SiteName'],$SiteName);
			
			};
			 /* close statement */
			$stmt->close( );
		}
		return $accessSites;
	}
	
	public function getSiteSurveys($site_id) {
		$mysqli = new mysqli("localhost", "colby", "commoncolby", "nhvbsr");
		$surveyResult = array('surveyID'=>array(),'inputDate'=>array(),'launchStatus'=>array(),'registrationState'=>array(),'boatType'=>array());
		
		if (mysqli_connect_errno()) {
		   printf("Connection failed: %s<br />", mysqli_connect_error());
		   exit();
		}
		
		$stmt = $mysqli->prepare("select SurveyID,InputDate,LaunchStatus,RegistrationState,BoatType from Surveys where SiteID=? order by InputDate DESC");
		 
		 if (!$stmt) {
			printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
		} else {
			//$nickName = "UNH";
			$stmt->bind_param("i", $site_id);
			$stmt->execute( );
			//$stmt->bind_param("UNH");
			
			$stmt->bind_result($surveyID,$inputDate, $launchStatus, $registrationState,$boatType);

			while ($stmt->fetch()) {

			array_push($surveyResult['surveyID'],$surveyID);
			array_push($surveyResult['inputDate'],$inputDate);
			array_push($surveyResult['launchStatus'],$launchStatus);
			array_push($surveyResult['registrationState'],$registrationState);
			array_push($surveyResult['boatType'],$boatType);
			
			}
			 /* close statement */
			$stmt->close( );
		}
		//var_dump($surveyResult);
		return $surveyResult;
	}
	
public function getSortedAggregatesurveys($sort,$site) {
		$mysqli = new mysqli("localhost", "colby", "commoncolby", "nhvbsr");
				
		if (mysqli_connect_errno()) {
		   printf("Connection failed: %s<br />", mysqli_connect_error());
		   exit();
		}
		
		
		
		if($sort=='day') {
			$sort = " = CURDATE()";
		}
		else if($sort=='month') {
			$sort = ">= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
		}
		else if($sort=='year') {
			$sort = ">= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)";
		}
		
		$rows = array();
		
		$result = $mysqli->query("SELECT COUNT(*) FROM surveys  WHERE SiteID = $site AND InputDate ".$sort);	
		$rows[0] = $result->fetch_row();
		
		$result = $mysqli->query("select count(SentToDES) from surveys WHERE SentToDES = '1' AND SiteID = $site AND InputDate ".$sort);		
		$rows[1] = $result->fetch_row();
		
		$result = $mysqli->query("select count(SentToDES) from surveys WHERE SentToDES = '0' AND SiteID = $site AND InputDate ".$sort);		
		$rows[2] = $result->fetch_row();		
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'NH' AND SiteID = $site AND InputDate ".$sort);
		$rows[3] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'MA' AND SiteID = $site AND InputDate ".$sort);
		$rows[4] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'ME' AND SiteID = $site AND InputDate ".$sort);
		$rows[5] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'VT' AND SiteID = $site AND InputDate ".$sort);
		$rows[6] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'CT' AND SiteID = $site AND InputDate ".$sort);
		$rows[7] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'RI' AND SiteID = $site AND InputDate ".$sort);
		$rows[8] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'NY' AND SiteID = $site AND InputDate ".$sort);
		$rows[9] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'Other' AND SiteID = $site AND InputDate ".$sort);
		$rows[10] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE PreviousInteraction = '1' AND SiteID = $site AND InputDate ".$sort);
		$rows[11] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE PreviousInteraction = '0' AND SiteID = $site AND InputDate ".$sort);
		$rows[12] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE BoatType = 'inboard/outboard(I/O)' AND SiteID = $site AND InputDate ".$sort);
		$rows[13] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE BoatType = 'PWC/jet ski/jet boat' AND SiteID = $site AND InputDate ".$sort);
		$rows[14] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE BoatType = 'canoe/kayak' AND SiteID = $site AND InputDate ".$sort);
		$rows[15] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE BoatType = 'sail' AND SiteID = $site AND InputDate ".$sort);
		$rows[16] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE BoatType = 'other' AND SiteID = $site AND InputDate ".$sort);
		$rows[17] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE Drained = '1' AND SiteID = $site AND InputDate ".$sort);
		$rows[18] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE Drained = '0' AND SiteID = $site AND InputDate ".$sort);
		$rows[19] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE Rinsed = '1' AND SiteID = $site AND InputDate ".$sort);
		$rows[20] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE Rinsed = '0' AND SiteID = $site AND InputDate ".$sort);
		$rows[21] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE DryForFiveDays = '1' AND SiteID = $site AND InputDate ".$sort);
		$rows[22] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE DryForFiveDays = '0' AND SiteID = $site AND InputDate ".$sort);
		$rows[23] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE BoaterAwareness = 'High' AND SiteID = $site AND InputDate ".$sort);
		$rows[24] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE BoaterAwareness = 'Medium' AND SiteID = $site AND InputDate ".$sort);
		$rows[25] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE BoaterAwareness = 'Low' AND SiteID = $site AND InputDate ".$sort);
		$rows[26] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE SpecimenFound = '1' AND SiteID = $site AND InputDate ".$sort);
		$rows[27] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE SpecimenFound = '0' AND SiteID = $site AND InputDate ".$sort);
		$rows[28] = $result->fetch_row();
		;
		return $rows;
	}
	
	public function getSiteID($userID) {
	
		$mysqli = new mysqli("localhost", "colby", "commoncolby", "nhvbsr");
		
		if (mysqli_connect_errno()) {
		   printf("Connection failed: %s<br />", mysqli_connect_error());
		   exit();
		}
		
		$stmt = $mysqli->prepare("select SiteID from Users where UserID=?");
		 
		 if (!$stmt) {
			printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
		} else {
			//$nickName = "UNH";
			$stmt->bind_param("i", $userID);
			$stmt->execute( );
			//$stmt->bind_param("UNH");
			
			$stmt->bind_result($SiteID);

			$stmt->fetch();
			 /* close statement */
			$stmt->close();
		}
		return $SiteID;
	
	}
	
}



?>