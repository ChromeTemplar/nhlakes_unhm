<h1><?php echo $welcome;?></h1>

<?php
if ($summary !="")
	echo $this->buildTable($summary, "surveysummary");
else
	echo "<h2>No Survey Summary Found </h2>";
?>

<br>
Return <?php echo $this->linkTo("home","index","Home"); ?>