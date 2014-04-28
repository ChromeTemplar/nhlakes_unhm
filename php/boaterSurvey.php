<?php
/**
This is file contains three classes. Model, View and Controller. 
*/

require_once("db.php");

class surveyView {

	public $controller;
	public $model;
	
	public function __construct() {
		//constructor makes new instances of the controller and model
		$this->controller = new surveyController;
		$this->model = new surveyModel;
	}
	
	public function newSurvey() {
		//calls survey function in controller and stores the return value in $survey
		$survey = $this->controller->survey();
		//$survey now holds HTML that can be echoed to the browser
		echo $survey;
	}
	/**
	This function will be called to display a list of surveys that the user can choose from.
	*/
	public function viewSurveysList($user_id) {
	
		$surveysList = $this->model->getUserSurveys($user_id);
		// surveysList is an array of surveys conducted by the user. The function getUserSurveys() will be called from the Model and it will return an array.
		
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
	public function editSurvey($survey_id) {
	
		
		$survey = $this->controller->editSurvey($survey_id);

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
            <input type='radio' name='interaction' value='YES' /> YES 
            <input type='radio' name='interaction' value='NO' /> NO</td>
          </tr>
          <tr>
            <td>Last waterbody visited</td>
            <td>
				Name: <input type='text' name='lastSiteVisited'/> Town: <input type='text' name='lastTownVisited'/> State: <input type='text' name='lastStateVisited'/>
				<br/> Drained?  <input type='radio' name='drained' value='YES' /> YES <input type='radio' name='drained' value='NO' /> NO
				<br/> Rinsed?  <input type='radio' name='rinsed' value='YES' /> YES <input type='radio' name='rinsed' value='NO' /> NO
				<br/> Dry for at least 5 days?  <input type='radio' name='dryForFiveDays' value='YES' /> YES <input type='radio' name='dryForFiveDays' value='NO' /> NO
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
				<input type='radio' name='specimenFound' value='Y'>Yes <input type='radio' name='awareness' value='High' value='N'>No <br/>
				Full Bow Number: <input type='text' name='registrationState'/> <br/>
				Sent to DES: <input type='radio' name='sentToDES' value='YES' />YES	<input type='radio' name='sentToDES' value='NO' />NO
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
            <input type='radio' name='interaction' value='YES' /> YES 
            <input type='radio' name='interaction' value='NO' /> NO</td>
          </tr>
          <tr>
            <td>Last waterbody visited</td>
            <td>
				Name: <input type='text' name='lastSiteVisited'/> Town: <input type='text' name='lastTownVisited'/> State: <input type='text' name='lastStateVisited'/>
				<br/> Drained?  <input type='radio' name='drained' value='YES' /> YES <input type='radio' name='drained' value='NO' /> NO
				<br/> Rinsed?  <input type='radio' name='rinsed' value='YES' /> YES <input type='radio' name='rinsed' value='NO' /> NO
				<br/> Dry for at least 5 days?  <input type='radio' name='dryForFiveDays' value='YES' /> YES <input type='radio' name='dryForFiveDays' value='NO' /> NO
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
				<input type='radio' name='specimenFound' value='Y'>Yes <input type='radio' name='awareness' value='High' value='N'>No <br/>
				Full Bow Number: <input type='text' name='registrationState'/> <br/>
				Sent to DES: <input type='radio' name='sentToDES' value='YES' />YES	<input type='radio' name='sentToDES' value='NO'' />NO</td>
          </tr>
          <tr>
            <td>
              <input type='submit' value='Submit' />
            </td>
          </tr>
        </table>";
		
		return $form;
	}
	
	public function editSurvey($survey_id)
	{
		$model = new surveyModel;
		//Making an instance of the Model class.
		
		
		$result = $model->getSurvey($survey_id);
		//$result is an array of the survey information obtained from the Model->getSurvey function.

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
		
		if(strcmp($interaction,"Y")==0)
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
			
			if(strcmp($drained,"Y")==0)
				$drainedYesValue = "checked = 'true'";
				//If the value from the database is yes then this button will be checked
			else
				$drainedNoValue = "checked = 'true'";
				//If the value from the database is no then this button will be checked
			
			if(strcmp($rinsed,"Y")==0)
				$rinsedYesValue = "checked = 'true'";
				//If the value from the database is yes then this button will be checked
			else
				$rinsedNoValue = "checked = 'true'";
				//If the value from the database is no then this button will be checked
			
			if(strcmp($dried,"Y")==0)
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
		
		
		
		
		
		if(strcmp($specimenFound,"Y")==0) {
			//If specimen is found then fill in the bown nubmer and sentToDES value.
			$specimenFoundYesValue = "checked = 'true'";
			$bowNumberValue = $bowNumber;
			if($DES != "" & $DES != Null) {
				if(strcmp($DES,"Y")==0)
					$sentYesValue = "checked = 'true'";
				else
					$sentNoValue = "checked = 'true'";
			}
		} else {
			$specimenFoundNoValue = "checked = 'true'";
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
				Sent to DES: <input type='radio' name='sentToDES' value='YES' $sentYesValue>YES	<input type='radio' name='sentToDES' value='NO' $sentNoValue>NO</td>
          </tr>
          <tr>
            <td>
              <input type='submit' value='Submit' />
            </td>
          </tr>
        </table>
_END;
		
		return $form;	
	}	
}

class surveyModel {

	public function getPermissions($user_id) {
	
		//connect to DB class and get permissions
		//return permssion type
		return 0;
	}
	public function dataValid(/*   $_POST data */) {
		//check for $_POST data validity
		
		//return true or false	
	}
	
	public function getUserSurveys($user_id) {
	//This function checks the database for surveys conducted by this specific user.
	
	
	$mysqli = new mysqli("localhost", "root", "", "nhvbsr");
	$surveyResult = array('surveyID'=>array(),'inputTime'=>array(),'launchStatus'=>array(),'registrationState'=>array(),'boatType'=>array());
		
		if (mysqli_connect_errno()) {
		   printf("Connection failed: %s<br />", mysqli_connect_error());
		   exit();
		}
		
		$stmt = $mysqli->prepare("select surveyID,inputTime,launchStatus,registrationState,boatType from boaterSurvey where lakeHostID=$user_id");
		 
		 if (!$stmt) {
			printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
		} else {
			//$nickName = "UNH";
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
	
		//connect to DB class to get survey
		//return survey data

		$mysqli = new mysqli("localhost", "root", "", "nhvbsr");
		
		if (mysqli_connect_errno()) {
		   printf("Connection failed: %s<br />", mysqli_connect_error());
		   exit();
		}
		
		 $stmt = $mysqli->prepare("select * from boaterSurvey where surveyID=$survey_id");
		 
		 if (!$stmt) {
			printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
		} else {
			//$nickName = "UNH";
			$stmt->execute( );
			//$stmt->bind_param("UNH");
			
			$surveyResult = array();
			
			$stmt->bind_result($surveyID, $lakeHostID, $inputDate, $inputTime, $launchStatus, $registrationState,
			$boatType, $previousInteraction, $lastSiteVisited, $lastTownVisited, $lastStateVisited, $drained, $rinsed,
			$dryForFiveDays, $boaterAwareness, $specimenFound, $sentToDES, $bowNumber);

			$stmt->fetch();
			$surveyResult = array('surveyID'=>"$surveyID",'lakeHostID'=>"$lakeHostID",'inputDate'=>"$inputDate",'inputTime'=>"$inputTime",'launchStatus'=>"$launchStatus",
			'registrationState'=>"$registrationState",'boatType'=>"$boatType",'previousInteraction'=>"$previousInteraction",'lastSiteVisited'=>"$lastSiteVisited",
			'lastTownVisited'=>"$lastTownVisited",'lastStateVisited'=>"$lastStateVisited",'drained'=>"$drained",'rinsed'=>"$rinsed",'dryForFiveDays'=>"$dryForFiveDays",
			'boaterAwareness'=>"$boaterAwareness",'specimenFound'=>"$specimenFound",'sentToDES'=>"$sentToDES",'bowNumber'=>"$bowNumber");

			 /* close statement */
			$stmt->close( );
		}

		return $surveyResult;
		
		}

	public function enterData(/*  $_POST data  */) {
		// connect to DB class to enter the $_POST data
	}
}
?>