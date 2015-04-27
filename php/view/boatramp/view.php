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
    $googleMap="https://www.google.com/maps/embed/v1/place?q=" . $latitude .",". $longitude . "&key=AIzaSyBQ4-bwkv8XTikMZ3772S4nG9w11Q5JL2k";

} else {
    $name = '';
    $state = '';
    $town = '';
    $waterbody = '';
    $longitude = '';
    $latitude = '';
    $owner = '';
    $private = 0;
    $googleMap="";
}
?>


<h1><?php echo $welcome; ?></h1>
<div id="form">    
    <!-- Ramp Name -->
    <label for="rampName">Name</label><br/>
    <div name="rampName"><?php if(isset($ramp)) echo "$name"; ?>
    </div><br/>
    
    <div>
    <iframe
	  width="600"
	  height="450"
	  frameborder="0" style="border:0"
	  src="<?php echo $googleMap?>" >
	</iframe>
    </div><br />
    
    
    <!-- Ramp Owner -->
    <label for="rampOwner">Owner</label><br/>
    <div name="rampOwner"><?php if(isset($ramp)) echo $owner; ?>
    </div><br/>
    
    <!-- Ramp Private -->
    <label for="private">Ramp Access</label><br/>
    <div name="private">
            <?php 
        	if ($private == true) {
                echo "Private - This boat ramp is in private domain. TRESPASSERS WILL BE SHOT. SURVIVORS WILL BE SHOT AGAIN.";
            }
            else {
            	echo "Public - This boat ramp is in public domain.";
            }
        ?> 
    </div><br/>
    
    <!-- Ramp State -->
    <label for="state">State</label><br/>
    <div>
    <?php echo $state; ?>
    </div><br/>
    
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
    <div><?php if(isset($ramp)) echo $ramp['notes'] ?></div>
</div>
<br />
<div class="botViewBtn">
List <?php echo $this->linkTo("boatramp", "index", "Boat Ramps"); ?><br>
Return <?php echo $this->linkTo("home","index","Home"); ?></div>
<br />