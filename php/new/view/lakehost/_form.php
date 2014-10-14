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