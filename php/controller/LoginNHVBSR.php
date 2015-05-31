<?php
/**
 * Controller class for the logon screen
 * 1. Logon validation for the userId and password
 * 2. Validation of the session during screen navigation
 * 3. Checks the session status for timeout
 */

class LoginNHVBSRController extends Controller
{
	var $name;
	var $registry;

	function LoginNHVBSRController ($registry){
		$this->registry = $registry;
		$this->name = strtolower(substr(get_class($this), 0, -10));
	}
	
	/***
	 * Display the login screen for the first time.
	 */
	public function index()
	{
		/*** set a template variable ***/
		$this->registry->template->welcome = 'Home';

		/*** load the index template ***/
		$this->registry->template->showLogon('session', 'LoginNHVBSR');

	}
	
	/***
	 * validate the userId and password entered by the user 
	 */
	public function validateUserId() {
		$userId = empty($_POST['userId']) ? '' : $_POST['userId'];
		$password = empty($_POST['password']) ? '' : $_POST['password'];

		//below we will call the controller class with userId and password
		$loginNHVBSRdb = new loginNHVBSRmodel();
		$personResult = $loginNHVBSRdb->getPersonDetails($userId, $password);
		
		//validates the userId and password entered by the user
		if (isset($personResult[0]) && $personResult != NULL) {
			
            $row = $personResult[0];
			
			$firstName = isset($row['firstName']) ? ($row['firstName']) : '';
			$lastName = isset($row['lastName']) ? ($row['lastName']) : '';
			$roleId   = isset($row['roleID']) ? ($row['roleID']) : '';
			
			if (session_id() == PHP_SESSION_NONE) {
				session_start();
			}
			
			$myCurrentDate = new DateTime("now", new DateTimeZone("America/New_York"));
			$timeStampKey = $myCurrentDate->format("Y-m-d-H-i-s");
			$sessionKey = $userId.$timeStampKey;	
			$loginNHVBSRdb->setSessionDetail(session_id(), $sessionKey, "A");			
			$_SESSION ['IDKey'] = $sessionKey;
			$_SESSION['firstName'] = $firstName;
			$_SESSION['lastName'] = $lastName;
			$_SESSION['userName'] = $userId; 
			$_SESSION['roleID'] = $roleId;
			
			/*** set a template variable ***/
			$this->registry->template->welcome = 'Home';
			$this->registry->template->show('home', 'index');
			
		} else {
			//the logic to redirect to the login page with appropriate error message
			$_SESSION['Login.Error'] = "Invalid credentials ";
			session_destroy();
			$this->registry->template->showLogon('session', 'LoginNHVBSR');	
		}
		
	}
	
	/***
	 * the below method is used to check if the user has an
	 * active session in the application and if an active session is not found 
	 * the user is routed to an error page 
	 */
	public function checkActiveSession($sessionKey) {
		
		$loginNHVBSRdb = new loginNHVBSRmodel();
		$sessionResult = $loginNHVBSRdb->checkSessionDetails($sessionKey, 'A');
		
		if (isset($sessionResult[0]) && $sessionResult != NULL) {
			return true;
		} else {
			
			$_SESSION['Login.Error'] = "Please Login with valid Credentails first";
			session_destroy();
			$this->registry->template->showlogon('session', 'LoginNHVBSR'); 
		}
	} 
}
