<?php
# Okay so right now this index.php is actually the controller I just kept it name index.php 
# for easy access sake... We can edit apache later to resolve controller.php by default
# but for now index will be the controller since that is what we hit by default.
# So it really does behave like real mvc. This index page 'controls' the flow of 
# the web app. So just think of it as a main function.

require_once 'C:\\devel\\web\\php\\view\\view.php';
require_once 'C:\\devel\\web\\php\\view\\pageTemplate.php';
require_once 'C:\\devel\\web\\php\\view\\LoggedInView.php';
require_once 'C:\\devel\\web\\php\\model\\loginModel.php';
require_once 'C:\\devel\\web\\php\\control\\boaterSurveyController.php';
class MainController{
	public function startLogin(){
            $login = new loginModel();
            $login->email = $_POST['email'];
            $login->password = $_POST['password'];

            #this follows our system sequence diagram
            # call processLogin which returns a bool val
            $validLogin = $login->processLogin();

            if($validLogin == true){
                //self::showHomePage();
				header('Location:survey.php');
            }
            else{
                return;
            }
	}
        public function showHomePage(){
            $newLayout = new pageTemplate();
            $newLayout->header("Boater Survey");
            $newLayout->siteBody("Boater Survey");
            $loadHome = new surveyView();
            $loadHome->newSurvey();
            $newLayout->footer();
        }
}