<?php
/**
This is file contains three classes. Model, View and Controller.
*/

require_once("C:\\devel\\web\\php\\model\\boaterSurveyDB.php");
require_once("C:\\devel\\web\\php\\control\\boaterSurveycontroller.php");


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
               
						//echo $numberOfSurveys;
                       
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
               
                if(empty($surveysList['surveyID'])) {
                        echo "No Surveys";
                       
                } else {	
						
						//var_dump($surveysList);
                        $numberOfSurveys = count($surveysList['surveyID']);
                        //Number of surveys conducted by the user is equal to the length of the array.
                       
                        echo "<form method='post' action='view\surveyEditingPage.php'>";
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