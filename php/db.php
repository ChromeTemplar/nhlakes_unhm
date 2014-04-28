<?php

class db {

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
		
		 $stmt = $this->mysqli->prepare("select * from boaterSurvey where surveyID=$survey_id");
		 
		 if (!$stmt) {
			printf("prepare( ) failed: (%s) %s", $this->mysqli->errno, $this->mysqli->error);
		} else {
			//$nickName = "UNH";
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

}


?>