<?php

require_once("control\boaterSurveyController.php");
?>

<html>
  <head>
    <title>Boater Survey</title>
    <link rel="stylesheet" type="text/css" href="mainLayout.css" />
	<script src="//code.jquery.com/jquery-1.9.1.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="form.js"></script>
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
			   <li><a href='index.php'><span>Logout</span></a></li>
			</ul>
	</div>
	<br><br><br>
    <div id="info">
	<h2>Boater Survey</h2>
	<hr>
      <?php
		
		$view = new surveyView();
		$view->newSurvey();

	  ?>
    </div>
  </body>
</html>
