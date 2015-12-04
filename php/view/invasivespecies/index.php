<h1><?php echo $welcome; ?></h1>


<?php

if ($invasivespecies != "") {

    $displayList = array(

        "UserID" => "userID",
        "Survey Date" => "surveyDate"
        //"Date" => "dateCreated",
        //"Notes" => "notes",
    );

    ?>

    <!-- demo -->
    <div id="data">

        <!-- panel -->
        <?php

        require_once "view/partials/_controlsTop.php";
        echo "<div id='invasive-table' >" . $this->buildSurveyTable($invasivespecies, $displayList) . "</div>";
        require_once "view/partials/_controlsBottom.php";

        ?>
        <!-- no results found -->
        <div class="jplist-no-results">
            <p>No results found</p>
        </div>

    </div>
    <?php

} else
    echo "<h2>No Invasive Species Found</h2>";

?>
<div id="content-bottom">
    <?php echo $this->buttonTo("invasivespecies", "newInvasiveSurvey", "New"); ?>

    <br/>
    Return <?php echo $this->linkTo("home", "index", "Home"); ?>
</div>

<?php echo $_SESSION['userName'] ?>



