<?php
# This script handles the default login view

# So here is a our view class that I made... It's really simple right now but 
# we can make sub classes if need be 
# right now it just has the loginView function
# which takes a param of $errors.
# So if theres errors obviously display them
# else so the regular login.
# So the view shouldn't do anything except display static crap
# let the model do all the work.
class view {
	public function loginView($errors) {
		if(isset($errors) && !empty($errors)) {
			echo '<h1>Error!</h1>
			<p class="error">The following error(s) occurred:<br />';
		
			foreach ($errors as $msg) { 
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p>';
		}
	
		echo
		<<<EOT
		<style>
		form { position:fixed;
			   top:35%;
			   left:43%;
			   width:250px; 
			   border: 3px solid #0000FF;
			   width: 20em
			   border-collapse:separate;
			   border-spacing:10px;}
			   fieldset		
	   </style>
		
	   	<h1 align='center'>Welcome to NHVBSR</h1>
		<form action="index.php" method="post">
		<h2 align='center'>Login</h2>
		<p>User Name: <input type="text" name="email" size="20" maxlength="60" /> </p>
		<p>Password: <input type="password" name="password" size="20" maxlength="20" /></p>
		<p><input type="submit" name="submit" value="Login" /></p>
		</form>
EOT;
	}
}