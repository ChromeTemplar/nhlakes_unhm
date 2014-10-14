<h1><?php echo $welcome;?></h1>

<?php
echo $this->buildTable($surveys);

echo $this->buttonTo("survey","newSurvey", "New");
?>

