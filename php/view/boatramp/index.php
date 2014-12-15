<h1><?php echo $welcome; ?></h1>


<?php if ($ramps != ""){ ?>

    <!-- demo -->
    <div id="data">

        <!-- panel -->
        <?php 
        
        require_once "view/partials/_controlsTop.php";				 
        echo "<div id='boatramp-table' >".$this->buildTable($ramps). "</div>";
        require_once "view/partials/_controlsBottom.php";
        
        ?>
        <!-- no results found -->
        <div class="jplist-no-results">
          <p>No results found</p>
        </div>

    </div>
    <?php
    
}else
    echo "<h2>No Boat Ramps Found</h2>";

?>
<div id="content-bottom">
    <?php echo $this->buttonTo("boatramp","newBoatRamp", "New"); ?>
    <br/>
    Return <?php echo $this->linkTo("home","index","Home"); ?>
</div>



