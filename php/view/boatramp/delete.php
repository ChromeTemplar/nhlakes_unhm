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
} else {
    $name = '';
    $state = '';
    $town = '';
    $waterbody = '';
    $longitude = '';
    $latitude = '';
    $owner = '';
    $private = 0;
}
?>

<h1><?php echo $welcome; ?></h1>

<div id="form">

<form id="boatRampForm" <?php 
    if (!isset($ramp))
        echo "action='index.php?rt=boatramp/index' ";
    else 
        echo "action='index.php?rt=boatramp/deleteRamp&id=".$ramp['ID']. "'"; ?>
method="post">
	    <div class="warning">Are you sure you want to delete this Boat Ramp?</div>
     <br />
    <!-- Ramp Name -->
    <label for="rampName">Name</label><br/>
    <div name="rampName"><?php if(isset($ramp)) echo "$name"; ?></label><br/><br/>

    <!-- Ramp Longitude -->
    <label for="rampLongitude">Longitude</label><br/>
    <div name="rampLongitude"><?php if(isset($ramp)) echo $longitude; ?></div></div><br/>
    
    <!-- Ramp Latitude -->
    <label for="rampLatitude">Latitude</label><br/>
    <div name="rampLatitude"><?php if(isset($ramp)) echo $latitude; ?> </div><br/>
    
    <!-- Ramp Owner -->
    <label for="rampOwner">Owner</label><br/>
    <div name="rampOwner"><?php if(isset($ramp)) echo $owner; ?></div><br/>
    
    <!-- Ramp Private -->
    <label>Ramp Access</label><br/>
    <div name="private">
            <?php 
        	if ($private == true) {
                echo "Private - This boat ramp is in private domain. TRESPASSERS WILL BE SHOT. SURVIVORS WILL BE SHOT AGAIN.";
            }
            else {
            	echo "Public - This boat ramp is in public domain.";
            }
        ?> 
    </div>
    <br/>
    
    <!-- Ramp State -->
    <label for="state">State</label><br/>
    <?php echo $state; ?>
    <br/><br/>
    
    <!-- Ramp Town -->
    <label for="town">Town</label><br/>
    <div>
    <?php foreach ($towns as $val) {
    	if($val[0] == $town)
    	{
    		echo $val[1];
    	}
    }?>
    </div>
   <br/>
    
    <!-- Ramp Waterbody -->
    <label for="waterbody">Waterbody</label><br/>
    <div>
        <?php foreach ($waterbodies as $val) {
    	if($val[0] == $waterbody)
    	{
    		echo $val[1];
    	}
    }?>
    </div>
    <br />
    
    <!-- Ramp Notes-->
    <label for="notes">Notes</label><br/>
    <div><?php if(isset($ramp)) echo $ramp['notes'] ?></div><br/><br/>
        
    <input type="submit" value="Delete" name="delete">
    <?php echo $this->buttonTo("home","index","Cancel"); ?>
</form>
</div>
<br />
<div class="botViewBtn">
List <?php echo $this->linkTo("boatramp", "index", "Boat Ramps"); ?><br>
Return <?php echo $this->linkTo("home","index","Home"); ?></div>
<br />