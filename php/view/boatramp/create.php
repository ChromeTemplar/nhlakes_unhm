<!-- This form will handle Create BoatRamp associated with a waterbody. 
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
    $latitude = '42.9869';
    $longitude = '-71.4686';
    $owner = '';
    $private = 0;
}

$googleMap="https://www.google.com/maps/embed/v1/place?q=" . $latitude .",". $longitude . "&key=AIzaSyBQ4-bwkv8XTikMZ3772S4nG9w11Q5JL2k";

?>
<h1><?php echo $welcome; ?></h1>

<div id="form">
		
<form id="boatRampForm" action="index.php?rt=boatramp/create" method="post"> 
   
   	<?php if(isset($errorOccured) && $errorOccured) { ?>
   	<!-- Error Message -->
	<label id="errorMessage" class="generalError">
	<?php	echo $errorMessage; ?>	
	</label>
	<?php } ?>
	
	<!-- Ramp Name -->
    <label for="rampName">Ramp Name</label><br/>
    <input type="text" name="ramp[name]" class="medium" <?php if(isset($ramp)) echo "value='$name'"; ?> ><br/><br/>
    
    <!-- Ramp Owner -->
    <label for="rampOwner">Owner</label><br/>
    <input type="text" name="ramp[owner]" class="medium" <?php if(isset($ramp)) echo "value='$owner'"; ?> ><br/><br/>
    
    <!-- Ramp Access -->
    <label for="private">Ramp Access</label><br />
    <input type="radio" name="ramp[private]" value="0" <?php if ($private == 0) { echo "checked"; } ?> 
    >public<br />
    <input type="radio" name="ramp[private]" value="1" <?php if ($private == 1) { echo "checked"; } ?>
    >private<br>
    <br/>

    <div class="coordinates">
    	<div class="latitude">
			<!-- Ramp Latitude -->
			<label for="rampLatitude">Latitude</label><br/>
			<input type="text" id="latitude" name="ramp[latitude]" class="medium" <?php if(isset($ramp)) echo "value='$latitude'"; ?> >
    	</div>
    	<div class="longitude">
    		<!-- Ramp Longitude -->
  			<label for="rampLongitude">Longitude</label><br/>
			<input type="text" id="longitude" name="ramp[longitude]" class="medium" <?php if(isset($ramp)) echo "value='$longitude'"; ?>>
    	</div>
    	<div class="nhvbsrMapBtn">
    		<input type="button" value="Lookup coorinates" onclick="nhvbsrMap.codeLatLng()">
    	</div>
    </div>
	<div id="map-canvas">
		<script>
			// setup google map.
			nhvbsrMap.edit = true; // give the map the id
			nhvbsrMap.latitudeID = 'latitude'; // give the map the id
			nhvbsrMap.longitudeID = 'longitude';
			nhvbsrMap.latitude = <?php echo $latitude ?>;
			nhvbsrMap.longitude = <?php echo $longitude ?>;
			nhvbsrMap.mapID = 'map-canvas',
			google.maps.event.addDomListener(window, 'load', nhvbsrMap.initialize);
		</script>  	
   	</div>
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
    
    
    <input type="submit" name="create" value="Submit">
    <?php echo $this->buttonTo("home","index","Cancel"); ?>
</form>
</div>

List <?php echo $this->linkTo("boatramp", "index", "Boat Ramps"); ?><br>
