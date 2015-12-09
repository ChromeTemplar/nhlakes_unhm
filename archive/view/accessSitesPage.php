<?php
/*
This page will be sent to the browser to display a list of the access sites stored in the database.

*/
require("..\control\boaterSurveyController.php");
?>

<html>
  <head>
    <title>Boater Survey</title>
    <link rel="stylesheet" type="text/css" href="../mainLayout.css" />
	<script src="//code.jquery.com/jquery-1.9.1.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="form.js"></script>
  </head>
  <body>
  
  	<div id='cssmenu'>
			<ul>
			   <li><a href='../survey.php'><span>NHVBSR</span></a></li>
			   <li><a href='../lakeHostHome.php'><span>Manage Lake Hosts</span></a></li>
			   <li><a href='../survey.php'><span>Survey</span></a></li>
			   <li><a href='../view.php'><span>View</span></a></li>
			   <li><a href='../edit.php'><span>View/Edit</span></a></li>
			   <li><a href='../reports.php'><span>Reports</span></a></li>
			   <li><a href='../index.php'><span>Logout</span></a></li>
			</ul>
	</div>
	<br><br><br>
    <div id="info">
	<h2>Boater Survey List</h2>
	<hr>
      <?php
		
		$view = new surveyView();
		$controller = new surveyController();
		
		if (isset($_POST['submitButton'])) { // When a user clicks the submit button a list of surveys will be displayed.
			if(isset($_POST['SiteID'])) // If site id is set then get the surveys associated with this site.
			{
			$ID = $_POST['SiteID']; // Get the site id from the $_POST array.
			$view->viewSiteSurveys($ID);
			} else { // if site id is not been selected.
				echo "Select a site please!"; 
			}
			
		} else { // If submit button is not been set that means the user is coming from a page different than $server_self. In this case display a list of access site.
			$controller->viewAccessSites();
		}
	  ?>
    </div>
  </body>
</html>