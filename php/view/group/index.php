<h1><?php echo $welcome; ?></h1>


<h2> Please Select a Group. </h2>

<select id="groupID" required>
  <option disabled>----- Select Group -----</option>
  <?php
  	for($i=0; $i<count($lakeHostGroup); $i++)
  	{
    	foreach($lakeHostGroup as $key->$val){
  			echo "<option value=".$i.">".$val."</option>";
    	}
  	}
  ?>
</select><br/><br/>

<script>
function doThis(){
	var groupID=document.getElementById('groupID').value;
	window.location='index.php?rt=group/displayGroup&id=' + groupID;
}
</script>

<button class="button" title="Select" onClick="doThis()">Select Group</button>
<?php echo $this->buttonTo("group","newgroup", "New Group"); ?><br/><br/>

Return <?php echo $this->linkTo("home","index","Home"); ?>