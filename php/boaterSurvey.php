<?php
/**
This is file contains three classes. Model, View and Controller.
*/


// This is a comment
require_once("db1.php");

class surveyView {

        public $controller;
        public $model;
        public $db1;
       
        public function __construct() {
                //constructor makes new instances of the controller and model
                $this->controller = new surveyController;
                $this->model = new surveyModel;
                $this->db1 = new db1;
        }
       
        public function newSurvey() {
                //calls survey function in controller and stores the return value in $survey
                $survey = $this->controller->survey();
                //$survey now holds HTML that can be echoed to the browser
                echo $survey;
        }
       
        /*
        This function is called to display surveys conducted in this particular site. The function takes $site_id as a parameter.
        */
        public function viewSiteSurveys($site_id) {
        $surveysList = array(); //Sites data will be stored in this array
       
        $surveysList = $this->db1->getSiteSurveys($site_id); // The function getSiteSurveys($site_id) returns an array of surveys.
       
        if(empty($surveysList)) {
                        echo "No Surveys";
                       
                } else {
               
                        $numberOfSurveys = count($surveysList['surveyID']);
                        //Number of surveys conducted by the user is equal to the length of the array.
               
               
                       
                        echo "<form method='post' action='surveyEditingPage.php'>";
                        //This is the HTML form header.
                       
                        for($i=1;$i<=$numberOfSurveys;$i++) {
                                $surveyID = $surveysList['surveyID'][$i-1];
                                $date = $surveysList['inputDate'][$i-1];
                                $status = $surveysList['launchStatus'][$i-1];
                                $state = $surveysList['registrationState'][$i-1];
                                $boat = $surveysList['boatType'][$i-1];

                                echo<<<_END
<input type='radio' name='surveyID' value=$surveyID>
Date: $date , Lanuch Status: $status , Registration State: $state , Boat Type: $boat <br/>
_END;
                        }
                        //The for loop is used to loop through the list of surveys. Each survey will be presented as a radio button. Surveys are labeled by time, status, state, and boat type.
                       
                       
                        echo "<input type='submit' name='submitButton' value='Edit/Flag' ></input>";
                        echo"</form>";
                        //The is the submit button and the closing tag for the form.    
                }
       
       
       
        }
        /**
        This function will be called to display a list of surveys that the user can choose from.
        */
        public function viewAggregateData($sort) {      

			$data = $this->model->getSortedAggregateData($sort);

			$total = implode($data[0]);
			$DES =  implode($data[1]);
			$drained =  implode($data[2]);
			$rinsed =  implode($data[3]);
			$dried =  implode($data[4]);
		   
			$show = "
				<table class='data'>
					  <tr>
								<th rowspan='2'>Total Surveys</th>
								<th colspan='7'>Registration State</th>
								<th rowspan='2'>Drained</th>
								<th rowspan='2'>Rinsed</th>
								<th rowspan='2'>Dried</th>
								<th rowspan='2'>DES</th>
						</tr>
						<tr>
								<th>NH</th>
								<th>MA</th>
								<th>ME</th>
								<th>CT</th>
								<th>VT</th>
								<th>RI</th>
								<th>Other</th>
						</tr>
						<tr>
								<td>$total</td>    
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>$drained</td>
								<td>$rinsed</td>
								<td>$dried</td>
								<td>$DES</td>
						</tr>
				</table>";
			echo $show;
                
        }
        public function viewSurveysList($user_id) {
                $surveysList = array();
       
                $role = $this->model->getUserRole($user_id);
               
                if (strcmp($role,"LakeHost")==0){
                $surveysList = $this->model->getUserSurveys($user_id,$role);
                // surveysList is an array of surveys conducted by the user. The function getUserSurveys() will be called from the Model and it will return an array.
                } else if (strcmp($role,"GroupLeader")==0) {
                $surveysList = $this->db1->getGroupSurveys($user_id,$role);
                }
               
                if(empty($surveysList)) {
                        echo "No Surveys";
                       
                } else {
               
                        $numberOfSurveys = count($surveysList['surveyID']);
                        //Number of surveys conducted by the user is equal to the length of the array.
               
               
                       
                        echo "<form method='post' action='surveyEditingPage.php'>";
                        //This is the HTML form header.
                       
                        for($i=1;$i<=$numberOfSurveys;$i++) {
                                $surveyID = $surveysList['surveyID'][$i-1];
                                $time = $surveysList['inputTime'][$i-1];
                                $status = $surveysList['launchStatus'][$i-1];
                                $state = $surveysList['registrationState'][$i-1];
                                $boat = $surveysList['boatType'][$i-1];

                                echo<<<_END
<input type='radio' name='surveyID' value=$surveyID>
Time: $time , Lanuch Status: $status , Registration State: $state , Boat Type: $boat <br/>
_END;
                        }
                        //The for loop is used to loop through the list of surveys. Each survey will be presented as a radio button. Surveys are labeled by time, status, state, and boat type.
                       
                       
                        echo "<input type='submit' name='submitButton' value='Edit/Flag' ></input>";
                        echo"</form>";
                        //The is the submit button and the closing tag for the form.    
                }
       
        }
       
        public function viewSurvey($survey_id,$user_id) {
               
                //permissions will store the return value of getPermissions.  
                $permission = $this->model->getPermissions($user_id);
               
                if($permission == 0 /* If user has permissions to view  */)
                {
                        //$survey will hold the return data of viewSurvey.  viewSurvey is a previously completed survey
                        $survey = $this->controller->viewSurvey($survey_id);
                        //This data can then be echoed to the browser
                        echo $survey;
                }
                else
                {
                        //need some GUI to display error.  Could use a javascript alert
                        $error = "You are not allowed to access this survey";
                        echo $error;
                }
        }
       
        /*
        This function calls editSurvey from the controller class.
        */
        public function editSurvey($survey_id,$user_id) {
       
                $role = $this->model->getUserRole($user_id);// Gets the role of the user {LakeHost, GroupLeader, or StaffMember}.
                $survey = $this->controller->editSurvey($survey_id,$role); // The HTML form.

                echo $survey;
                //$survey is a string variable returned from controller->editSurvey. This variable contains the HTML form elements which will be printed when this function is called.
               
        }
                       
        public function enterSurvey(/*  $_POST data  */) {
       
                $valid = $this->model->dataValid(/*  $_POST data  */);
               
                if($valid) {
                        $this->model->enterData(/*  $_POST data */);
                }
                else {
                        //return the form with the invaliid data
                }              
        }
}

class surveyController {        
               
        public function survey() {
                //New blank HTML form
                $form="<form name='myForm' method='post' action='formSubmission.php'>
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
            <input type='radio' name='awareness' value='High' id='h' />High
            <input type='radio' name='awareness' value='Medium' />Medium
            <input type='radio' name='awareness' value='Low' />Low
            <br /></td>
          </tr>
          <tr>
            <td>Specimen found?</td>
            <td>
                                <input type='radio' name='specimenFound' value='1'>Yes <input type='radio' name='specimenFound' value='0'>No <br/>
                                Full Bow Number: <input type='text' name='Bow'/> <br/>
                                Sent to DES: <input type='radio' name='sentToDES' value='1' />YES       <input type='radio' name='sentToDES' value='0' />NO
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
                                else
                                        $sentNoValue = "checked = 'true'";
                        }
                } else {
                        $specimenFoundNoValue = "checked = 'true'";
                }
               
                $sentToDESRow = "";//This row is displayed for GroupLeaders and StaffMembers only.
                $notesRow = "";//This row is displayed for GroupLeaders and StaffMembers only.
                $activeRow = "";//This row is displayed for GroupLeaders and StaffMembers only.
               
                if ($role=='GroupLeader') echo $accessSiteName; //If the user is a GroupLeader then disply the site name.
               
                if ($role=='GroupLeader') {
                        $sentToDESRow = <<<_END
Sent to DES: <input type='radio' name='sentToDES' value='1' $sentYesValue>YES  
<input type='radio' name='sentToDES' value='0' $sentNoValue>NO
_END;
                        $notesRow = <<<_END
<tr><td>Notes</td>
                        <td>
                                <textarea rows="3" cols="50"></textarea>
                        </td>
                </tr>
_END;
                        $activeRow = <<<_END
<tr>
            <td><input type='radio' name='active' value=1 > Verified</td>
            <td><input type='radio' name='active' value=0 > Not verified</td>
                        </tr>
_END;
                }
                       
                $form=<<<_END
<form name='myForm' method='post' action='formSubmission.php'>
        <table name='myTable'>
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
            <input type='radio' name='status' value='launched' $launchedValue>Launched
            <input type='radio' name='status' value='retrieved' $retrievedValue>Retrieved</td>
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
            <input type='radio' name='interaction' value='YES' $interactionYesValue> YES
            <input type='radio' name='interaction' value='NO' $interactionNoValue> NO</td>
          </tr>
          <tr>
            <td>Last waterbody visited</td>
            <td>
                                Name: <input type='text' name='lastSiteVisited' value=$lastSiteValue> Town: <input type='text' name='lastTownVisited' value=$lastTownValue>
                                State: <input type='text' name='lastStateVisited' value=$lastStateValue>
                                <br/> Drained?  <input type='radio' name='drained' value='YES' $drainedYesValue> YES <input type='radio' name='drained' value='NO' $drainedNoValue> NO
                                <br/> Rinsed?  <input type='radio' name='rinsed' value='YES' $rinsedYesValue> YES <input type='radio' name='rinsed' value='NO' $rinsedNoValue> NO
                                <br/> Dry for at least 5 days?  <input type='radio' name='dryForFiveDays' value='YES' $driedYesValue> YES <input type='radio' name='dryForFiveDays' value='NO' $driedNoValue> NO
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
                                <input type='radio' name='specimenFound' value='Y' $specimenFoundYesValue>Yes <input type='radio' name='awareness' value='High' value='N' $specimenFoundNoValue>No <br/>
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

class surveyModel {

        public function __construct() {
                //constructor makes new instances of the controller and model
                $this->db1 = new db1;
        }
        public function getPermissions($user_id) {
       
                //connect to db1 class and get permissions
                //return permssion type
                return 0;
        }
        public function dataValid(/*   $_POST data */) {
                //check for $_POST data validity
               
                //return true or false  
        }
       
        public function getSortedAggregateData($sort) {
                $surveyData = $this->db1->getSortedAggregateSurveys($sort);
                return $surveyData;
        }
       
        public function getUserRole($user_id) {
       
                $mysqli = new mysqli("localhost", "root", "", "nhvbsr");
               
                if (mysqli_connect_errno()) {
                   printf("Connection failed: %s<br />", mysqli_connect_error());
                   exit();
                }
               
                 $stmt = $mysqli->prepare("select Role from users where UserID = ?");
                 
                 if (!$stmt) {
                        printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
                } else {
                        //$nickName = "UNH";
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute( );
                        //$stmt->bind_param("UNH");
                       
                        $role = "";
                       
                        $stmt->bind_result($role);

                        $stmt->fetch();
                       
                         /* close statement */
                        $stmt->close( );
                }

                return $role;
       
        }
       
        public function getUserSurveys($user_id) {
        //This function checks the database for surveys conducted by this specific user.
       
       
        $today = getdate();
        $year = $today['year'];
        $day = $today['mday'];
        $month = $today['mon'];
        $date = "$year"."-"."$month"."-"."$day";

        $date = "2013-01-03";
       
       
        $mysqli = new mysqli("localhost", "root", "", "nhvbsr");
        $surveyResult = array('surveyID'=>array(),'inputTime'=>array(),'launchStatus'=>array(),'registrationState'=>array(),'boatType'=>array());
       

       
                if (mysqli_connect_errno()) {
                   printf("Connection failed: %s<br />", mysqli_connect_error());
                   exit();
                }
               
                $stmt = $mysqli->prepare("select SurveyID,InspectionTime,LaunchStatus,RegistrationState,BoatType from surveys where LakeHostID=? and InputDate=?");
                 
                 if (!$stmt) {
                        printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
                } else {
                        //$nickName = "UNH";
                        $stmt->bind_param("is", $user_id, $date);
                        $stmt->execute( );
                        //$stmt->bind_param("UNH");
                       
                        $stmt->bind_result($surveyID,$inputTime, $launchStatus, $registrationState,$boatType);

                        while ($stmt->fetch()) {

                        array_push($surveyResult['surveyID'],$surveyID);
                        array_push($surveyResult['inputTime'],$inputTime);
                        array_push($surveyResult['launchStatus'],$launchStatus);
                        array_push($surveyResult['registrationState'],$registrationState);
                        array_push($surveyResult['boatType'],$boatType);
                       
                        }
                         /* close statement */
                        $stmt->close( );
                }

                return $surveyResult;
       
        }
       
       
        public function getSurvey($survey_id) {
       
                //connect to db1 class to get survey
                //return survey data

                $mysqli = new mysqli("localhost", "root", "", "nhvbsr");
               
                if (mysqli_connect_errno()) {
                   printf("Connection failed: %s<br />", mysqli_connect_error());
                   exit();
                }
               
                 $stmt = $mysqli->prepare("select * from surveys where SurveyID=?");
                 
                 if (!$stmt) {
                        printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
                } else {
                        //$nickName = "UNH";
                        $stmt->bind_param("i", $survey_id);
                        $stmt->execute( );
                        //$stmt->bind_param("UNH");
                       
                        $surveyResult = array();
                       
                        $stmt->bind_result($surveyID, $lakeHostID, $inputDate, $inputTime, $siteID, $launchStatus, $registrationState,
                        $boatType, $previousInteraction, $lastSiteVisited, $lastTownVisited, $lastStateVisited, $drained, $rinsed,
                        $dryForFiveDays, $boaterAwareness, $specimenFound, $bowNumber, $sentToDES, $notes, $active);

                        $stmt->fetch();
                        $surveyResult = array('surveyID'=>"$surveyID",'lakeHostID'=>"$lakeHostID",'inputDate'=>"$inputDate",'inputTime'=>"$inputTime",'siteID'=>"$siteID",'launchStatus'=>"$launchStatus",
                        'registrationState'=>"$registrationState",'boatType'=>"$boatType",'previousInteraction'=>"$previousInteraction",'lastSiteVisited'=>"$lastSiteVisited",
                        'lastTownVisited'=>"$lastTownVisited",'lastStateVisited'=>"$lastStateVisited",'drained'=>"$drained",'rinsed'=>"$rinsed",'dryForFiveDays'=>"$dryForFiveDays",
                        'boaterAwareness'=>"$boaterAwareness",'specimenFound'=>"$specimenFound",'bowNumber'=>"$bowNumber",'sentToDES'=>"$sentToDES",'notes'=>"$notes",'active'=>"$active");

                         /* close statement */
                        $stmt->close( );
                }

                return $surveyResult;
               
        }
}
?>
