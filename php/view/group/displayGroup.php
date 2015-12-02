<?php //Display the correct form description ?>
    <h1><?php echo $welcome; ?></h1>

<?php

//Take apart the url to get the group that was selected
$idInURL = explode("&", explode("&id=", $_SERVER['REQUEST_URI'])[1]);
$groupID = $idInURL[0];
//Build the table according to the selected group
echo $this->buildTable($user, "group", $groupID);
echo "(Coordinators denoted in green.)";

?><br>
    Return <?php echo $this->linkTo("home", "index", "Home"); ?>