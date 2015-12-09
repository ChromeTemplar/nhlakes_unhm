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
}
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
<h2>Lake Host Under Age 18</h2>
<hr>

<script type="text/javascript"> 

function disable (temp) 
{  
	// Test for a change
	// add a comment
    switch (temp) 
    { 
        case 1    : 
                document.Lake.G_First.disabled = false; 
                document.Lake.G_Last.disabled  = false;  
                document.Lake.G_Relat.disabled = false; 
                document.Lake.G_Street.disabled  = false;
            	document.Lake.G_City.disabled = false; 
                document.Lake.G_State.disabled  = false;  
                document.Lake.G_zip.disabled  = false; 
                document.Lake.G_Phone.disabled  = false; 
                document.Lake.G_Phone2.disabled  = false; 
                document.Lake.G_email.disabled  = false;
                break; 
        case 2    : 
                document.Lake.G_First.disabled = true; 
                document.Lake.G_Last.disabled  = true;  
				document.Lake.G_Relat.disabled = true;
				document.Lake.G_Street.disabled = true;
				document.Lake.G_City.disabled = true;
				document.Lake.G_State.disabled = true;
				document.Lake.G_zip.disabled = true;
				document.Lake.G_Phone.disabled = true;
				document.Lake.G_Phone2.disabled = true;
				document.Lake.G_email.disabled = true;
                break;  
        default    : 
                alert('Hit Ok and Refresh Page');  
    } 
} 

</script> 




<form name="Lake" method="save" action="index.php">
Are You Under the Age of 18? <br />
  Yes <input type="radio" name="radiobutton" value="1" onclick="disable(1);"> 
  No<input type="radio" name="radiobutton" value="2" onclick="disable(2);">  
<table border=10>

<tr>
<td id="G_First" <span </span>
Guardian First Name:  
</td>
<td>
<input type ="text" name="G_First"/> <br />
</td>
</tr>
<tr>
<td id="G_Last" <span </span>
Guardian Last Name: 
</td>
<td>
<input type ="text" name="G_Last"/> <br />
</td>
</tr>
<td id="Relationship" <span </span>
Relationship: 
</td>
<td colspan=3>
<select name="G_Relat">
  	<option value="1">Parent</option>
	<option value="2">Sibling</option>
    <option value="3">Friend</option>
    <option value="4">Other</option>
</select><br />
</td>
<tr>
<td id="G_Street" <span </span> 
Street Address: 
</td>
<td colspan=5>
<input type ="text" name="G_Street" size=50%/> <br />
</td>
</tr>
<tr>
<td id="G_city" <span </span>
City: 
</td>
<td>
<input type ="text" name="G_City"/>
</td>
</tr>
<td id="State:" class="fld alignRight">State <span </span></td>
<td colspan=3>
<select name="G_State" size="1" class="med">
		<option value="??">Select a U.S. State</option>
		<option value="">Outside the U.S.</option>
		<option value="??">--------------------------------------</option>


		<option value="AL">Alabama</option>
		<option value="AK">Alaska</option>
		<option value="AS">American Samoa</option>
		<option value="AZ">Arizona</option>
		<option value="AR">Arkansas</option>
		<option value="CA">California</option>
		<option value="CO">Colorado</option>
		<option value="CT">Connecticut</option>
		<option value="DE">Delaware</option>
		<option value="DC">District of Columbia</option>
		<option value="FL">Florida</option>
		<option value="GA">Georgia</option>
		<option value="GU">Guam</option>
		<option value="HI">Hawaii</option>
		<option value="ID">Idaho</option>
		<option value="IL">Illinois</option>
		<option value="IN">Indiana</option>
		<option value="IA">Iowa</option>
		<option value="KS">Kansas</option>
		<option value="KY">Kentucky</option>
		<option value="LA">Louisiana</option>
		<option value="ME">Maine</option>
		<option value="MD">Maryland</option>
		<option value="MA">Massachusetts</option>
		<option value="MI">Michigan</option>
		<option value="MN">Minnesota</option>
		<option value="MS">Mississippi</option>
		<option value="MO">Missouri</option>
		<option value="MT">Montana</option>
		<option value="NE">Nebraska</option>
		<option value="NV">Nevada</option>
		<option value="NH">New Hampshire</option>
		<option value="NJ">New Jersey</option>
		<option value="NM">New Mexico</option>
		<option value="NY">New York</option>
		<option value="NC">North Carolina</option>
		<option value="ND">North Dakota</option>
		<option value="MP">Northern Mariana Islands</option>
		<option value="OH">Ohio</option>
		<option value="OK">Oklahoma</option>
		<option value="OR">Oregon</option>
		<option value="N/A">Outside U.S.</option>
		<option value="PW">Palau</option>
		<option value="PA">Pennsylvania</option>
		<option value="PR">Puerto Rico</option>
		<option value="RI">Rhode Island</option>
		<option value="SC">South Carolina</option>
		<option value="SD">South Dakota</option>
		<option value="TN">Tennessee</option>
		<option value="TX">Texas</option>
		<option value="UT">Utah</option>
		<option value="VT">Vermont</option>
		<option value="VI">Virgin Island</option>
		<option value="VA">Virginia</option>
		<option value="WA">Washington</option>
		<option value="WV">West Virginia</option>
		<option value="WI">Wisconsin</option>
		<option value="WY">Wyoming</option>
	</select>
</td>
<tr>
<td id="G_zip" <span </span>
Zip Code: 
</td>
<td>
<input type ="text" name="G_zip"/> <br />
</td>
<tr>
<td id="G_phone" <span </span>
Phone Number: 
</td>
<td>
<input type ="text" name="G_Phone"/> <br />
</td>
</tr>
<tr>
<td id="G_phone2" colspan=1>
Alternate Phone Number:  
</td>
<td>
<input type ="text" name="G_Phone2"/> <br />
</td>
</tr>
<tr>
<td id="G_email" <span </span>
Email Address: 
</td>
<td>
<input type ="text" name="G_email"/> <br />
</td>
</tr>






</table>

</form>

</body>


<div align="center">

<FORM METHOD="LINK" ACTION="emergencyContact.php">
<INPUT TYPE="submit" VALUE="BACK">
</FORM>

<FORM METHOD="LINK" ACTION="training.php">
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