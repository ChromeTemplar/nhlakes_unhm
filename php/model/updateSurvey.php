<?php
	session_start();
	require_once("boaterSurveyModel.php");
	
	
	$sql = new mysqli("localhost", "root", "", "nhvbsr");
	if ($sql->connect_errno) {
		printf("Connect failed: %s\n", $sql->connect_error);
		exit();
	}
	
	if($_POST)
	{	
		var_dump($_POST);
		$model = new surveyModel();
		$role = $model->getUserRole($_SESSION['UserID']);
		echo $role;
		
		$survey_id = $_POST['surveyID'];
		//echo $survey_id;
		$hostID = 1; //get from session
		$siteID = 1; // get from session
		
		$time = $_POST['time'];
		$date = $_POST['date'];
		$status = $_POST['status'];
		$sor = $_POST['registrationState'];
		$type = $_POST['boat'];
		$interaction = $_POST['interaction'];
		$lastSite = $_POST['lastSiteVisited'];
		$lastTown = $_POST['lastTownVisited'];
		$lastState = $_POST['lastStateVisited'];
		$drained = $_POST['drained'];
		$rinsed = $_POST['rinsed'];
		$dried = $_POST['dryForFiveDays'];
		$aware = $_POST['awareness'];
		$found = $_POST['specimenFound'];
		$bow = $_POST['bowNumber'];
		$DES="";
		if(isset($_POST['sentToDES'])) $DES = $_POST['sentToDES'];
		$notes="";
		if(isset($_POST['notes'])) $notes = $_POST['notes'];
		$active="";
		if(isset($_POST['active']))	$active = $_POST['active'];
		
		
		$prep = $sql->prepare("update surveys set InputDate=?,InspectionTime=?,LaunchStatus=?,RegistrationState=?,BoatType=?,previousInteraction=?, 
		LastSiteVisited=?,LastTownVisited=?,LastStateVisited=?,Drained=?,Rinsed=?, DryForFiveDays=?,BoaterAwareness=?, 
		SpecimenFound=?,BowNumber=?, SentToDES=?, Notes=?, Active=? where surveyID = $survey_id");
		if (!$prep) {
			printf("prepare( ) failed: (%s) %s", $sql->errno, $sql->error);
		} else {
		$prep->bind_param('ssisssisssiiisiisi',$date,$time,$status,$sor,$type,$interaction,$lastSite,$lastTown,$lastState,$drained,$rinsed, $dried,$aware 
		,$found,$bow,$DES,$notes,$active);
		$prep->execute();
		
		//echo $_SESSION['UserID'];
		header('Location:..\edit.php');
		}
	}
?>