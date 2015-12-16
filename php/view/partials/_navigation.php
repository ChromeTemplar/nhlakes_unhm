
<html>
<body>
<div id="nav">

			<table align="center">
				  <!--<td class="button"><?php /*echo "EOA ON" */?></td> <!-- SHOULD POINT HERE --> <!--a href="view/layout/applicationViewEOA.php"-->
	
					<td class="button"><?php echo $this->linkTo("home", "index", "Home"); ?> </td>
		   
		   
					<!-- The below validation is to expose the below links only for people with role of admin or Coordinators -->
					<td class="button"><?php echo $this->linkTo("boatramp", "index", "Boat Ramp"); ?> </td>
					<td class="button"><?php echo $this->linkTo("waterbody", "index", "Waterbody"); ?> </td>
				 
					<!-- The below validation is to expose the below links only for people with role of admin or Coordinators -->
					<?php if (isset($_SESSION['roleID']) && ($_SESSION['roleID'] < 3)) { ?> 
					<td class="button"><?php echo $this->linkTo("user", "index", "Lake Host"); ?> </td>
					<td class="button"><?php echo $this->linkTo("group", "index", "Groups"); ?> </td>
					<?php } ?> 

					<td class="button"><?php echo $this->linkTo("surveysummary", "index", "Survey Summary"); ?></td>
					<td class="button"><?php echo $this->linkTo("report", "index", "Report"); ?></td>
 
					<!-- The below validation is to expose the below links only for people with role of admin -->
					<?php if (isset($_SESSION['roleID']) && ($_SESSION['roleID'] < 2)) { ?> 
					<!--<td class="button"><?php /* echo $this->linkTo("logging", "index", "Logging") */ ?> </td> -->
					<?php } ?>
					<td class="button"><?php echo $this->linkTo("sessionend", "end", "Logout"); ?> </td>

				   <!-- <td class="button">	<?php /*echo "EOA OFF"*/ ?></td> <!-- SHOULD POINT HERE --> <!--a href="view/layout/applicationView.php"-->

</table>
</div>

</div>
</body>
</html>



    <!--  Drop Invasive Species -->
    <!-- <li><?php echo $this->linkTo("invasivespecies", "index", "Invasive Species"); ?></li>  -->
	
	
     <!-- <li><?php // echo $this->linkTo("survey", "index", "Survey"); ?> </li></li> -->