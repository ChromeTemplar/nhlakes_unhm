<?php
	$sql = new mysqli("localhost", "root", "", "nhvbsr");
	if ($sql->connect_errno) {
		printf("Connect failed: %s\n", $sql->connect_error);
		exit();
	}
	
	if($_POST)
	{	
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
		$bow = $_POST['Bow'];
		$DES = $_POST['sentToDES'];
		
		$prep = $sql->prepare("INSERT INTO surveys(LakeHostID, InputDate, InspectionTime,SiteID, LaunchStatus, RegistrationState, BoatType, previousInteraction, LastSiteVisited, LastTownVisited, LastStateVisited, Drained, Rinsed, DryForFiveDays, BoaterAwareness, SpecimenFound,  BowNumber,SentToDES) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$prep->bind_param('ississsisssiiisiii', $hostID,$date,$time,$siteID,$status,$sor,$type,$interaction,$lastSite,$lastTown,$lastState,$drained,$rinsed, $dried,$aware,$found,$bow,$DES);
		$prep->execute();
		
		header("Location:survey.php");
	}
?>