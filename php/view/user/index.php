<h1><?php echo $welcome ?></h1>

<?php

if ($user !="")
	echo $this->buildTable($user);
else
	echo "<h2> There are no Lake Hosts in the system. </h2>";

echo $this->buttonTo("user","newuser", "New");

?><br>
Return <?php echo $this->linkTo("home","index","Home"); ?>


