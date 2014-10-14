<h1><?php echo $welcome;?></h1>

<?php
$this->buttonTo("survey","editSurvey","Edit");
$this->buttonTo("survey","newSurvey", "New");

$this->buildTable($surveys);
?>

