<?php

require_once("..\control\boaterSurveyController.php");
require_once("..\model\loginModel.php");
require_once("boaterSurveyView.php");
session_start();
?>

<html>
  <head>
    <title>Boater Survey</title>
    <link rel="stylesheet" type="text/css" href="..\mainLayout.css" />
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
	<h2>Edit/Flag Survey</h2>
	<hr>
      <?php
	  
		//$user_id = 2;
		if(isset($_POST['surveyID'])) {
			$surveyID = $_POST['surveyID'];
			$view = new surveyView();
			$view->editSurvey($surveyID,$_SESSION['UserID']);
		} else {
			echo "Please select a survey!";
		}
		
	  ?>
    </div>
  </body>
</html>