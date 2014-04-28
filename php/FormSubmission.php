<?php
	$sql = new mysqli("localhost", "root", "", "NHVBSR");
	if ($sql->connect_errno) {
		printf("Connect failed: %s\n", $sql->connect_error);
		exit();
	}
	
	if($_POST)
	{	
		$hostID; //get from session
		$siteID; // get from session
		
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
		$dried = $_POST['dried'];
		$aware = $_POST['awareness'];
		$reg = $_POST['registrationState'];
		$DES = $_POST['DES'];

		$prep = $sql->prepare("INSERT INTO survey(hostID, siteID, time, date, status, sor, type, interaction, lastSite, lastTown, lastState, drained, rinsed, dried, aware, red, DES) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$prep->bind_param('sssssssssssssssss',$hostID, $siteID, $time, $date, $status, $sor, $type, $interaction, $lastSite, $lastTown, $lastState,$drained, $rinsed, $dried, $aware, $red, $DES);
		$prep->execute();
	}
?>