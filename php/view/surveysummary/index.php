<h1><?php echo $welcome;?></h1>

<?php
echo $this->buildTable($summary);

echo $this->buttonTo("surveySummary","newSurveySummary", "New");
?>

<br>
Return <?php echo $this->linkTo("home","index","Home"); ?>