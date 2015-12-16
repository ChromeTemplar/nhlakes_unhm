<h1><?php
    include __SITE_PATH . '/model/' . 'group.php';
    echo $welcome; ?></h1>

<h2> Please Select a Group. </h2>

<?php
/* OLD CODE FOR DROP DOWN
<select id="groupID" required>
<option disabled>----- Select Group -----</option>
*/

$model = new group();
echo $model->dropDownto();

/* OLD CODE FOR DROP DOWN
    for($i=0; $i<count($lakeHostGroup); $i++)
    {
    foreach($groupArray as $id => $group) {
           echo "<option value=$id>$group</option>\n";
          }
    }
*/
?>
</select><br/><br/>

<?php //Javascript function to direct page to selected group ?>
<script>
    function doThis() {
        var groupID = document.getElementById('groupID').value;
        window.location = 'index.php?rt=group/displayGroup&id=' + groupID;
    }
</script>

<button title="Select" onClick="doThis()">Select Group</button>
<?php echo $this->buttonTo("group", "newgroup", "New Group"); ?><br/><br/>

Return <?php echo $this->linkTo("home", "index", "Home"); ?>