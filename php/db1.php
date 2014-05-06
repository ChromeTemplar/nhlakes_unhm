<?php

class db1 {

	private $mysqli;
	
	function __construct(){
	
		$mysqli = new mysqli("localhost", "root", "", "");
		
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
	
	
	$mysqli = new mysqli("localhost", "root", "", "nhvbsr");
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

		$date = "2013-01-03";
		$numberOfLakeHosts = count($LakeHosts);
		
		
		for ($i = 1; $i<$numberOfLakeHosts; $i++ ) {
		$LakeHostID = $LakeHosts[$i-1];
		$stmt = $mysqli->prepare("select SurveyID,InspectionTime,LaunchStatus,RegistrationState,BoatType from Surveys where LakeHostID=? and InputDate=?");
		 
		 if (!$stmt) {
			printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
		} else {
			//$nickName = "UNH";
			$stmt->bind_param("is", $LakeHostID, $date);
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
		$mysqli = new mysqli("localhost", "root", "", "nhvbsr");
				
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
		$mysqli = new mysqli("localhost", "root", "", "nhvbsr");
				
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
		$mysqli = new mysqli("localhost", "root", "", "nhvbsr");
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
		return $surveyResult;
	}
	
	public function getSortedAggregatesurveys($sort) {
		$mysqli = new mysqli("localhost", "root", "", "nhvbsr");
				
		if (mysqli_connect_errno()) {
		   printf("Connection failed: %s<br />", mysqli_connect_error());
		   exit();
		}
		
		$rows = array();
		
		$result = $mysqli->query("SELECT COUNT(*) FROM surveys");		
		$rows[0] = $result->fetch_row();
		
		$result = $mysqli->query("select count(SentToDES) from surveys WHERE SentToDES = '1'");		
		$rows[1] = $result->fetch_row();
		
		$result = $mysqli->query("select count(Drained) from surveys WHERE Drained = '1'");		
		$rows[2] = $result->fetch_row();
		
		$result = $mysqli->query("select count(Rinsed) from surveys WHERE Rinsed = '1'");		
		$rows[3] = $result->fetch_row();
		
		$result = $mysqli->query("select count(DryForFiveDays) from surveys WHERE DryForFiveDays = '1'");		
		$rows[4] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'NH'");
		$rows[5] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'MA'");
		$rows[6] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'ME'");
		$rows[7] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'VT'");
		$rows[8] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'CT'");
		$rows[9] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'RI'");
		$rows[10] = $result->fetch_row();
		
		$result = $mysqli->query("select count(*) from surveys WHERE RegistrationState = 'NY'");
		$rows[11] = $result->fetch_row();
		
		return $rows;
	}
	
	
}



?>