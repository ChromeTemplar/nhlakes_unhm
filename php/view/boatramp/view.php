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
    <!-- Ramp Name -->
    <label>Ramp Name</label><br/>
    <div><?php if(isset($ramp)) echo "$name"; ?>
    </div><br/>
       
    <!-- Ramp Owner -->
    <label for="rampOwner">Owner</label><br/>
    <div><?php if(isset($ramp)) echo $owner; ?>
    </div><br/>
    
    <!-- Ramp Private -->
    <label for="private">Ramp Access</label><br/>
    <div>
	   <?php 
			if ($private == true) { echo "Private - This boat ramp is in private domain. TRESPASSERS WILL BE SHOT. SURVIVORS WILL BE SHOT AGAIN."; }
			else { echo "Public - This boat ramp is in public domain."; }
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
    
    <div>
 	    <label>Location</label><br/>
 	    <div><?php echo $latitude ?>, <?php echo $longitude ?></div>
		<div id="map-canvas">
			<script>
				// setup google map.
				nhvbsrMap.edit = false; // give the map the id
				nhvbsrMap.latitudeID = 'latitude'; // give the map the id
				nhvbsrMap.longitudeID = 'longitude';
				nhvbsrMap.latitude = <?php echo $latitude ?>;
				nhvbsrMap.longitude = <?php echo $longitude ?>;
				nhvbsrMap.mapID = 'map-canvas',
				google.maps.event.addDomListener(window, 'load', nhvbsrMap.initialize);
			</script>  	
	   	</div>
    </div>
    <br />
    
    <!-- Ramp Notes-->
    <label for="notes">Notes</label><br/>
    <div><?php if(isset($ramp)) echo $ramp['notes'] ?></div>
</div>
<div id="content-bottom">
List <?php echo $this->linkTo("boatramp", "index", "Boat Ramps"); ?><br>
Return <?php echo $this->linkTo("home","index","Home"); ?>
</div>
<br />