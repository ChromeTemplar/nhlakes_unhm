<!--  Remove CSS Segregation -->
<!-- <div id="navigation-title">Menu1</div>  -->

<!--<h1>Menu</h1>-->

<div id="nav">

    <?php echo "EOA ON" ?> <!-- SHOULD POINT HERE --> <!--a href="view/layout/applicationViewEOA.php"-->

    <?php echo $this->linkTo("home", "index", "Home"); ?>
    <!-- <li><?php // echo $this->linkTo("survey", "index", "Survey"); ?></li> -->

    <!-- The below validation is to expose the below links only for people with role of admin or Coordinators -->
    <?php echo $this->linkTo("boatramp", "index", "Boat Ramp"); ?>
    <?php echo $this->linkTo("waterbody", "index", "Waterbody"); ?>

    <!-- The below validation is to expose the below links only for people with role of admin or Coordinators -->
    <?php if (isset($_SESSION['roleID']) && ($_SESSION['roleID'] < 3)) { ?>
        <?php echo $this->linkTo("user", "index", "Lake Host"); ?>
        <?php echo $this->linkTo("group", "index", "Groups"); ?>
    <?php } ?>

    <!--  Drop Invasive Species -->
    <!-- <li><?php echo $this->linkTo("invasivespecies", "index", "Invasive Species"); ?></li>  -->

    <?php echo $this->linkTo("surveysummary", "index", "Survey Summary"); ?>
    <?php echo $this->linkTo("report", "index", "Report"); ?>

    <!-- The below validation is to expose the below links only for people with role of admin -->
    <?php if (isset($_SESSION['roleID']) && ($_SESSION['roleID'] < 2)) { ?>
        <?php echo $this->linkTo("logging", "index", "Logging") ?>
    <?php } ?>
    <?php echo $this->linkTo("sessionend", "end", "Logout"); ?>

    <?php echo "EOA OFF" ?> <!-- SHOULD POINT HERE --> <!--a href="view/layout/applicationView.php"-->


</div>