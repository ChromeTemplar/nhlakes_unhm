<!-- This form will handle New/Edit BoatRamp associated with a waterbody. 
In order to do this, the waterbody must be created first.
This Form will have the following inputs:
Name
Waterbody
Town
State
Notes
Latitude (For future use)
Longitude (For future use)
-->

<form action="index.php?rt=boatRamp/create" method="post">
    
    <!-- Ramp Name -->
    <label for="rampName">Name</label><br/>
    <input type="text" name="ramp[Name]" class="medium"><br/><br/>
    
    <!-- Ramp State -->
    <label for="state">State</label><br/>
    <?php echo $this->selectList($states, array("name" => "ramp[State]", "id" => "state", "class" => "medium selectmenu")); ?>
    <br/><br/>
    
    <!-- Ramp Town -->
    <label for="town">Town</label><br/>
    <?php echo $this->selectList($towns, array("name" => "ramp[TownID]","id" => "town", "class" => "medium selectmenu", "id" => "towns")); ?>
    <br/><br/>
    
    <!-- Ramp Waterbody -->
    <label for="waterbody">Waterbody</label><br/>
    <?php echo $this->selectList($waterbodies, array("name" => "ramp[WaterbodyID]", "id" => "waterbody", "class" => "medium selectmenu"),'', true); ?>
    <br/><br/>
    
    <!-- Ramp Notes-->
    <label for="notes">Notes</label><br/>
    <textarea name="ramp[Notes]" rows="4" cols="50"></textarea><br/><br/>
    
    <input type="submit" value="Submit">
    <?php echo $this->buttonTo("home","index","Cancel"); ?>
</form>