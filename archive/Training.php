<?php

?>

<html>
<div align="center">
 <head>
   <title>addLakeHost</title>
   <link rel="stylesheet" type="text/css" href="mainLayout.css" />
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   <script src="form.js"></script>
   <script src="serverRequest.js"></script>
 </head>
 <body>
 
 	<div id='cssmenu'>
<ul>
  <li><a href='#'><span>NHVBSR</span></a></li>
  <li><a href='#'><span>Survey</span></a></li>
  <li><a href='#'><span>Manage Lake Hosts</span></a></li>
  <li><a href="view.php"><span>View</span></a></li>
  <li><a href='#'><span>Edit</span></a></li>
  <li><a href='#'><span>Logout</span></a></li>
</ul>
</div>
<br><br><br>
   <div id="info">
<h2>Training Certification</h2>
<hr>


<form method="post" action="index.php">
<table border=10>

<tr>
<td id="D_Train" <span class="req"></span>
Date Trained: 
</td>
<td colspan=5>
<input type ="text" name="D_Train"/> <br />
</td>
</tr>
<tr>
<td id="Trainer" <span class="req"></span>
Trained By: 
</td>
<td>
<input type ="text" name="Trainer"/>
</td>
</tr>
<td id="Received" <span class="req"></span>
Received/Retrained By: 
</td>
<td colspan=3>
<select>
  	<option value="1">Person 1</option>
  	<option value="2">Person 2</option>
	<option value="3">Person 3</option>
    <option value="4">Person 4</option>
</select><br />
</td>


</table>

</form>

</body>

<div align="center">

<FORM METHOD="LINK" ACTION="contactInfo.php">
<INPUT TYPE="submit" VALUE="BACK">
</FORM>

<FORM METHOD="LINK" ACTION="emergencyContact.php">
<INPUT TYPE="submit"VALUE="NEXT">
</FORM>

</div>


<div align="center">
<a href="lakeHostHome.php" class="homePage">Home</a>
</div>


<hr>
<?php

require("homeButtonCSS.css");

?>
   </div>
 </body>
 </div>
</html>