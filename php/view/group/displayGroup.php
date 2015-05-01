<h1><?php echo $welcome; ?></h1>

<?php

	$idInURL  = explode("&", explode("&id=", $_SERVER['REQUEST_URI'])[1] );
    $groupID = $idInURL[0];
	echo $this->buildTable($user, "group", $groupID);
	echo "(Coordinators denoted in green.)";
	
?><br>
Return <?php echo $this->linkTo("home","index","Home"); ?>