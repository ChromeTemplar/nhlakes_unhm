<?php

require("control\boaterSurveyController.php");
?>

<html>
  <head>
    <title>Boater Survey</title>
    <link rel="stylesheet" type="text/css" href="mainLayout.css" />
	<link rel="stylesheet" type="text/css" href="surveyData.css" />
	<script src="//code.jquery.com/jquery-1.9.1.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="form.js"></script>
    <script src="serverRequest.js"></script>
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
	<h2>Survey Data</h2>
	<hr>
		
	<form action="view.php" method="post">	
	 <select name="sort">
	  <option value="day">Today</option>
	  <option value="month">This Month</option>
	  <option value="year">This Year</option>
	 </select> 
	 <input type="submit" value="Sort">
	 
      <?php	  
		$view = new surveyView();
		if(isset($_POST['sort'])) {
			$view->viewAggregateData($_POST['sort']);	
		}
		else {
			$x="";
			$view->viewAggregateData($x);
		}
	  ?>
	  
	  
    </div>
  </body>
</html>
