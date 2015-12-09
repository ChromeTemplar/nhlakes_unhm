<?php
# This file contains the database access information.
# This file also establishes a connection to MySQL,

# just call this statically anytime you need to connect
# ex: $mysqli = db::dbConn();
# dont for get to close the connection when youre done!

class db{
	public static function dbConn(){

	$mysqli = new mysqli("localhost", "root", "", "nhvbsr");

# Check connection
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
			error_log("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
		else {
			return $mysqli;
		}
	}
}
?>