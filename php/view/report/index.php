<h1><?php echo $welcome ?></h1>

<?php

if ($report !="")
	echo $this->buildTable($report);
else
	echo "<h2> There are no Survey Summaries in the system. </h2>";

?><br>
Return <?php echo $this->linkTo("home","index","Home"); ?>


