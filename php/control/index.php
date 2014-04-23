<?php
# Okay so right now this index.php is actually the controller I just kept it name index.php 
# for easy access sake... We can edit apache later to resolve controller.php by default
# but for now index will be the controller since that is what we hit by default.
# So it really does behave like real mvc. This index page 'controls' the flow of 
# the web app. So just think of it as a main function.

require_once 'C:\\devel\\web\\php\\view\\view.php';
require_once 'C:\\devel\\web\\php\\view\\LoggedInView.php';
require_once 'C:\\devel\\web\\php\\model\\loginModel.php';

# Check if a cookie is set. If cookie is not set, redirect to login screen.
if ((!isset($_COOKIE['cookie'])) || (session_status() !== PHP_SESSION_ACTIVE)) {
	$login = new view;
	$login->loginView(null);
}

if (isset($_POST['email'])) {
	$login = new loginModel();
	$login->email = $_POST['email'];
	$login->password = $_POST['password'];
	
	#this follows our system sequence diagram
	# call processLogin which returns a bool val
	$validLogin = $login->processLogin();
	
	if($validLogin == true){
		LoggedInView::loggedIn($login->email);
	}
}

