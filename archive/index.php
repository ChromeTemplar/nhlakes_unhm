<?php
require_once 'C:\\devel\\web\\php\\control\\MainController.php';
//require_once 'C:\\devel\\web\\php\\index.php';
# Check if a cookie is set. If cookie is not set, redirect to login screen.
//echo "session Dump=====>" . var_dump($_SESSION)."<br />";
//echo "post Dump=====><br />" . var_dump($_POST);
	if (!isset($_SESSION['email']) && !isset($_POST['email'])) {
            //echo "<br /> session is not set <br />";
            $login = new view;
            $login->loginView();
	}
	if(isset($_POST['email'])){
            //unset($login);
            $checkLogin = new MainController();
            $checkLogin->startLogin();
	}
        elseif(isset($_SESSION['email'])){
            $signedIn = new surveyView();
            $signedIn->newSurvey();

        }