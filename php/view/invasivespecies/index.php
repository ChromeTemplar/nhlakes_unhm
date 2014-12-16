<h1><?php echo $welcome ?></h1>

<?php

if ($invasivespecies !="")        
    echo $this->buildTable($invasivespecies);
else
    echo "<h2>No Invasive Species Found </h2>";
    
echo $this->buttonTo("invasivespecies","newInvasiveSurvey", "New");




?><br>
Return <?php echo $this->linkTo("home","index","Home"); ?>
