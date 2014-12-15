<h1><?php echo $welcome; ?></h1>

<?php if ($waterbodies != "") { ?>
    <!-- demo -->
    <div id="data">

        <!-- panel -->
        <?php 
        
        require_once "view/partials/_controlsTop.php";
        
        echo "<div id='waterbody-table' >".$this->buildTable($waterbodies)."</div>";
        
        require_once "view/partials/_controlsBottom.php";
        
        ?>
        <!-- no results found -->
       <div class="jplist-no-results">
          <p>No results found</p>
       </div>

    </div>
    <?php
    
}else
    echo "<h2>No Waterbodies Found</h2>";

    ?>

<div id="content-bottom"> 
<?php echo $this->buttonTo("waterbody","newWaterbody", "New"); ?>
<br/>
Return <?php echo $this->linkTo("home","index","Home"); ?>
</div>

