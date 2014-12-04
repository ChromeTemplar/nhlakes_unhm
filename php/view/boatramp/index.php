<h1><?php echo $welcome; ?></h1>

<?php
if ($ramps != "")
    
    echo "<div id='boatramp-table' >".$this->buildTable($ramps). "</div>";
else
    echo "<h2>No Boat Ramps Found</h2>";


echo $this->buttonTo("boatRamp","newBoatRamp", "New");

?>
<br/>

Return <?php echo $this->linkTo("home","index","Home"); ?>
