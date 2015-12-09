<?php

?>

<html>
  <head>
    <title>Manage Lake Hosts</title>
    <link rel="stylesheet" type="text/css" href="mainLayout.css" />
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
			   <li><a href='index.php'><span>Logout</span></a></li>
			</ul>
	</div>
	<br><br><br>
    <div id="info">
	<h2>Manage Lake Hosts</h2>
	<hr>
	
	<div align="center">
<a href="addLakeHost.php" class="addLakeHost">Add Lake Host</a>
<a href="editLakeHost.php" class="editLakeHost">Edit Lake Host</a>
<br>

<p>
</p>

<a href="deactivateLakeHost.php" class="deactivateLakeHost">Deactivate Lake Host</a>
<a href="viewLakeHost.php" class="viewLakeHost">View Lake Host</a>
</div>
<br></br>
<div align="center">
<a href="lakeHostHome.php" class="homePage">Home</a>
</div>
<?php

	require("addLakeHostCSS.css");
	require("editLakeHostCSS.css");
	require("deactivateLakeHostCSS.css");
	require("viewLakeHostCSS.css");
	require("homeButtonCSS.css");
	
?>

    </div>
  </body>
</html>

