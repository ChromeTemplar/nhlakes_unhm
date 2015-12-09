<!-- 
This form will handle New/Edit Waterbody
This form will have the following inputs:
Name
Type
-->
<?php
if (isset($waterbody)) {
    $type = $waterbody['waterType']; }
else
    $type = '';
?>

<div id="waterbody-form">

    <form <?php 
        if (!isset($waterbody))
            echo "action='index.php?rt=waterbody/create' ";
        else 
            echo "action='index.php?rt=waterbody/update&id=".$waterbody['ID']. "'"; ?>
    method="post">

        <!-- Waterbody Name -->
        <label for="waterbodyName">Name</label><br/>
        <input type="text" name="waterbody[name]" class="medium" <?php if (isset($waterbody))echo "value='".$waterbody['name']."'"; ?>><br/><br/>

        <!-- Waterbody Type -->
        <label for="waterbodyType">Type</label><br/>
        <?php echo $this->selectList($types, array("required" => "true", "name" => "waterbody[waterType]", "id" => "waterbody", "class" => "medium selectmenu"),$type); ?><br/><br/>

        <input type="submit" value="Submit">
        <?php echo $this->buttonTo("home","index","Cancel"); ?>
    </form>

</div>
