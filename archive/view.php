<?php
require("control\boaterSurveyController.php");
?>

<html>
  <head>
    <title>Boater Survey</title>
    <link rel="stylesheet" type="text/css" href="mainLayout.css" />
	<style>
		.data, .data td, th {
			border: 1px solid black;
			border-collapse: collapse;
			text-align: center;
			margin-top: 3%;
		}
		.data th {
			background: #e0e0e0;
		}
	</style>
	<script src="//code.jquery.com/jquery-1.9.1.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="form.js"></script>
    <script src="serverRequest.js"></script>
  </head>
  <body>
  
  	<div id='cssmenu'>
			<ul>
			   <li><a href='survey.php'><span>NHVBSR</span></a></li>
			   <li><a href='lakeHostHome.php'><span>Manage Lake Hosts</span></a></li>
			   <li><a href='survey.php'><span>Survey</span></a></li>
			   <li><a href='view.php'><span>View</span></a></li>
			   <li><a href='edit.php'><span>View/Edit</span></a></li>
			   <li><a href='reports.php'><span>Reports</span></a></li>
			   <li><a href='#'><span>Logout</span></a></li>
			</ul>
	</div>
	<br><br><br>
    <div id="info">
	<h2>Survey Data</h2>
	<hr>
		
	<form action="view.php" method="post">	
	 <select name="sort">
	  <option value="day">Today</option>
	  <option value="month">This Month</option>
	  <option value="year">This Year</option>
	 </select> 
	 
	  <select name="sites">
	 
	 <?php	 
		$db1 = new db1();
		$accessSites = $db1->getAccessSites();
	   
		$self = htmlspecialchars($_SERVER["PHP_SELF"]);//The information of the form will be sent back to self. This is done to change the content of the page when the submit button is clicked.
		$numberOfSites = count($accessSites['SiteID']); //Number of sites found in the database is equal to number of site IDs.
	   
		echo "<form method='post' action='$self'>";
				//This is the HTML form header.
			   
		for($i=1;$i<=$numberOfSites;$i++) {						
			$SiteName = $accessSites['SiteName'][$i-1];
			$SiteID = $accessSites['SiteID'][$i-1];
			echo "<option value='$SiteID'>$SiteName</option>";
		}?>
		<input type="submit" value="Sort">
	
	<?php	 
       
		$view = new surveyView();
		if(isset($_POST['sort'])) {
			$view->viewAggregateData($_POST['sort'],$_POST['sites']);	
		}
		else {
			$x="day";
			$view->viewAggregateData($x,1);
		}                          

                          
	  ?>
	  
	  
    </div>
  </body>
</html>
