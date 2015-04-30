<h1><?php echo $welcome ?></h1>

<?php
/**
File: View: rampReports.php
Date: 4/29/2015
Author: Reporting Group 2015
Info: Displays the report created from build report on the reporting page. See Model:Report.php and View:Report.php.
**/

// Build report if there is no report available. If data is available the report will be displayed.
echo "<h2>States</h2>";
if ($rampstate !="")
	echo $this->buildReport($rampstate);
else
	// If no data is available or there is no database connection, the following will be displayed.
	echo "<h2> There are no Survey Summaries in the system. </h2>";
	
echo "<h2>Boat Types</h2>";
if ($rampboat !="")
	echo $this->buildReport($rampboat);
else
	// If no data is available or there is no database connection, the following will be displayed.
	echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>All Previous Lake Host Interactions</h2>";
if ($rampprev !="")
	echo $this->buildReport($rampprev);
else
	// If no data is available or there is no database connection, the following will be displayed.
	echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>Drained and Not Drained Totals</h2>";
if ($rampdrained !="")
	echo $this->buildReport($rampdrained);
else
	// If no data is available or there is no database connection, the following will be displayed.
	echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>Rinsed and Not Rinsed Totals</h2>";
if ($ramprinsed !="")
	echo $this->buildReport($ramprinsed);
else
	// If no data is available or there is no database connection, the following will be displayed.
	echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>Dried and Not Dried Totals</h2>";
if ($rampdried !="")
	echo $this->buildReport($rampdried);
else
	// If no data is available or there is no database connection, the following will be displayed.
	echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>Awareness Totals</h2>";
if ($rampaware !="")
	echo $this->buildReport($rampaware);
else
	// If no data is available or there is no database connection, the following will be displayed.
	echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>Specimen Found</h2>";
if ($rampfound !="")
	echo $this->buildReport($rampfound);
else
	// If no data is available or there is no database connection, the following will be displayed.
	echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>Specimen Sent</h2>";
if ($rampsent !="")
	echo $this->buildReport($rampsent);
else
	// If no data is available or there is no database connection, the following will be displayed.
	echo "<h2> There are no Survey Summaries in the system. </h2>";

?><br><br>
<!-- Displays the reporting page link back to the reports page. -->
Return <?php echo $this->linkTo("report","index","Reports Home"); ?><br>
<!-- Displays the home link to return back to the home page. -->
Return <?php echo $this->linkTo("home","index","Home"); ?>
<br>


