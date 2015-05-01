<h1><?php echo $welcome; ?></h1>

<form id="lakeHostGroup" action="index.php?rt=group/create" method="post">
	
	<label for="lakeHostGroupName">Group Name:</label><br/>
    <input type="text" name="lakeHostGroup[lakeHostGroupName]" class="medium" maxlength="25" required><br/><br/>
	
	<label for="notes">Notes:</label><br/>
	<textarea name="lakeHostGroup[notes]" maxlength="100" rows="3" cols="23" placeholder="(optional)"></textarea><br/><br/>
    
    <input type="submit" value="Submit">
    
    <a href='index.php?rt=home/index'><input type='button' value='Cancel'></a>
</form>

<?php echo $this->linkTo("group", "index", "Back to Groups"); ?><br/>