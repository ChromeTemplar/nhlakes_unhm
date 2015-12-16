<?php 

//Take apart the url to get the group that was selected
$idInURL = explode("&", explode("&id=", $_SERVER['REQUEST_URI'])[1]);
$groupID = $idInURL[0];

?>
 
 <h1><?php echo $welcome; ?></h1>
	
<input type="button" id="test"  value="Export Group's Survey Summary Data"/>

<script type="text/javascript">
	var id = "<?php echo $groupID; ?>";
	var url = "location.href='/nhvbsr/model/export.php?runFunction=exportGroupSurvey&groupID="+id+"';"

    document.getElementById("test").setAttribute("onclick", url);
</script>

<?php

//Build the table according to the selected group
echo $this->buildTable($user, "group", $groupID);
echo "(Coordinators denoted in green.)";

?><br>
    Return <?php echo $this->linkTo("home", "index", "Home"); ?>