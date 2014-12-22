<h1><?php echo $welcome ?></h1>

<?php

if ($lakehost !="")
	echo $this->buildTable($lakehost);
else
	echo "<h2> There are no Lake Hosts in the system. </h2>";

echo $this->buttonTo("lakehost","newLakeHost", "New");

?><br>
Return <?php echo $this->linkTo("home","index","Home"); ?>


