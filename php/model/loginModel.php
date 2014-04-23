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
		$q = "SELECT UserId, firstname FROM user WHERE email='$em' AND password='$p'";          
		$r = $mysqli->query($q); # Run the query.

		# Check the result:
		if ($r->num_rows == 1) {
			# Fetch the record:
			$row = $r->fetch_array (MYSQLI_ASSOC);
			# Set session cookie, lasts for an hour
			// Get the private context
			session_name('Private');
			session_start();
			$private_id = session_id();
			
			session_write_close();
			echo $private_id;
			echo "Private ID";
			// Get the global context
			session_name('Global');
			session_id('TEST');
			session_start();

			session_write_close();
			# setcookie ($row['firstname']);
			# Return true and the record:
			return true; 
		}
		# If there are errors
		else {
			echo 'in the else error';
				$errors[] = 'The email address and password entered do not match those on file.';
			}
        }
		# Return false and the errors:
		return view::loginView($errors);
	}
}
?>