<h1><?php echo $welcome ?></h1>

<?php
/**
File: View: Index.php
Date: 4/27/2015
Author: Reporting Group 2015
Info: Displays the report created from build report on the reporting page. See Model:Report.php and View:Report.php.
**/

// Build report if there is no report available. If data is available the report will be displayed.

echo $this->buttonTo("report", "allReports", "All");
echo $this->buttonTo("report", "allDateReports", "By Date");
echo $this->buttonTo("report","rampReports", "By Boat Ramp");
echo $this->buttonTo("report","groupReports", "By Lake Host Group");

?><br><br>
<!-- Displays the home link to return back to the home page. -->
Return <?php echo $this->linkTo("home","index","Home"); ?>
<br>


