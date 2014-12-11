<h1><?php echo $welcome; ?></h1>

<h2>Boat Ramp</h2>

<?php
echo $this->buttonTo("boatRamp","index","All Boat Ramps");
echo $this->buttonTo("boatRamp","newBoatRamp", "New Boat Ramp");
?>

<h2>Invasive Species</h2>
<?php
echo $this->buttonTo("invasiveSpecies", "index", "All Invasive Species");
echo $this->buttonTo("invasiveSpecies","newInvasiveSpecies", "New Invasive Species");
?>

<h2>Lake Host</h2>
<?php
echo $this->buttonTo("lakeHost", "index", "All Lake Hosts");
echo $this->buttonTo("lakeHost","newLakeHost", "New Lake Host");
?>

<h2>Survey Summary</h2>
<?php
echo $this->buttonTo("surveySummary", "index", "View Summaries");
echo $this->buttonTo("surveySummary","newSurveySummary", "Add New Summary");
?>

<h2>Survey</h2>
<?php
echo $this->buttonTo("survey", "index", "All Surveys");
echo $this->buttonTo("survey","newSurvey", "New Survey");
?>
