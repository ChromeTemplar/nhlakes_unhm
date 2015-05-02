<div id="navigation-title">Menu</div>
<ul>
    <li><?php echo $this->linkTo("home", "index", "Home"); ?></li>
    <!-- <li><?php // echo $this->linkTo("survey", "index", "Survey"); ?></li> -->
    <!-- The below validation is to expose the below links only for people with role of admin or Coordinators -->
    <li><?php echo $this->linkTo("boatramp", "index", "Boat Ramp"); ?></li>
    <li><?php echo $this->linkTo("waterbody","index","Waterbody"); ?></li>
    <!-- The below validation is to expose the below links only for people with role of admin or Coordinators -->
    <?php if (isset($_SESSION['roleID']) && ($_SESSION['roleID'] < 3)) { ?>
    <li><?php echo $this->linkTo("user", "index", "Users"); ?></li>
    <li><?php echo $this->linkTo("group", "index", "Groups"); ?></li>
    <?php  } ?>
    <li><?php echo $this->linkTo("invasivespecies", "index", "Invasive Species"); ?></li>
    <li><?php echo $this->linkTo("surveysummary", "index", "Survey Summary"); ?></li>    
    <li><?php echo $this->linkTo("report", "index", "Report"); ?></li>
    <li><?php echo $this->linkTo("sessionend","end","Logout"); ?></li>
 </ul> 