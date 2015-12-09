<?php
# This page defines two functions used by the login/logout process.

# This function determines an absolute URL and redirects the user there.
# The function takes one argument: the page to be redirected to.
# The argument defaults to index.php.

require_once 'mysqlConnect.php';
class loginModel {
	
	# Pass args to $email and $password when this class is instantiated.
	# processLogin() will do the db compares to authenticate the user.
	public $email = '';
	public $password ='';
	
	# This function validates the form data (the email address and password).
	# If both are present, the database is queried.
	# The function requires a database connection.
	# The function returns an array of information, including:
	# - a TRUE/FALSE variable indicating success
	# - an array of either errors or the database result
	function processLogin() {
		$mysqli = db::dbConn();
		# Initialize error array.
	    $errors = array();
		# Validate the email address:
		if (empty($this->email)) {
			$errors[] = 'You forgot to enter your email address.';
		}
		else {
			$em = $mysqli->real_escape_string($this->email);
		}

		# Validate the password:
		if (empty($this->password)) {
			$errors[] = 'You forgot to enter your password.';
		}
		else {
			$p = $mysqli->real_escape_string($this->password);
		}
	        
		# If there are no errors
		if (empty($errors)) {
			# Retrieve the user_id and first_name for that email/password combination:
			#TODO: encrypt password and decrypt with sha1...
			$q = "SELECT UserID, username FROM users WHERE email='$em' AND Password='$p'";          
			$r = $mysqli->query($q); # Run the query.

			# Check the result:
			if ($r->num_rows == 1) {
				# Fetch the record:
				$row = $r->fetch_array (MYSQLI_ASSOC);
				# Set session cookie, lasts for an hour
				session_start();
				$private_id = session_id();
				$_SESSION['email'] = $em;
				$_SESSION['role'] = self::getUserRole($em);
				$_SESSION['UserID'] = $row['UserID'];
				session_write_close();
				// Get the global context
				session_name('Global');
				session_id('TEST');
				session_start();
				error_log("Session" . $private_id . "started at " . date('Y-m-d') . "\n");
				return true; 
			}
			# If there are errors
			else {
					$errors[] = 'The email address and password entered do not match those on file.';
					view::loginView($errors);
				}
        }
		# Return false and the errors:
		//return view::loginView($errors);
	}
	
	public function getUserRole($currentUser){
		$mysqli = db::dbConn();
		$query = "Select Role from users where Email='$currentUser'";
		$result = $mysqli->query($query);
		$row = $result->fetch_assoc();
		//var_dump($row);
	}

	function processLogout() {
		$private_id = session_id();
		# Destroy session variables
		$_SESSION = array();
		

		# Delete cookie data
		if (ini_get("session.use_cookies")) {
    		$params = session_get_cookie_params();
    		setcookie(session_name(), '', time() - 42000,
    	    $params["path"], $params["domain"],
    	    $params["secure"], $params["httponly"]
    		);
		}
	
		# Destroy the session
		session_destroy();
		error_log("Session" . $private_id . "ended at " . date('Y-m-d') . "\n");
	}
}

?>