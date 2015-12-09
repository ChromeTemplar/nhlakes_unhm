<?php
/**
This is file contains three classes. Model, View and Controller.
*/
require_once ('C:\\devel\\web\\php\\model\\boaterSurveyDB.php');
require_once("C:\\devel\\web\\php\\view\boaterSurveyView.php");
require_once("C:\\devel\\web\\php\\model\boaterSurveyModel.php");
//session_start();

class surveyController {        
               
        public function survey() {
                //New blank HTML form
                $form="<form name='myForm' method='post' action='model/formSubmission.php'>
        <table name='myTable'>
          <tr>
            <td>Time:</td>
            <td><input type='time' name='time'/></td>
          </tr>
                  <tr>
            <td>Date:</td>
            <td><input type='date' id='date' name='date'/></td>
          </tr>
                  <tr>
            <td>Indicate if vessel is being launched or retrieved
            <br /></td>
            <td>
            <input type='radio' name='status' value='launched' />Launched
            <input type='radio' name='status' value='retrieved' />Retrieved</td>
          </tr>
          <tr>
            <td>State of registration:</td>
            <td><select name='registrationState'>
				<option value='NH'>NH</option>
				<option value='MA'>MA</option>
				<option value='ME'>ME</option>
				<option value='VT'>VT</option>
				<option value='CT'>CT</option>
				<option value='RI'>RI</option>
				<option value='NY'>NY</option>
				<option value='other'>Other</option></select></td>
          </tr>
          <tr>
            <td>Type of boat:</td>
            <td id='boatInputCol'>
            <input type='radio' id='1' name='boat' value='inboard/outboard(I/O)'/>inboard/outboard(I/O)
            <input type='radio' id='2' name='boat' value='PWC/jet ski/jet boat'/>PWC/jet ski/jet boat
            <br />
            <input type='radio' id='3' name='boat' value='canoe/kayak'/>canoe/kayak
            <input type='radio' id='4' name='boat' value='sail' />sail
            <br />
            <input type='radio' id='5' name='boat' value='other' />other</td>
          </tr>
          <tr>
            <td>Previous interaction with a Lake Host?</td>
            <td>
            <input type='radio' name='interaction' value='1' /> YES
            <input type='radio' name='interaction' value='0' /> NO</td>
          </tr>
          <tr>
            <td>Last waterbody visited</td>
            <td>
                                Name: <input type='text' name='lastSiteVisited'/> Town: <input type='text' name='lastTownVisited'/> State: <input type='text' name='lastStateVisited'/>
                                <br/> Drained?  <input type='radio' name='drained' value='1' /> YES <input type='radio' name='drained' value='0' /> NO
                                <br/> Rinsed?  <input type='radio' name='rinsed' value='1' /> YES <input type='radio' name='rinsed' value='0' /> NO
                                <br/> Dry for at least 5 days?  <input type='radio' name='dryForFiveDays' value='1' /> YES <input type='radio' name='dryForFiveDays' value='0' /> NO
                        </td>
          </tr>
          <tr id='awarenessRow'>
            <td>Boater&#39;s awareness of AIS plant &amp; animal problem?</td>
            <td>
            <input type='radio' name='awareness' value='High' id='h' />High
            <input type='radio' name='awareness' value='Medium' />Medium
            <input type='radio' name='awareness' value='Low' />Low
            <br /></td>
          </tr>
          <tr>
            <td>Specimen found?</td>
            <td>
                                <input type='radio' name='specimenFound' value='1'>Yes <input type='radio' name='specimenFound' value='0'>No <br/>
                                Full Bow Number: <input type='text' name='Bow'/>
                        </td>
          </tr>
          <tr>
            <td>
              <input type='submit' value='Submit' />
            </td>
          </tr>
        </table>";
               
                return $form;  
        }
        /*
        This function returns HTML table. This table contains the survey information obtained from the database.
        */
        public function viewSurvey($survey_id)
        {
                $result = array();
                //new model instance
                $model = new surveyModel;
                //get the data from the database from getSurvey
               
                //handle the data from the surveyModel::getSurvey($survey_id)
                //receievd data from the model will be used to fill in the form fields
                //all fields changed to uneditable
                //DATA COULD BE DISPLAYED IN TEXTUAL FORMAT OTHER THAN A FORM
               
                $form="<form name='myForm' method='post' action='formSubmission.php'>
        <table name='myTable'>
          <tr>
            <td>Time:</td>
            <td><input type='time' name='time' /></td>
          </tr>
                  <tr>
            <td>Date:</td>
            <td><input type='date' id='date' name='date'/></td>
          </tr>
                  <tr>
            <td>Indicate if vessel is being launched or retrieved
            <br /></td>
            <td>
            <input type='radio' name='status' value='launched' />Launched
            <input type='radio' name='status' value='retrieved' />Retrieved</td>
          </tr>
          <tr>
            <td>State of Registration:</td>
            <td><input type='text' id='sor' name='registrationState' onblur='validatesor()'/><div id='sorDiv'></div></td>
          </tr>
          <tr>
            <td>Type of boat:</td>
            <td id='boatInputCol'>
            <input type='radio' id='1' name='boat' value='inboard/outboard(I/O)'/>inboard/outboard(I/O)
            <input type='radio' id='2' name='boat' value='PWC/jet ski/jet boat'/>PWC/jet ski/jet boat
            <br />
            <input type='radio' id='3' name='boat' value='canoe/kayak'/>canoe/kayak
            <input type='radio' id='4' name='boat' value='sail' />sail
            <br />
            <input type='radio' id='5' name='boat' value='other' />other</td>
          </tr>
          <tr>
            <td>Previous interaction with a Lake Host?</td>
            <td>
            <input type='radio' name='interaction' value='1' /> YES
            <input type='radio' name='interaction' value='0' /> NO</td>
          </tr>
          <tr>
            <td>Last waterbody visited</td>
            <td>
                                Name: <input type='text' name='lastSiteVisited'/> Town: <input type='text' name='lastTownVisited'/> State: <input type='text' name='lastStateVisited'/>
                                <br/> Drained?  <input type='radio' name='drained' value='1' /> YES <input type='radio' name='drained' value='0' /> NO
                                <br/> Rinsed?  <input type='radio' name='rinsed' value='1' /> YES <input type='radio' name='rinsed' value='0' /> NO
                                <br/> Dry for at least 5 days?  <input type='radio' name='dryForFiveDays' value='1' /> YES <input type='radio' name='dryForFiveDays' value='0' /> NO
                        </td>
          </tr>
          <tr id='awarenessRow'>
            <td>Boater&#39;s awareness of AIS plant &amp; animal problem?</td>
            <td>
            <input type='radio' name='awareness' value='High' id='h'>High
            <input type='radio' name='awareness' value='Medium'>Medium
            <input type='radio' name='awareness' value='Low'>Low
            <br /></td>
          </tr>
          <tr>
            <td>Specimen found?</td>
            <td>
                                <input type='radio' name='specimenFound' value='Y'>Yes <input type='radio' name='specimenFound' value='N'>No <br/>
                                Full Bow Number: <input type='text' name='Bow'/> <br/>
                                Sent to DES: <input type='radio' name='sentToDES' value='1' />YES       <input type='radio' name='sentToDES' value='0' />NO</td>
          </tr>
          <tr>
            <td>
              <input type='submit' value='Submit' />
            </td>
          </tr>
        </table>";
               
                return $form;
        }
       
        public function editSurvey($survey_id,$role)
        {
                $model = new surveyModel;
                $db1 = new db1;
                //Making an instance of the Model class.
				
                $result = $model->getSurvey($survey_id);
                //$result is an array of the survey information obtained from the Model->getSurvey function.
                $siteID = $result['siteID'];
               
                $accessSiteName = $db1->getSiteName($siteID);//Site name will be displayed only for group leaders.
               
                echo "<br/>";

                $time = $result['inputTime'];
                $date = $result['inputDate'];
                $status = $result['launchStatus'];
                $state = $result['registrationState'];
                $type = $result['boatType'];
                $interaction = $result['previousInteraction'];
                $lastSite = $result['lastSiteVisited'];
                $lastTown = $result['lastTownVisited'];
                $lastState = $result['lastStateVisited'];
                $drained = $result['drained'];
                $rinsed = $result['rinsed'];
                $dried = $result['dryForFiveDays'];
                $awareness = $result['boaterAwareness'];
                $specimenFound = $result['specimenFound'];
                $bowNumber = $result['bowNumber'];
                $DES = $result['sentToDES'];
				$notes = $result['notes'];
				$active = $result['active'];
				
				
				//echo "the value of des is ".$DES;
                //All these variables are used to extract survey information from the $result array.
               
               
                $launchedValue="";
                $retrievedValue="";
                $inboardOutboardValue = "";
                $pwcJetSkiJetValue = "";
                $canoeKayakValue = "";
                $sailValue = "";
                $otherValue = "";
                $interactionYesValue="";
                $interactionNoValue="";
                $lastSiteValue = "";
                $lastTownValue = "";
                $lastStateValue = "";
                $drainedYesValue = "";
                $drainedNoValue = "";
                $rinsedYesValue = "";
                $rinsedNoValue = "";
                $driedYesValue = "";
                $driedNoValue = "";
                $awarenessHighValue = "";
                $awarenessMediumValue = "";
                $awarenessLowValue = "";
                $specimenFoundYesValue = "";
                $specimenFoundNoValue = "";
                $bowNumberValue = "";
                $sentYesValue = "";
                $sentNoValue = "";
				$activeYesValue = "";
				$activeNoValue = "";
                /*These variables are used to set the values of the form elements to null. Later the elements values will be change based on the information obtained from
                the database*/
               
               
                if(strcmp($status,"Launched")==0)
                        $launchedValue = "checked = 'true'";
                        //If the status is 'Launched' then the Launched button will be checked
                else
                        $retrievedValue = "checked = 'true'";
                        //If the status is 'Retrieved' then the Retrieved button will be checked
                               
                switch ($type) {
                        case "inboard/outboard(I/O)":
                                $inboardOutboardValue = "checked ='true'";
                                // If type is inboard/outboard(I/O) then this button will be checked
                                break;
                        case "PWC/jet ski/jet boat":
                                $pwcJetSkiJetValue = "checked = 'true'";
                                // If type is pwcJetSkiJetValue then this button will be checked
                                break;
                        case "canoe/kayak":
                                $canoeKayakValue = "checked = 'true'";
                                // If type is canoeKayakValue then this button will be checked
                                break;
                        case "sail":
                                $sailValue = "checked = 'true'";
                                // If type is sail then this button will be checked
                                break;
                        case "other":
                                $otherValue = "checked = 'true'";
                                // If type is other then this button will be checked
                                break;
                }
               
                if($interaction == 1)
                        $interactionYesValue = "checked = 'true'";
                        //If the value from the database is yes then this button will be checked
                else
                        $interactionNoValue = "checked = 'true'";
                //If the value from the database is no then this button will be checked
               
               
                if($lastSite != Null & $lastSite != "") {
                //If the value of lastSite is not null then fill the values of lastSite, lastTown and lastState from the $result array.
                        $lastSiteValue = $lastSite;
                        $lastTownValue = $lastTown;
                        $lastStateValue = $lastState;
                       
                        if($drained == 1)
                                $drainedYesValue = "checked = 'true'";
                                //If the value from the database is yes then this button will be checked
                        else
                                $drainedNoValue = "checked = 'true'";
                                //If the value from the database is no then this button will be checked
                       
                        if($rinsed == 1)
                                $rinsedYesValue = "checked = 'true'";
                                //If the value from the database is yes then this button will be checked
                        else
                                $rinsedNoValue = "checked = 'true'";
                                //If the value from the database is no then this button will be checked
                       
                        if($dried == 1)
                                $driedYesValue = "checked = 'true'";
                                //If the value from the database is yes then this button will be checked
                        else
                                $driedNoValue = "checked = 'true'";
                                //If the value from the database is no then this button will be checked
               
                }
               
                if(strcmp($awareness,"High")==0)
                                $awarenessHighValue = "checked = 'true'";
                                //If the value from the database is High then this button will be checked
                else if(strcmp($awareness,"Medium")==0)
                                $awarenessMediumValue = "checked = 'true'";
                                //If the value from the database is Medium then this button will be checked
                else
                                $awarenessLowValue = "checked = 'true'";
                                //If the value from the database is Low then this button will be checked
               
               
               
               
               
                if($specimenFound == 1) {
                        //If specimen is found then fill in the bown nubmer and sentToDES value.
                        $specimenFoundYesValue = "checked = 'true'";
                        $bowNumberValue = $bowNumber;
                        if($DES != "" & $DES != Null) {
                                if($DES == 1)
                                        $sentYesValue = "checked = 'true'";
                                else if ($DES == 0)
                                        $sentNoValue = "checked = 'true'";
                        }
                } else {
                        $specimenFoundNoValue = "checked = 'true'";
                }
				
				if($active==1){
					 $activeYesValue = "checked = 'true'";
				
				} else {
					 $activeNoValue = "checked = 'true'";
				}
				
               
                $sentToDESRow = "";//This row is displayed for GroupLeaders and StaffMembers only.
                $notesRow = "";//This row is displayed for GroupLeaders and StaffMembers only.
                $activeRow = "";//This row is displayed for GroupLeaders and StaffMembers only.
               
                if ($role=='GroupLeader') echo $accessSiteName; //If the user is a GroupLeader then disply the site name.
               
                if ($role=='GroupLeader' || $role=='StaffMember') {
                        $sentToDESRow = <<<_END
Sent to DES: <input type='radio' name='sentToDES' value=1 $sentYesValue>YES  
<input type='radio' name='sentToDES' value=0 $sentNoValue>NO
_END;
                        $notesRow = <<<_END
<tr><td>Notes</td>
                        <td>
                                <textarea name="notes"rows="3" cols="50">$notes</textarea>
                        </td>
                </tr>
_END;
                        $activeRow = <<<_END
<tr>
            <td><input type='radio' name='active' value=1 $activeYesValue> Verified</td>
            <td><input type='radio' name='active' value=0 $activeNoValue> Not verified</td>
                        </tr>
_END;
                }
                       
                $form=<<<_END
<form name='myForm' method='post' action='../model/updateSurvey.php'>
        <table name='myTable'>
		<tr><td>Survey ID</td>
		<td><input type="text" name="surveyID" value=$survey_id readOnly="true"></td>
		<tr>
          <tr>
            <td>Time:</td>
            <td><input type='time' name='time' value=$time></td>
          </tr>
                  <tr>
            <td>Date:</td>
            <td><input type='date' name='date' value=$date></td>
          </tr>
                  <tr>
            <td>Indicate if vessel is being launched or retrieved
            <br /></td>
            <td>
            <input type='radio' name='status' value='Launched' $launchedValue>Launched
            <input type='radio' name='status' value='Retrieved' $retrievedValue>Retrieved</td>
          </tr>
          <tr>
            <td>State of Registration:</td>
            <td><input type='text' id='sor' name='registrationState' onblur='validatesor()' value=$state><div id='sorDiv'></div></td>
          </tr>
          <tr>
            <td>Type of boat:</td>
            <td>
            <input type='radio' name='boat' value='inboard/outboard(I/O)' $inboardOutboardValue >inboard/outboard(I/O)
            <input type='radio' name='boat' value='PWC/jet ski/jet boat' $pwcJetSkiJetValue>PWC/jet ski/jet boat
            <br />
            <input type='radio' id='3' name='boat' value='canoe/kayak' $canoeKayakValue>canoe/kayak
            <input type='radio' id='4' name='boat' value='sail' $sailValue>sail
            <br />
            <input type='radio' id='5' name='boat' value='other' $otherValue>other</td>
          </tr>
          <tr>
            <td>Previous interaction with a Lake Host?</td>
            <td>
            <input type='radio' name='interaction' value=1 $interactionYesValue> YES
            <input type='radio' name='interaction' value=0 $interactionNoValue> NO</td>
          </tr>
          <tr>
            <td>Last waterbody visited</td>
            <td>
                                Name: <input type='text' name='lastSiteVisited' value=$lastSiteValue> Town: <input type='text' name='lastTownVisited' value=$lastTownValue>
                                State: <input type='text' name='lastStateVisited' value=$lastStateValue>
                                <br/> Drained?  <input type='radio' name='drained' value=1 $drainedYesValue> YES <input type='radio' name='drained' value=0 $drainedNoValue> NO
                                <br/> Rinsed?  <input type='radio' name='rinsed' value=1 $rinsedYesValue> YES <input type='radio' name='rinsed' value=0 $rinsedNoValue> NO
                                <br/> Dry for at least 5 days?  <input type='radio' name='dryForFiveDays' value=1 $driedYesValue> YES <input type='radio' name='dryForFiveDays' value=0 $driedNoValue> NO
                        </td>
          </tr>
          <tr id='awarenessRow'>
            <td>Boater&#39;s awareness of AIS plant &amp; animal problem?</td>
            <td>
            <input type='radio' name='awareness' value='High' $awarenessHighValue>High
            <input type='radio' name='awareness' value='Medium' $awarenessMediumValue>Medium
            <input type='radio' name='awareness' value='Low' $awarenessLowValue>Low
            <br /></td>
          </tr>
          <tr>
            <td>Specimen found?</td>
            <td>
                                <input type='radio' name='specimenFound' value=1 $specimenFoundYesValue>Yes <input type='radio' name='specimenFound' value='High' value=0 $specimenFoundNoValue>No <br/>
                                Full Bow Number: <input type='text' name='bowNumber' value=$bowNumberValue> <br/>
                                $sentToDESRow
                        </td>
          </tr>
                  $notesRow
                  $activeRow
          <tr>
            <td>
              <input type='submit' value='Submit' />
            </td>
          </tr>
        </table>
_END;
               
                return $form;  
        }      
       
        /*
        This function will be called to view the access sites stored in the system.
        */
        public function viewAccessSites() {
                $db1 = new db1();
                $accessSites = $db1->getAccessSites();
               
                $self = htmlspecialchars($_SERVER["PHP_SELF"]);//The information of the form will be sent back to self. This is done to change the content of the page when the submit button is clicked.
                $numberOfSites = count($accessSites['SiteID']); //Number of sites found in the database is equal to number of site IDs.
               
                echo "<form method='post' action='$self'>";
                        //This is the HTML form header.
                       
                        for($i=1;$i<=$numberOfSites;$i++) {
                                echo $i;
                                $SiteName = $accessSites['SiteName'][$i-1];
                                $SiteID = $accessSites['SiteID'][$i-1];
                               
                                echo<<<_END
<input type='radio' name='SiteID' value=$SiteID>
$SiteName <br/>
_END;
                        }
                        //The for loop is used to loop through the list of surveys. Each survey will be presented as a radio button. Surveys are labeled by time, status, state, and boat type.
                       
                       
                        echo "<input type='submit' name='submitButton' value='Edit/Flag' ></input>";
                        echo"</form>";
                       
       
        }
}
?>
