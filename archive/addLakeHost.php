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
<h2>Lake Host BIO</h2>
<hr>



<form method="post" action="index.php">
<table border=10>

<tr>
<td id="FName" <span class="req"></span>
First Name: 
</td>
<td colspan=5>
<input type ="text" name="FName"/> <br />
</td>
</tr>
<tr>
<td id="LName" <span class="req"></span>
Last Name: 
</td>
<td>
<input type ="text" name="LName"/>
</td>
</tr>
<td id="ID" <span class="req"></span>
Volunteer ID: 
</td>
<td colspan=3>
<input type ="text" name="ID"/> <br />
</td>
<tr>
<td id="LakeHost" <span class="req"></span>
Lake Host Group Name: 
</td>
<td>
<select>
  	<option value="1">Lake Host 1</option>
  	<option value="2">Lake Host 2</option>
	<option value="3">Lake Host 3</option>
    <option value="4">Lake Host 4</option>
</select>
Other: 
<input type ="text" name="LakeHost"/> <br />
</td>
</tr>
<tr>
<td colspan=1>
Lake Host Status: 
</td>
<td>
<select>
  	<option value="Ready">Ready</option>
  	<option value="Not">Not Ready</option>
</select>
</td>
</tr>

</table>

</form>

</body>

<div align="center">

<FORM METHOD="LINK" ACTION="lakeHostHome.php">
<INPUT TYPE="submit" VALUE="BACK">
</FORM>

<FORM METHOD="LINK" ACTION="contactInfo.php">
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