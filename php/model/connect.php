<?php
	class Connect
	{
		
		static function get() {
			$host = "";
			$user = "";
			$pass = "";
			$db = "NHVBSR";
			return mysqli_connect($host, $user, $pass, $db);
		}
	}
?>