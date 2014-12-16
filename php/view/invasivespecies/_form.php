<!-- This form will create new suspected invasive species finds and edit existing finds.

This Form will have the following inputs:
ID - AutoIncrement
userID
boatRampID
summaryID
name
dateCreated - Timestamp
surveyDate
launchStatus
registrationState
boatType
previousInteraction
lastSiteVisited
lastTownVisited
lastStateVisited
drained
rinsed
dryForFiveDays
boaterAwareness
bowNumber
licensePlateNumber
sentToDES
notes
active
desResult
desNotes
desSave
-->





<?php
if (isset($InvasiveSurvey)) {
   // $userID = $InvasiveSurvey['userID'];                  Works when Data is entered into database
   // $boatRampID = $InvasiveSurvey['boatRampID'];
   // $summaryID = $InvasiveSurvey['summaryID'];
    $name = $InvasiveSurvey['name'];
    $surveyDate = $InvasiveSurvey['surveyDate'];
    $launchStatus = $InvasiveSurvey['launchStatus'];
    $registrationState = $InvasiveSurvey['registrationState'];
    $boatType = $InvasiveSurvey['boatType'];
    $previousInteraction = $InvasiveSurvey['previousInteraction'];
    $lastSiteVisted = $InvasiveSurvey['lastSiteVisted'];
    $lastTownVisted = $InvasiveSurvey['lastTownVisted'];
    $lastStateVisted = $InvasiveSurvey['LastStateVisted'];
    $drained = $InvasiveSurvey['drained'];
    $rinsed = $InvasiveSurvey['rinsed'];
    $dryForFiveDays = $InvasiveSurvey['dryForFiveDays'];
    $boaterAwareness = $InvasiveSurvey['boaterAwareness'];
    $sentToDES = $InvasiveSurvey['sentToDES'];
    $bowNumber = $InvasiveSurvey['bowNumber'];
    $licensePlateNumber = $InvasiveSurvey['licensePlateNumber'];
    $active = $InvasiveSurvey['active'];
    $notes = $InvasiveSurvey['notes'];
    $desResult = $InvasiveSurvey['desResult'];
    $desNotes = $InvasiveSurvey['desNotes'];
    $desSave = $InvasiveSurvey['desSave'];
    
} else {

    
    // $userID = '';        See Above
    // $boatRampID = '';
    // $summaryID = '';
    $name = '';
    $surveyDate = '';
    $launchStatus = '';
    $registrationState = '';
    $boatType = '';
    $previousInteraction = '';
    $lastTownVisted = '';
    $lastStateVisted = '';
    $drained = '';;
    $rinsed = '';
    $dryForFiveDays = '';
    $boaterAwareness = '';
    $sentToDES = '';
    $bowNumber = '';
    $licensePlateNumber = '';
    $active = '';
    $notes = '';
    $desResult = '';
    $desNotes = '';
    $desSave = '';
    
}
?>

<form id="invasivespeciesForm" <?php 
    if (!isset($invasivespecies))
        echo "action='index.php?rt=invasivespecies/create' ";
    else 
        echo "action='index.php?rt=invasivespecies/update&id=".$invasivespecies['ID']. "'"; ?>
method="post">


    <!-- UserID -->
    <!--<label for="userID">UserID</label><br/>
    <input type="text" name="InvasiveSurvey[userID]" class="medium" > -->
    <?php // if(isset($InvasiveSurvey)) echo "value='$userID'"; ?>
   
       
    
    <!-- This should eventually populate a drop down list from the available
    boat ramps stored in the data base-->
    
    <!-- BoatRamp -->
   <!-- <label for="boatRampID">Boat Ramp ID</label><br/>
    <input type="text" name="InvasiveSurvey[boatRampID]" class="medium"> -->
    <?php // if(isset($InvasiveSurvey)) echo "value='$boatRampID'"; ?>
  
    
 
    
    <!-- This should populate automatically from the survey summary form. As of now 
    it needs to be manually entered. -->
    
    <!-- Summary ID -->
    <!-- <label for="Name">Summary ID <BR> <small>(Of person who took the survey)</label><br/>
    <input type="text" name="InvasiveSurvey[summaryID]" class="medium" > -->
    <?php // if(isset($InvasiveSurvey)) echo "value='$summaryID'"; ?>
    
   
    <BR>
    <BR>
    <!-- This should be the name of the person who took the survey
        not the person who is entering survey into the system's
    -->
    
    <!-- Name -->
    <label for="Name">Name <BR> <small>(Of person who took the survey)</small></label><br/>
    <input type="text" name="InvasiveSurvey[name]" class="medium" >
    <?php if(isset($InvasiveSurvey)) echo "value='$name'"; ?>

    <BR>
    <BR>
    
 
    <!-- This should be the date the actual survey was taken. The implementation of the results to the 
    survey will be timestamped by the database.
    -->
    
    
    <!-- SurveyDate -->
    <label for="surveyDate">Date<small> (of incident)</small>
    </label><br/>
    <input type="text" name="InvasiveSurvey[surveyDate]" class="medium">
    <?php if(isset($InvasiveSurvey)) echo "value='$surveyDate'"; ?>
 
    <BR>
    <small>Note: Date must be entered as YYYY-MM-DD</small>
   
    
    
    <br/><br/>
    
    <!-- LaunchStatus -->
    <label for="launchStatus">Launch Status</label><br/>
	<input type="checkbox" name="InvasiveSurvey[launchStatus]" value="1">Launched<br>
        <?php if(isset($InvasiveSurvey)) echo "value='$launchStatus'"; ?>
       
	<input type="checkbox" name="InvasiveSurvey[launchStatus]" value="0">Retrieved<br>
	
    <BR>
    
    <!-- RegistrationState -->
    <label for="registrationState">What state registration of the boat?</label><br/>
	<input type="text" name="InvasiveSurvey[registrationState]" class="medium"><br/><br/>
       <?php if(isset($InvasiveSurvey)) echo "value='$registrationState'"; ?>
        <BR>
        <BR>
         
    <!-- BoatType -->
    <label for="boatType">Type of Boat</label><br/>
	
	<input type="checkbox" name="InvasiveSurvey[boatType]"
        <?php if(isset($InvasiveSurvey)) echo "value='$boatType'"; ?>
	value="Inboard/Outboard">Inboard/Outboard<br>

	<input type="checkbox" name="InvasiveSurvey[boatType]" 
        
	value="PWC/Jet/Ski/JetBoat">PWC/JetSki/JetBoat<br>
	
	<input type="checkbox" name="InvasiveSurvey[boatType]" 
        
	value="Kayak/Canoe">Kayak/Canoe<br>
	
	
	<input type="checkbox" name="InvasiveSurvey[boatType]" 
        
	value="Sail">Sail<br>
	
	<input type="checkbox" name="InvasiveSurvey[boatType]" 
       
	value="Other">Other<br>

	<BR>
        
        
    <!-- PreviousInteraction -->
        <label for="previousInteraction">Did the Boater have any Previous Interaction with NH Lakes?</label><br/>
	<input type="checkbox" name="InvasiveSurvey[previousInteraction]" 
	<?php if(isset($InvasiveSurvey)) echo "value='$previousInteraction'"; ?>
	value="1">Yes<br>
	
	<input type="checkbox" name="InvasiveSurvey[previousInteraction]" 
	
	value="0">No<br>
	
	<BR>
    

    
    <!-- LastSiteVisted -->
    <label for="LastTownVisted">Name of the Last Site Visted</label><br/>
    <input type="text" name="InvasiveSurvey[lastTownVisted]" class="medium" ><br/><br/>
    <?php if(isset($InvasiveSurvey)) echo "value='$lastTownVisted'"; ?>
        <BR>
    
 
    
    <!-- LastTownVisted -->
    <label for="lastSiteVisted">Name of the Last Town Visted</label><br/>
	<input type="text" name="InvasiveSurvey[lastSiteVisted]" class="medium"><br/><br/>
	<?php if(isset($InvasiveSurvey)) echo "value='$lastSiteVisted'"; ?>
	<BR>
	
    <!-- LastStateVisted -->
    <label for="lastStateVisted">Name of the Last State Visted</label><br/>
	<input type="text" name="InvasiveSurvey[lastStateVisted]" class="medium"><br/><br/>
        <?php if(isset($InvasiveSurvey)) echo "value='$lastStateVisted'"; ?>
    <!-- Drained -->
    <label for="drained">Was the boat drained?</label><br/>
	<input type="checkbox" name="InvasiveSurvey[drained]"
	<?php if(isset($InvasiveSurvey)) echo "value='$drained'"; ?>
	 value="1">Yes<br>
	
	<input type="checkbox" name="InvasiveSurvey[drained]" 
	
	value="0">No<br>
	
	<BR>
    
    <!-- Rinsed -->
    <label for="rinsed">Was the boat rinsed?</label><br/>
	<input type="checkbox" name="InvasiveSurvey[rinsed]" 
	<?php if(isset($InvasiveSurvey)) echo "value='$rinsed'"; ?>
	value="1">Yes<br>
	
	<input type="checkbox" name="InvasiveSurvey[rinsed]" 
	
	value="0">No<br>
	
	
	<BR>
    <!-- DryForFiveDays -->
    <label for="dryForFiveDays">Has the boat been dry for five days?</label><br/>
	<input type="checkbox" name="InvasiveSurvey[dryForFiveDays]"
	<?php if(isset($InvasiveSurvey)) echo "value='$dryForFiveDays'"; ?>
	value="1">Yes<br>
	
	<input type="checkbox" name="InvasiveSurvey[dryForFiveDays]"
	
	value="0">No<br>
	
	<BR>
        
    <!-- Boater Awareness -->
    <label for="boaterAwareness">Type of Boat</label><br/>
	
	<input type="checkbox" name="InvasiveSurvey[boaterAwareness]" 
	<?php if(isset($InvasiveSurvey)) echo "value='$boaterAwareness'"; ?>
	value="High">High<br>

	<input type="checkbox" name="InvasiveSurvey[boaterAwareness]" 
	
	value="Medium">Low<br>
	
	<input type="checkbox" name="InvasiveSurvey[boaterAwareness]" 
	
	value="Low">Low<br>
        
        
    <!-- BowNumber -->
    <label for="bowNumber">Bow Number</label><br/>
	<input type="text" name="InvasiveSurvey[bowNumber]" class="medium"><br/><br/>
        <?php if(isset($InvasiveSurvey)) echo "value='$bowNumber'"; ?>
        
        <BR>
     
    <!-- License Plate Number -->
    <label for="bowNumber">License Plate</label><br/>
	<input type="text" name="InvasiveSurvey[licensePlateNumber]" class="medium"><br/><br/>
        <?php if(isset($InvasiveSurvey)) echo "value='$licensePlateNumber'"; ?>
        
        <BR>
        
    <!-- sentToDES -->
    <label for="sentToDES">Was the specimen sent to DES?</label><br/>
	<input type="checkbox" name="InvasiveSurvey[sentToDES]"
	<?php if(isset($InvasiveSurvey)) echo "value='$sentToDES'"; ?>
	value="1">Yes<br>
	
	<input type="checkbox" name="InvasiveSurvey[sentToDES]" 
	
	value="0">No<br>
	
	<BR>
    <!-- Notes -->
    <label for="notes">Notes</label><br/>
	<input type="text" name="InvasiveSurvey[notes]" class="medium"><br/><br/>
        <?php if(isset($InvasiveSurvey)) echo "value='$notes'"; ?>
        
	<BR>
	
	<!-- Active -->
	<label for="active">Status of Find</label><br/>
	<input type="checkbox" name="InvasiveSurvey[active]" 
	<?php if(isset($InvasiveSurvey)) echo "value='$active'"; ?>
	value="1">Active<br>
	
	
	<input type="checkbox" name="InvasiveSurvey[active]" 
	
	value="0">Not Active<br>
	
	<BR>

        <!-- Des Result -->
        <label for="desResult">Did DES confirm an Invasive Species was found?</label><br/>
        <input type="checkbox" name="InvasiveSurvey[desResult]" 
        <?php if(isset($InvasiveSurvey)) echo "value='$desResult'"; ?>
        value="1">Confirmed<br>
        
        <input type="checkbox" name="InvasiveSurvey[desResult]" 
          
        value="0">Not Confirmed<br>
        
        <BR>
    
    
        <!-- DES Notes-->
        <label for="desNotes">Transcribe any DES Notes</label><br/>
        <textarea name="InvasiveSurvey[desNotes]" rows="4" cols="50"></textarea><br/><br/>
        <?php if(isset($InvasiveSurvey)) echo "value='$desNotes'"; ?>
    
        <BR>
    
        <!-- Des Save -->
        <label for="desSave">Did DES confirm this as a Save?</label><br/>
        <input type="checkbox" name="InvasiveSurvey[desSave]" 
        <?php if(isset($InvasiveSurvey)) echo "value='$desSave'"; ?>
        value="1">Save<br>
        
        <input type="checkbox" name="InvasiveSurvey[desSave]" 
       
        value="0">No Save<br>
        
    <BR>
    
    
    
    <input type="submit" value="Submit">
    
    <?php echo $this->buttonTo("home","index","Cancel"); ?>
    
    </form>