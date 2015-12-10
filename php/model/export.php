<?php
	//set vars and set up connection	
	$host="localhost";
	$username="root";
	$password="";
	$databasename = "nhvbsr"; 

	$connection=mysql_connect($host,$username,$password); 

	echo mysql_error();

	$selectdb=mysql_select_db($databasename) or die("Database could not be selected"); 
	$result=mysql_select_db($databasename)or die("database cannot be selected <br>");

	//set up query
	$output = "";
	$table = "summary";
	$sql = mysql_query("select * from $table");
	$columns_total = mysql_num_fields($sql);
	
	//get col names
	for ($i = 0; $i < $columns_total; $i++) {
	$heading = mysql_field_name($sql, $i);
	$output .= '"'.$heading.'",';
	}
	$output .="\n";
	
	//get values
	while ($row = mysql_fetch_array($sql)) {
	for ($i = 0; $i < $columns_total; $i++) {
	$output .='"'.$row["$i"].'",';
	}
	$output .="\n";
	}
		
	//ready file for download
	$filename = "myFile.csv";
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	
	echo $output;
	exit;

?>