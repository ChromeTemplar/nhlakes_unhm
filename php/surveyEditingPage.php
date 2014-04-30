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
			   <li><a href='index.php'><span>NHVBSR</span></a></li>
			   <li><a href='survey.php'><span>Survey</span></a></li>
			   <li><a href='#'><span>View</span></a></li>
			   <li><a href='edit.php'><span>Edit</span></a></li>
			   <li><a href='#'><span>Logout</span></a></li>
			</ul>
	</div>
  
	<br><br><br>
    <div id="info">
	<h2>Boater Survey</h2>
	<hr>
      <?php
		$user_id = 6;
		if(isset($_POST['surveyID'])) {
			$surveyID = $_POST['surveyID'];
			$view = new surveyView();
			$view->editSurvey($surveyID,$user_id);
		} else {
			echo "Please select a survey!";
		}
		
	  ?>
    </div>
  </body>
</html>