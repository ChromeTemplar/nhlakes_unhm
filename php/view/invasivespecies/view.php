<!-- This form will create new suspected invasive species finds and edit existing finds.

-->





<?php
if (isset($invasiveSpecies)) {
    $userID = $invasiveSpecies['userID'];                 
    $boatRampID = $invasiveSpecies['boatRampID'];
    $summaryID = $invasiveSpecies['summaryID'];
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

    
     $userID = '';       
     $boatRampID = '';
     $summaryID = '';
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


    <!-- UserID -->
    <label for="userID">UserID</label><br/>
   
    <?php  if(isset($invasiveSpecies)) echo $userID; ?>
   
       
    
    <!-- This should eventually populate a drop down list from the available
    boat ramps stored in the data base-->
    
    <!-- BoatRamp -->
   <!-- <label for="boatRampID">Boat Ramp ID</label><br/>
    <input type="text" name="InvasiveSurvey[boatRampID]" class="medium"> -->
    <?php  if(isset($invasiveSpecies)) echo $boatRampID; ?>
  
    
 
    
    <!-- This should populate automatically from the survey summary form. As of now 
    it needs to be manually entered. -->
    
    <!-- Summary ID -->
    <!-- <label for="Name">Summary ID <BR> <small>(Of person who took the survey)</label><br/>
    <input type="text" name="InvasiveSurvey[summaryID]" class="medium" > -->
    <?php  if(isset($invasiveSpecies)) echo $summaryID; ?>
    
   
    <BR>
    <BR>
    <!-- This should be the name of the person who took the survey
        not the person who is entering survey into the system's
    -->
    
    <!-- Name -->
    <label for="Name">Name <BR> <small>(Of person who took the survey)</small></label><br/>
    <div><?php if(isset($invasiveSpecies)) echo $name; ?></div>
    

    <BR>
    <BR>
    
 
    <!-- This should be the date the actual survey was taken. The implementation of the results to the 
    survey will be timestamped by the database.
    -->
    
    
    <!-- SurveyDate -->
    <label for="surveyDate">Date<small> (of incident)</small>
    </label><br/>
    <div><?php if(isset($invasiveSpecies)) echo $surveyDate; ?></div>
    
 
    <BR>
    <small>Note: Date must be entered as YYYY-MM-DD</small>
   
    
    
    <br/><br/>
    
    <!-- LaunchStatus 
    <label for="launchStatus">Launch Status</label><br/>
    <input type="radio" name="InvasiveSurvey[launchStatus]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($launchStatus == 1) {
                    echo "Launched<br>";
                }
            }
        ?>  
    >Launched<br>
    <input type="radio" name="InvasiveSurvey[launchStatus]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($launchStatus == 0) {
                    echo "Retrieved<br>";
                }
            }
        ?>       
    >Retrieved<br>
	
    <BR>
    -->
    <!-- RegistrationState -->
    <label for="registrationState">What state registration of the boat?</label><br/>
    
    <div><?php if(isset($invasiveSpecies)) echo $registrationState; ?></div>
    <br/><br/>

    <BR>
    <BR>
         
    <!-- BoatType 
    <label for="boatType">Type of Boat</label><br/>
	
    <input type="radio" name="InvasiveSurvey[boatType]" value="Inboard/Outboard"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($boatType == "Inboard/Outboard") {
                    echo $boatType."<br>";
                }
            }
        ?>
    >Inboard/Outboard<br>

    <input type="radio" name="InvasiveSurvey[boatType]" value="PWC/Jet/Ski/JetBoat"
         <?php 
            if(isset($invasiveSpecies)) {
                if ($boatType == "PWC/Jet/Ski/JetBoat") {
                    echo $boatType."<br>";
                }
            }
        ?>  
    >PWC/JetSki/JetBoat<br>

    <input type="radio" name="InvasiveSurvey[boatType]" value="Kayak/Canoe"
         <?php 
            if(isset($invasiveSpecies)) {
                if ($boatType == "Kayak/Canoe") {
                    echo $boatType."<br>";
                }
            }
        ?>  
    >Kayak/Canoe<br>

    <input type="radio" name="InvasiveSurvey[boatType]" value="Sail"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($boatType == "Sail") {
                    echo $boatType;
                }
            }
        ?>   
    >Sail<br>

    <input type="radio" name="InvasiveSurvey[boatType]" value="Other"
          <?php 
            if(isset($invasiveSpecies)) {
                if ($boatType == "Other") {
                    echo $boatType;
                }
            }
        ?> 
    >Other<br>

    <BR>
        
    -->    
    <!-- PreviousInteraction
    <label for="previousInteraction">Did the Boater have any Previous Interaction with NH Lakes?</label><br/>
    <input type="radio" name="InvasiveSurvey[previousInteraction]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($previousInteraction == 1) {
                    echo "Yes<br>";
                }
            }
        ?>
    >Yes<br>

    <input type="radio" name="InvasiveSurvey[previousInteraction]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($previousInteraction == 0) {
                    echo "No<br>";
                }
            }
        ?>
    >No<br>

    <BR>
    
    -->
    
    <!-- LastSiteVisted -->
    <label for="LastTownVisted">Name of the Last Site Visted</label><br/>
    <div>
        <?php if(isset($invasiveSpecies)) echo $lastTownVisted; ?>
    </div><br/><br/>
    
    <BR>
    
 
    
    <!-- LastTownVisted -->
    <label for="lastSiteVisted">Name of the Last Town Visted</label><br/>
    <div>
        <?php if(isset($invasiveSpecies)) echo $lastSiteVisted; ?>
    </div><br/><br/>
    <BR>
	
    <!-- LastStateVisted -->
    <label for="lastStateVisted">Name of the Last State Visted</label><br/>
    <div>
        <?php if(isset($invasiveSpecies)) echo $lastStateVisted; ?>       
    </div><br/><br/>
        
    <!-- Drained 
    <label for="drained">Was the boat drained?</label><br/>
    <input type="radio" name="InvasiveSurvey[drained]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($drained == 1) {
                    echo "Yes";
                }
            }
        ?> 
    >Yes<br>

    <input type="radio" name="InvasiveSurvey[drained]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($drained == 0) {
                    echo "No";
                }
            }
        ?>
    >No<br>

    <br/>
        
      -->  
    
    <!-- Rinsed 
    <label for="rinsed">Was the boat rinsed?</label><br/>
    <input type="radio" name="InvasiveSurvey[rinsed]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($rinsed == 1) {
                    echo "Yes<br>";
                }
            }
        ?>
    >Yes<br>

    <input type="radio" name="InvasiveSurvey[rinsed]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($rinsed == 0) {
                    echo "No<br>";
                }
            }
        ?>
    >No<br>


    <br/>
    
    
    -->
    <!-- DryForFiveDays 
    <label for="dryForFiveDays">Has the boat been dry for five days?</label><br/>
    <input type="radio" name="InvasiveSurvey[dryForFiveDays]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($dryForFiveDays == 1) {
                    echo "Yes<br>";
                }
            }
        ?>  
    >Yes<br>

    <input type="radio" name="InvasiveSurvey[dryForFiveDays]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($dryForFiveDays == 0) {
                    echo "No<br>";
                }
            }
        ?>
    >No<br>

    <br/>
    
    
     -->   
    <!-- Boater Awareness 
    <label for="boaterAwareness">Type of Boat</label><br/>
	
    <input type="radio" name="InvasiveSurvey[boaterAwareness]" value="High"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($boaterAwareness == "High") {
                    echo $boaterAwareness."<br>";
                }
            }
        ?>
    >High<br>

    <input type="radio" name="InvasiveSurvey[boaterAwareness]" value="Medium"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($boaterAwareness == "Medium") {
                    echo $boaterAwareness."<br>";
                }
            }
        ?>
    >Medium<br>

    <input type="radio" name="InvasiveSurvey[boaterAwareness]" value="Low"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($boaterAwareness == "Low") {
                    echo $boaterAwareness."<br>";
                }
            }
        ?>
    >Low<br>
    
    <br/>
        
      -->  
    <!-- BowNumber -->
    <label for="bowNumber">Bow Number</label><br/>
	<div>
            <?php if(isset($invasiveSpecies)) echo $bowNumber; ?>
    </div><br/><br/>
        
        
        <BR>
     
    <!-- License Plate Number -->
    <label for="bowNumber">License Plate</label><br/>
	<div>
            <?php if(isset($invasiveSpecies)) echo $licensePlateNumber; ?>       
    </div><br/><br/>        
        <BR>
        
    <!-- sentToDES -->
    <label for="sentToDES">Was the specimen sent to DES?</label><br/>
    <div>
        <?php 
            if(isset($invasiveSpecies)) {
                if ($sentToDES == 1) {
                    echo "Yes<br>";
                }
				else if ($sentToDES == 0) {
                    echo "No<br>";
                }
            }
            if(isset($invasiveSpecies)) {
                
            }
        ?>   
    </div>
	
	<BR>
    <!-- Notes -->
    <label for="notes">Notes</label><br/>
    <div>
        <?php if(isset($invasiveSpecies)) echo $notes; ?>       
    </div><br/><br/>        
    <BR>

    <!-- Active 
    <label for="active">Status of Find</label><br/>
    <input type="radio" name="InvasiveSurvey[active]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($active == 1) {
                    echo "Active<br>";
                }
            }
        ?>
    >Active<br>


    <input type="radio" name="InvasiveSurvey[active]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($active == 0) {
                    echo "Not Active<br>";
                }
            }
        ?>       
    >Not Active<br>

    <BR>
     -->
    <!-- Des Result >
    <label for="desResult">Did DES confirm an Invasive Species was found?</label><br/>
    <input type="radio" name="InvasiveSurvey[desResult]" value="1"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($desResult == 1) {
                    echo "Confirmed<br>";
                }
            }
        ?>
    >Confirmed<br>

    <input type="radio" name="InvasiveSurvey[desResult]" value="0"
        <?php 
            if(isset($invasiveSpecies)) {
                if ($desResult == 0) {
                    echo "Not Confirmed<br>";
                }
            }
        ?>  
    >Not Confirmed<br>

    <BR>

  
    <!-- DES Notes
    <label for="desNotes">Transcribe any DES Notes</label><br/>
    <textarea name="InvasiveSurvey[desNotes]" rows="4" cols="50"><?php if(isset($invasiveSpecies)) echo $desNotes; ?></textarea><br/><br/>

    <BR>
   -->
    <!-- Des Save 
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
    
    
    -->
   
    
    <?php echo $this->buttonTo("home","index","Back"); ?>
    
   