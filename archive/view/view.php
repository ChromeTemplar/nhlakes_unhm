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
	public function loginViewErr($errors) {
		if(isset($errors) && !empty($errors)) {
				
			}
		}
	
	public function loginView($errors = null){
            $loginBox =
            <<<EOT
            <link rel="stylesheet" type="text/css" href="../css/mainLayout.css" />

            <form action="index.php" method="post">
            <p>User Name: <input type="text" name="email" size="20" maxlength="60" /> </p>
            <p>Password: <input type="password" name="password" size="20" maxlength="20" /></p>
            <p><input type="submit" name="submit" value="Login" /></p>
            </form>
EOT;
            $welcome = new pageTemplate();
            $welcome->header("Welcome");
            $welcome->siteBody("Login");
            if(isset($errors) && !empty($errors)) {
                $err = '<h1>Error!</h1>
                <p class="error">The following error(s) occurred:<br />';

                echo $err;
                foreach ($errors as $msg) { 
                                echo " - $msg<br />\n";
                        }

                echo '</p>Please try again.</p>';
            }
            echo $loginBox;
            $welcome->footer();
    }
}