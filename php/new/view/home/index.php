<h1><?php echo $welcome; ?></h1>

<h2>Boat Ramp</h2>

<?php
$this->buttonTo("boatRamp","index","All Boat Ramps");
$this->buttonTo("boatRamp","newBoatRamp", "New Boat Ramp");
?>

<h2>Invasive Species</h2>
<?php
$this->buttonTo("invasiveSpecies", "index", "All Invasive Species");
$this->buttonTo("invasiveSpecies","newInvasiveSpecies", "New Invasive Species");
?>

<h2>Lake Host</h2>
<?php
$this->buttonTo("lakeHost", "index", "All Lake Hosts");
$this->buttonTo("lakeHost","newLakeHost", "New Lake Host");
?>

<h2>Survey</h2>
<?php
$this->buttonTo("survey", "index", "All Surveys");
$this->buttonTo("survey","newSurvey", "New Survey");
?>
