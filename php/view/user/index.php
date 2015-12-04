<?php //Display the correct form description ?>
<h1><?php echo $welcome ?></h1>

<?php
//Build the user table and populate it with users. See the 
// buildTable() in template.php for more info. 

if ($user !="")
	echo $this->buildTable($user, "user");
else
	echo "<h2> There are no Lake Hosts in the system. </h2>";

echo $this->buttonTo("user","newuser", "New");

?><br>
Return <?php echo $this->linkTo("home","index","Home"); ?>


