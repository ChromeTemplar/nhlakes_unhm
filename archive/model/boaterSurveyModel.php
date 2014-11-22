<?php
require_once ("boaterSurveyDB.php");
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
       
        public function getSortedAggregateData($sort,$site) {
                $surveyData = $this->db1->getSortedAggregateSurveys($sort,$site);
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
        $day = $today['mday']-1;
        $month = $today['mon'];
        $date = "$year"."-"."$month"."-"."$day";

		
	
        //$date = "2013-01-03";
       
       
        $mysqli = new mysqli("localhost", "root", "", "nhvbsr");
        $surveyResult = array('surveyID'=>array(),'inputTime'=>array(),'launchStatus'=>array(),'registrationState'=>array(),'boatType'=>array());
       

       
                if (mysqli_connect_errno()) {
                   printf("Connection failed: %s<br />", mysqli_connect_error());
                   exit();
                }
               
                $stmt = $mysqli->prepare("select SurveyID,InspectionTime,LaunchStatus,RegistrationState,BoatType from surveys where LakeHostID=? and InputDate=CURDATE()");
                 
                 if (!$stmt) {
                        printf("prepare( ) failed: (%s) %s", $mysqli->errno, $mysqli->error);
                } else {
                        //$nickName = "UNH";
                        $stmt->bind_param("i", $user_id);
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