<?php
# Insert all registration data into nhvbsr Database
$page_title ='Register';
#include ('index.html');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array(); #initialize an error array
	
	#check for form submission
	if(empty($_POST['FirstName'])) {
		$errors[] = 'You did not enter a First Name...';
	}
	else {
		$fn = trim($_POST['FirstName']);
	}
	
	# check for a last name
	 if(empty($_POST['LastName'])) {
		$errors[] = 'You did not enter a Last Name...';
	} else {
		$ln = trim($_POST['LastName']);
	}
	
	 # check for a email address
	 if(empty($_POST['email'])) {
		$errors[] = 'You did not enter an email address...';
	} else {
		$em = trim($_POST['email']);
	}
	
	#Check for a company:
	if(!empty($_POST['Company'])) {
		$co = trim($_POST['Company']);
	}
	
	#Check for a password and match against the confirmed password;
	if(!empty($_POST['pass1'])) {
		if($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		}else{
			$p = trim($_POST['pass1']);
		}
	}else {
		$errors[] = 'You forgot to enter a password.';
	}
	if(empty($errors)) { #If everything is OK...Register the User in the Database...
		require('C:\\devel\\web\\php\\model\\mysqlConnect.php'); #Connect to the db.
		# Make the query:
		$q = "INSERT INTO user (firstname, lastname, email, password, Company, registrationDate) VALUES
		('$fn','$ln','$em','$co',SHA1('$p'), NOW())";
		var_export($q);
		$r = @mysqli_query($dbc, $q); #Run the query.
		var_export($r);
		if($r) { # If it runs...
		
			#Print a message:
			echo '<h1> Thank you!</h1>
			<p>You can now proceed to login to your account using your email and password.</p>
			<a href="loginPage.php">
			<button type="button">Login</button> </a>';
			
			# Debugger message:
			echo '<p>' .mysqli_error($dbc).'<br /><br />Query:'.$q.'</p>';
			error_log(mysqli_error($dbc));
		}# End of if ($r) IF.
	
		mysqli_close($dbc); # Close the database connection....Just incase lol
		exit();
	
	}
	# Report the errors...
	else {
		echo'<h1>Error!</h1>
		<p class="error"> The following error(s) occurred: <br />';
		foreach ($errors as $msg) { # Print each error.
			echo "-$msg<br /> \n";
			error_log($msg);
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		} #End of the main Submit Conditional Yay!
}
#To do....Display Registration form use... (isset($_POST['blablablah'])) then echo using $_POST['blablabla']; 
?>
<link href="main.css" rel="stylesheet" type="text/css" /> 
<table>
<th>Please Create an account</th>
<tr>
<td class="mainTd">
<form action="register.php" method="post">
<p>First Name: <input type="text" name="FirstName" size="15" maxlength="20" value="<?php if (isset($_POST['FirstName'])) echo $_POST['FirstName']; ?>" /></p>
<p>Last Name: <input type="text" name="LastName" size="15" maxlength="40" value="<?php if (isset($_POST['LastName'])) echo $_POST['LastName']; ?>" /></p>
<p>Email Address: <input type="text" name="email" size="15" maxlength="40" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
<p>Company: <input type="text" name="Company" size="15" maxlength="40" value="<?php if (isset($_POST['Company'])) echo $_POST['Company']; ?>" /></p>
<p>Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
<p><input type="submit" name="submit" value="Register" /></p>
</form>
</td>
</tr>
</table>	
