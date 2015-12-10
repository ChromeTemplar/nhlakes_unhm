<h1><?php echo $welcome; ?></h1>


<?php
include 'view/lakegroupstats/surveytotalview.php';
if ($summary != "") {

    $displayList = array(
        "Date" => "summaryDate",
        "Boat Ramp" => "boatRampID",
        "UserID" => "userID",
        "Total inspections" => "totalInspections"


        //"Notes" => "notes",
    );

    ?>

    <!-- demo -->
    <div id="data">

        <!-- panel -->
        <?php

        require_once "view/partials/_controlsTop1.php";
        echo "<div id='summary-table' >" . $this->buildSurveyTable($summary, $displayList) . "</div>";
        require_once "view/partials/_controlsBottom.php";

        ?>
        <!-- no results found -->
        <div class="jplist-no-results">
            <p>No results found</p>
        </div>

    </div>
    <?php

} else
    echo "<h2>No Summary Survey Found</h2>";

?>
<div id="content-bottom">
    <?php echo $this->buttonTo("surveySummary", "newSurveySummary", "New"); ?>

    <br/>
    Return <?php echo $this->linkTo("home", "index", "Home"); ?>
</div>


