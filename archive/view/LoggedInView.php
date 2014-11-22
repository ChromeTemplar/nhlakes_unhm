<?php
/**
 * 
 * Display the LoggedInView
 * @author Colby Chenard
 *
 */

//Another class for a different view
// I'm wondering if we should keep all the views in one class and just have different functions
//or if we should have separate class for separate views???
class LoggedInView{
public function loggedIn($name){
		echo $name.'<h1><br /> Successfully Logged In!</h1><br />';
	}
}
