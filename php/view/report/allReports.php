<h1><?php echo $welcome ?></h1>

<?php
/**
 * File: View: allReports.php
 * Date: 4/29/2015
 * Author: Reporting Group 2015
 * Info: Displays all reports created from build report function. See Model:Report.php and Controller:Report.php.
 **/

// Build report if there is no report available. If data is available the report will be displayed.
echo "<h2>States</h2>";
if ($allstate != "")
    echo $this->buildReport($allstate);
else
    // If no data is available or there is no database connection, the following will be displayed.
    echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>Boat Types</h2>";
if ($allboat != "")
    echo $this->buildReport($allboat);
else
    // If no data is available or there is no database connection, the following will be displayed.
    echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>All Previous Lake Host Interactions</h2>";
if ($allprev != "")
    echo $this->buildReport($allprev);
else
    // If no data is available or there is no database connection, the following will be displayed.
    echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>Drained and Not Drained Totals</h2>";
if ($alldrained != "")
    echo $this->buildReport($alldrained);
else
    // If no data is available or there is no database connection, the following will be displayed.
    echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>Rinsed and Not Rinsed Totals</h2>";
if ($allrinsed != "")
    echo $this->buildReport($allrinsed);
else
    // If no data is available or there is no database connection, the following will be displayed.
    echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>Dried and Not Dried Totals</h2>";
if ($alldried != "")
    echo $this->buildReport($alldried);
else
    // If no data is available or there is no database connection, the following will be displayed.
    echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>Awareness Totals</h2>";
if ($allaware != "")
    echo $this->buildReport($allaware);
else
    // If no data is available or there is no database connection, the following will be displayed.
    echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>Specimen Found</h2>";
if ($allfound != "")
    echo $this->buildReport($allfound);
else
    // If no data is available or there is no database connection, the following will be displayed.
    echo "<h2> There are no Survey Summaries in the system. </h2>";

echo "<h2>Specimen Sent</h2>";
if ($allsent != "")
    echo $this->buildReport($allsent);
else
    // If no data is available or there is no database connection, the following will be displayed.
    echo "<h2> There are no Survey Summaries in the system. </h2>";

?><br><br>
<!-- Displays the reporting page link back to the reports page. -->
Return <?php echo $this->linkTo("report", "index", "Reports Home"); ?><br>
<!-- Displays the home link to return back to the home page. -->
Return <?php echo $this->linkTo("home", "index", "Home"); ?>
<br>


