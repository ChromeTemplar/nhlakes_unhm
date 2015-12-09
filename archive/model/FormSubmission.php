<?php
	session_start();
	require_once ("boaterSurveyDB.php");

	$sql = new mysqli("localhost", "root", "", "nhvbsr");
	if ($sql->connect_errno) {
		printf("Connect failed: %s\n", $sql->connect_error);
		exit();
	}
	
	if($_POST)
	{	
		$db1 = new db1;
		$hostID = $_SESSION['UserID'];
		$siteID = $db1->getSiteID($hostID); 
		
		
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
		$bow = $_POST['Bow'];
		
		$prep = $sql->prepare("INSERT INTO surveys(LakeHostID, InputDate, InspectionTime,SiteID, LaunchStatus, RegistrationState, BoatType, previousInteraction, LastSiteVisited, LastTownVisited, LastStateVisited, Drained, Rinsed, DryForFiveDays, BoaterAwareness, SpecimenFound,  BowNumber) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$prep->bind_param('ississsisssiiisii', $hostID,$date,$time,$siteID,$status,$sor,$type,$interaction,$lastSite,$lastTown,$lastState,$drained,$rinsed, $dried,$aware,$found,$bow);
		$prep->execute();
		
		header("Location:..\survey.php");
	}
?>