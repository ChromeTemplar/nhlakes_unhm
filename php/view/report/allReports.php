<h1><?php echo $welcome ?></h1>

<?php
/**
File: View: allReports.php
Date: 4/29/2015
Author: Reporting Group 2015
Info: Displays the report created from build report on the reporting page. See Model:Report.php and View:Report.php.
**/

// Build report if there is no report available. If data is available the report will be displayed.
if ($allreport !="")
	echo $this->buildReport($allreport);
else
	// If no data is available or there is no database connection, the following will be displayed.
	echo "<h2> There are no Survey Summaries in the system. </h2>";

?><br>
<!-- Displays the home link to return back to the home page. -->
<!--Return <?php echo $this->linkTo("home","index","Home"); ?> -->
<br>


