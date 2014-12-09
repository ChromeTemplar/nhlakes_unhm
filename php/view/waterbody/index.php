<h1><?php echo $welcome; ?></h1>

<?php
if ($waterbodies != "")
    echo "<div id='waterbody-table' >".$this->buildTable($waterbodies)."</div>";
else
    echo "<h2>No Waterbodies Found</h2>";


echo $this->buttonTo("waterbody","newWaterbody", "New");

?>
<br/>

Return <?php echo $this->linkTo("home","index","Home"); ?>

