<?php
/*
This script imports data from an uploaded csv file that is exported from the 2014
access site spread sheet.  
*/

//check that a file was uploaded, and display information about the file
if ($_FILES["file"]["error"] > 0)
{
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
} 
else
{
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br>";
}

//get the file that was uploaded
$uploadcsv = $_FILES["file"]["tmp_name"];

//get the access site name
$siteName = $_POST['siteName'];

// try to open the file.
$handle = fopen($uploadcsv, "r");

// error handling
if($handle === false) 
{
   die("Error opening $uploadcsv");
}
	

//Use PDO to connect to the DB with these credentials
$dsn = 'mysql:cis730=lake;host=localhost';
$user = 'cis730';
$password = 'cis730';

//error handling
try
{
	$dbh = new PDO($dsn, $user, $password);
}
catch (PDOException $e)
{
	echo 'Connection failed: ' . $e->getMessage();
}

//String values to test for to eliminate invalid data rows
$total = "Total = ";
$date = "Date";

//Loop through each record in the CSV file and add the valid rows into the imports table
for($i =1;($data = fgetcsv($handle, 10000, ",")) !== FALSE; $i++)
{

	//sql insert statement			
	$sql = "INSERT INTO imports (TownName, Date, InspectionTotal,
	NH, MA, ME, VT, CT, RI, NY, Other, BoatType_InOut, BoatType_PWCJET, 
	BoatType_Sail, BoatType_CanoeCayak, BoatType_Other, PreviousInteraction_Yes,
	PreviousInteract_No, Drained_Yes, Drained_No, Rinsed_Yes, Rinsed_No, DryFiveDays_Yes,
	DryFiveDays_No, AISLevel_Low, AISLevel_Medium, AISLevel_High, SpeciesFound_Yes, SpeciesFound_No, DES_Yes, DES_No)
	VALUES (:TownName, :Date, :InspectionTotal,
	:NH, :MA, :ME, :VT, :CT, :RI, :NY, :Other, :BoatType_InOut, :BoatType_PWCJET, 
	:BoatType_Sail, :BoatType_CanoeCayak, :BoatType_Other, :PreviousInteraction_Yes,
	:PreviousInteraction_No, :Drained_Yes, :Drained_No, :Rinsed_Yes, :Rinsed_No, :DryFiveDays_Yes,
	:DryFiveDays_No, :AISLevel_Low, :AISLevel_Medium, :AISLevel_High, :SpeciesFound_Yes, :SpeciesFound_No, :DES_Yes, :DES_No);";
				

	//check if the row is valid, makes sure it has a value in the total # of inspections column
	//as well as make sure the row doesn't start with an invalid value
	if (!strlen($data[1]) < 1 && strnatcasecmp($total,$data[0]) != 0 && strnatcasecmp($date,$data[0]) != 0)
	{
	  //prepare the statement
	  $sth = $dbh->prepare($sql);

		//The data bound to placeholders
		$sth->bindParam(':TownName', $siteName);
		$sth->bindParam(':Date',$data[0]);
		$sth->bindParam(':InspectionTotal', $data[1]);
		$sth->bindParam(':NH', $data[2]);
		$sth->bindParam(':MA', $data[3]);
		$sth->bindParam(':ME', $data[4]);
		$sth->bindParam(':VT', $data[5]);
		$sth->bindParam(':CT', $data[6]);
		$sth->bindParam(':RI', $data[7]);
		$sth->bindParam(':NY', $data[8]);
		$sth->bindParam(':Other', $data[9]);
		$sth->bindParam(':BoatType_InOut', $data[10]);
		$sth->bindParam(':BoatType_PWCJET', $data[11]);
		$sth->bindParam(':BoatType_Sail', $data[12]);
		$sth->bindParam(':BoatType_CanoeCayak', $data[13]);
		$sth->bindParam(':BoatType_Other', $data[14]);
		$sth->bindParam(':PreviousInteraction_Yes', $data[15]);
		$sth->bindParam(':PreviousInteraction_No', $data[16]);
		$sth->bindParam(':Drained_Yes', $data[17]);
		$sth->bindParam(':Drained_No', $data[18]);
		$sth->bindParam(':Rinsed_Yes', $data[19]);
		$sth->bindParam(':Rinsed_No', $data[20]);
		$sth->bindParam(':DryFiveDays_Yes', $data[21]);
		$sth->bindParam(':DryFiveDays_No', $data[22]);
		$sth->bindParam(':AISLevel_Low', $data[23]);
		$sth->bindParam(':AISLevel_Medium', $data[24]);
		$sth->bindParam(':AISLevel_High', $data[25]);
		$sth->bindParam(':SpeciesFound_Yes', $data[26]);
		$sth->bindParam(':SpeciesFound_No', $data[27]);
		$sth->bindParam(':DES_Yes', $data[28]);
		$sth->bindParam(':DES_No', $data[29]);
			
		//The row is actually inserted here
		$sth->execute();
		$sth->closeCursor();
	}
}
	echo "<br>Database Import Complete.";

?> 