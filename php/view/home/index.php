<h1><?php echo $welcome; ?></h1>

<!-- The below validation is to expose the below links only for people with role of admin or Coordinators -->
<?php if (isset($_SESSION['roleID']) && ($_SESSION['roleID'] < 3)) { ?>	
<h2>Boat Ramp</h2>
<?php
echo $this->buttonTo("boatramp","index","All");
echo $this->buttonTo("boatramp","newBoatRamp", "New");
?>
<?php  } ?>

<h2>Waterbody</h2>

<?php
echo $this->buttonTo("waterbody","index","All");
echo $this->buttonTo("waterbody","newWaterbody", "New");
?>

<h2>Invasive Species</h2>
<?php
echo $this->buttonTo("invasivespecies", "index", "All");
echo $this->buttonTo("invasivespecies","newInvasiveSpecies", "New");
?>
<!-- The below validation is to expose the below links only for people with role of admin or Coordinators -->
<?php if (isset($_SESSION['roleID']) && ($_SESSION['roleID'] < 3)) { ?>
<h2>Lake Host</h2>
<?php
echo $this->buttonTo("user", "index", "All");
echo $this->buttonTo("user","newuser", "New");
?>
<?php  } ?>

<h2>Survey Summary</h2>
<?php
echo $this->buttonTo("surveySummary", "index", "All");
echo $this->buttonTo("surveySummary","newSurveySummary", "New");
?>

<!-- uncomment If using full Surveys -->
<!-- <h2>Survey</h2> -->
<?php
//echo $this->buttonTo("survey", "index", "All");
//echo $this->buttonTo("survey","newSurvey", "New");
?>
