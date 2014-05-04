<?php

require("boaterSurvey.php");
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
			   <li><a href='survey.php'><span>Survey</span></a></li>
			   <li><a href='view.php'><span>View</span></a></li>
			   <li><a href='edit.php'><span>View/Edit</span></a></li>
			   <li><a href='#'><span>Logout</span></a></li>
			</ul>
	</div>
	<br><br><br>
    <div id="info">
	<h2>Boater Survey List</h2>
	<hr>
      <?php
		$user_id = 3;
		$model = new surveyModel();
		$view = new surveyView();
		$role = $model->getUserRole($_SESSION['userid']);
		
		if($role == "StaffMember") {
			header('Location: accessSitesPage.php');
		} else {
			$view->viewSurveysList($_SESSION['userid']);
		}
	  ?>
    </div>
  </body>
</html>