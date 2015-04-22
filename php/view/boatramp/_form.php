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
owner (For future use)
-->
<?php
if (isset($ramp)) {
    $name = $ramp['name'];
    $longitude = $ramp['longitude'];
    $latitude = $ramp['latitude'];
    $state = $ramp['state'];
    $town = $ramp['townID'];
    $owner = $ramp['owner'];
    $private = $ramp['private'];
    $waterbody = $ramp['waterbodyID'];
    $owner = $ramp['owner'];
    $private = $ramp['private'];
} else {
    $name = '';
    $state = '';
    $town = '';
    $waterbody = '';
    $longitude = '';
    $latitude = '';
    $owner = '';
    $private = false;
}
?>

<form id="boatRampForm" <?php 
    if (!isset($ramp))
        echo "action='index.php?rt=boatramp/create' ";
    else 
        echo "action='index.php?rt=boatramp/update&id=".$ramp['ID']. "'"; ?>
method="post">
    
    <!-- Ramp Name -->
    <label for="rampName">Name</label><br/>
    <input type="text" name="ramp[name]" class="medium" <?php if(isset($ramp)) echo "value='$name'"; ?> ><br/><br/>

    <!-- Ramp Longitude -->
    <label for="rampLongitude">Longitude</label><br/>
    <input type="text" name="ramp[longitude]" class="medium" <?php if(isset($ramp)) echo "value='$longitude'"; ?> ><br/><br/>
    
    <!-- Ramp Latitude -->
    <label for="rampLatitude">Latitude</label><br/>
    <input type="text" name="ramp[latitude]" class="medium" <?php if(isset($ramp)) echo "value='$latitude'"; ?> ><br/><br/>
    
    <!-- Ramp Owner -->
    <label for="rampOwner">Owner</label><br/>
    <input type="text" name="ramp[owner]" class="medium" <?php if(isset($ramp)) echo "value='$owner'"; ?> ><br/><br/>
    
    <!-- Ramp Private -->
    <label for="private">General public or is a private ramp?</label><br/>
    <input type="radio" name="ramp[private]" value="1"
        <?php 
            if(isset($ramp)) {
                if ($private == 1) {
                    echo " checked";
                }
            }
        ?> 
    >public<br>

    <input type="radio" name="boatramp[private]" value="0"
        <?php 
            if(isset($boatramp)) {
                if ($private == 0) {
                    echo " checked";
                }
            }
        ?>
    >private<br>

    <br/>
    
    <!-- Ramp State -->
    <label for="state">State</label><br/>
    <?php echo $this->selectList($states, array("name" => "ramp[state]", "id" => "state", "class" => "medium selectmenu"),$state); ?>
    <br/><br/>
    
    <!-- Ramp Town -->
    <label for="town">Town</label><br/>
    <?php echo $this->selectList($towns, array("name" => "ramp[townID]","id" => "town", "class" => "medium selectmenu", "id" => "towns"),$town, true); ?>
    <br/><br/>
    
    <!-- Ramp Waterbody -->
    <label for="waterbody">Waterbody</label><br/>
    <?php echo $this->selectList($waterbodies, array("name" => "ramp[waterbodyID]", "id" => "waterbodies", "class" => "medium selectmenu"),$waterbody, true); ?>
    <br/><br/>
    
    <!-- Ramp Notes-->
    <label for="notes">Notes</label><br/>
    <textarea name="ramp[notes]" rows="4" cols="25"><?php if(isset($ramp)) echo $ramp['notes'] ?></textarea><br/><br/>
    
    
    <input type="submit" value="Submit">
    <?php echo $this->buttonTo("home","index","Cancel"); ?>
</form>