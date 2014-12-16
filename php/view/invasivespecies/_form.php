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
if (isset($invasiveSpecies)) {
   // $userID = $InvasiveSurvey['userID'];                  Works when Data is entered into database
   // $boatRampID = $InvasiveSurvey['boatRampID'];
   // $summaryID = $InvasiveSurvey['summaryID'];
    $name = $invasiveSpecies['name'];
    $surveyDate = $invasiveSpecies['surveyDate'];
    $launchStatus = $invasiveSpecies['launchStatus'];
    $registrationState = $invasiveSpecies['registrationState'];
    $boatType = $invasiveSpecies['boatType'];
    $previousInteraction = $invasiveSpecies['previousInteraction'];
    $lastSiteVisted = $invasiveSpecies['lastSiteVisited'];
    $lastTownVisted = $invasiveSpecies['lastTownVisited'];
    $lastStateVisted = $invasiveSpecies['lastStateVisited'];
    $drained = $invasiveSpecies['drained'];
    $rinsed = $invasiveSpecies['rinsed'];
    $dryForFiveDays = $invasiveSpecies['dryForFiveDays'];
    $boaterAwareness = $invasiveSpecies['boaterAwareness'];
    $sentToDES = $invasiveSpecies['sentToDES'];
    $bowNumber = $invasiveSpecies['bowNumber'];
    $licensePlateNumber = $invasiveSpecies['licensePlateNumber'];
    $active = $invasiveSpecies['active'];
    $notes = $invasiveSpecies['notes'];
    $desResult = $invasiveSpecies['desResult'];
    $desNotes = $invasiveSpecies['desNotes'];
    $desSave = $invasiveSpecies['desSave'];
    
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
    <input type="text" name="InvasiveSurvey[name]" class="medium" 
        <?php if(isset($invasiveSpecies)) echo "value='$name'"; ?>
    >
    

    <BR>
    <BR>
    
 
    <!-- This should be the date the actual survey was taken. The implementation of the results to the 
    survey will be timestamped by the database.
    -->
    
    
    <!-- SurveyDate -->
    <label for="surveyDate">Date<small> (of incident)</small>
    </label><br/>
    <input type="text" name="InvasiveSurvey[surveyDate]" class="medium"
        <?php if(isset($invasiveSpecies)) echo "value='$surveyDate'"; ?>
    >
    
 
    <BR>
    <small>Note: Date must be entered as YYYY-MM-DD</small>
   
    
    
    <br/><br/>
    
    <!-- LaunchStatus -->
    <label for="launchStatus">Launch Status</label><br/>
    <input type="radio" name="InvasiveSurvey[launchStatus]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($launchStatus == 1) {
                    echo " checked";
                }
            }
        ?>  
    >Launched<br>
    <input type="radio" name="InvasiveSurvey[launchStatus]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($launchStatus == 0) {
                    echo " checked";
                }
            }
        ?>       
    >Retrieved<br>
	
    <BR>
    
    <!-- RegistrationState -->
    <label for="registrationState">What state registration of the boat?</label><br/>
    <input type="text" name="InvasiveSurvey[registrationState]" class="medium"
        <?php if(isset($invasiveSpecies)) echo "value='$registrationState'"; ?>
    ><br/><br/>

    <BR>
    <BR>
         
    <!-- BoatType -->
    <label for="boatType">Type of Boat</label><br/>
	
    <input type="radio" name="InvasiveSurvey[boatType]" value="Inboard/Outboard"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($boatType == "Inboard/Outboard") {
                    echo " checked";
                }
            }
        ?>
    >Inboard/Outboard<br>

    <input type="radio" name="InvasiveSurvey[boatType]" value="PWC/Jet/Ski/JetBoat"
         <?php 
            if(isset($invasiveSpecies)) {
                if ($boatType == "PWC/Jet/Ski/JetBoat") {
                    echo " checked";
                }
            }
        ?>  
    >PWC/JetSki/JetBoat<br>

    <input type="radio" name="InvasiveSurvey[boatType]" value="Kayak/Canoe"
         <?php 
            if(isset($invasiveSpecies)) {
                if ($boatType == "Kayak/Canoe") {
                    echo " checked";
                }
            }
        ?>  
    >Kayak/Canoe<br>

    <input type="radio" name="InvasiveSurvey[boatType]" value="Sail"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($boatType == "Sail") {
                    echo " checked";
                }
            }
        ?>   
    >Sail<br>

    <input type="radio" name="InvasiveSurvey[boatType]" value="Other"
          <?php 
            if(isset($invasiveSpecies)) {
                if ($boatType == "Other") {
                    echo " checked";
                }
            }
        ?> 
    >Other<br>

    <BR>
        
        
    <!-- PreviousInteraction -->
    <label for="previousInteraction">Did the Boater have any Previous Interaction with NH Lakes?</label><br/>
    <input type="radio" name="InvasiveSurvey[previousInteraction]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($previousInteraction == 1) {
                    echo " checked";
                }
            }
        ?>
    >Yes<br>

    <input type="radio" name="InvasiveSurvey[previousInteraction]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($previousInteraction == 0) {
                    echo " checked";
                }
            }
        ?>
    >No<br>

    <BR>
    

    
    <!-- LastSiteVisted -->
    <label for="LastTownVisted">Name of the Last Site Visted</label><br/>
    <input type="text" name="InvasiveSurvey[lastTownVisited]" class="medium" 
        <?php if(isset($invasiveSpecies)) echo "value='$lastTownVisted'"; ?>
    ><br/><br/>
    
    <BR>
    
 
    
    <!-- LastTownVisted -->
    <label for="lastSiteVisted">Name of the Last Town Visted</label><br/>
    <input type="text" name="InvasiveSurvey[lastSiteVisited]" class="medium"
        <?php if(isset($invasiveSpecies)) echo "value='$lastSiteVisted'"; ?>
    ><br/><br/>
    <BR>
	
    <!-- LastStateVisted -->
    <label for="lastStateVisted">Name of the Last State Visted</label><br/>
    <input type="text" name="InvasiveSurvey[lastStateVisited]" class="medium"
        <?php if(isset($invasiveSpecies)) echo "value='$lastStateVisted'"; ?>       
    ><br/><br/>
        
    <!-- Drained -->
    <label for="drained">Was the boat drained?</label><br/>
    <input type="radio" name="InvasiveSurvey[drained]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($drained == 1) {
                    echo " checked";
                }
            }
        ?> 
    >Yes<br>

    <input type="radio" name="InvasiveSurvey[drained]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($drained == 0) {
                    echo " checked";
                }
            }
        ?>
    >No<br>

    <br/>
        
        
    
    <!-- Rinsed -->
    <label for="rinsed">Was the boat rinsed?</label><br/>
    <input type="radio" name="InvasiveSurvey[rinsed]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($rinsed == 1) {
                    echo " checked";
                }
            }
        ?>
    >Yes<br>

    <input type="radio" name="InvasiveSurvey[rinsed]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($rinsed == 0) {
                    echo " checked";
                }
            }
        ?>
    >No<br>


    <br/>
    
    
    
    <!-- DryForFiveDays -->
    <label for="dryForFiveDays">Has the boat been dry for five days?</label><br/>
    <input type="radio" name="InvasiveSurvey[dryForFiveDays]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($dryForFiveDays == 1) {
                    echo " checked";
                }
            }
        ?>  
    >Yes<br>

    <input type="radio" name="InvasiveSurvey[dryForFiveDays]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($dryForFiveDays == 0) {
                    echo " checked";
                }
            }
        ?>
    >No<br>

    <br/>
    
    
        
    <!-- Boater Awareness -->
    <label for="boaterAwareness">Type of Boat</label><br/>
	
    <input type="radio" name="InvasiveSurvey[boaterAwareness]" value="High"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($boaterAwareness == "High") {
                    echo " checked";
                }
            }
        ?>
    >High<br>

    <input type="radio" name="InvasiveSurvey[boaterAwareness]" value="Medium"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($boaterAwareness == "Medium") {
                    echo " checked";
                }
            }
        ?>
    >Medium<br>

    <input type="radio" name="InvasiveSurvey[boaterAwareness]" value="Low"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($boaterAwareness == "Low") {
                    echo " checked";
                }
            }
        ?>
    >Low<br>
    
    <br/>
        
        
    <!-- BowNumber -->
    <label for="bowNumber">Bow Number</label><br/>
	<input type="text" name="InvasiveSurvey[bowNumber]" class="medium"
            <?php if(isset($invasiveSpecies)) echo "value='$bowNumber'"; ?>
        ><br/><br/>
        
        
        <BR>
     
    <!-- License Plate Number -->
    <label for="bowNumber">License Plate</label><br/>
	<input type="text" name="InvasiveSurvey[licensePlateNumber]" class="medium"
            <?php if(isset($invasiveSpecies)) echo "value='$licensePlateNumber'"; ?>       
        ><br/><br/>        
        <BR>
        
    <!-- sentToDES -->
    <label for="sentToDES">Was the specimen sent to DES?</label><br/>
    <input type="radio" name="InvasiveSurvey[sentToDES]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($sentToDES == 1) {
                    echo " checked";
                }
            }
        ?>       
    >Yes<br>
	
    <input type="radio" name="InvasiveSurvey[sentToDES]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($sentToDES == 0) {
                    echo " checked";
                }
            }
        ?>   
    >No<br>
	
	<BR>
    <!-- Notes -->
    <label for="notes">Notes</label><br/>
    <input type="text" name="InvasiveSurvey[notes]" class="medium"
        <?php if(isset($invasiveSpecies)) echo "value='$notes'"; ?>       
    ><br/><br/>        
    <BR>

    <!-- Active -->
    <label for="active">Status of Find</label><br/>
    <input type="radio" name="InvasiveSurvey[active]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($active == 1) {
                    echo " checked";
                }
            }
        ?>
    >Active<br>


    <input type="radio" name="InvasiveSurvey[active]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($active == 0) {
                    echo " checked";
                }
            }
        ?>       
    >Not Active<br>

    <BR>

    <!-- Des Result -->
    <label for="desResult">Did DES confirm an Invasive Species was found?</label><br/>
    <input type="radio" name="InvasiveSurvey[desResult]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($desResult == 1) {
                    echo " checked";
                }
            }
        ?>
    >Confirmed<br>

    <input type="radio" name="InvasiveSurvey[desResult]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($desResult == 0) {
                    echo " checked";
                }
            }
        ?>  
    >Not Confirmed<br>

    <BR>


    <!-- DES Notes-->
    <label for="desNotes">Transcribe any DES Notes</label><br/>
    <textarea name="InvasiveSurvey[desNotes]" rows="4" cols="50"><?php if(isset($invasiveSpecies)) echo $desNotes; ?></textarea><br/><br/>

    <BR>

    <!-- Des Save -->
    <label for="desSave">Did DES confirm this as a Save?</label><br/>
    <input type="radio" name="InvasiveSurvey[desSave]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($desSave == 1) {
                    echo " checked";
                }
            }
        ?>      
    >Save<br>

    <input type="radio" name="InvasiveSurvey[desSave]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($desSave == 0) {
                    echo " checked";
                }
            }
        ?>    
    >No Save<br>
        
    <BR>
    
    
    
    <input type="submit" value="Submit">
    
    <?php echo $this->buttonTo("home","index","Cancel"); ?>
    
    </form>