
<?php
if (isset($summary)) 
{
    $waterbody = $summary['waterbody'];
    $town = $summary['town'];
    $rampName = $summary['boatRampName'];
    $lakeHostName = $summary['lakeHostName'];
    $localGroup = $summary['localGroup'];
} 
else 
{
    $localGroup = '';
    $waterbody = '';
    $town = '';
    $rampName = '';
    $lakeHostName = '';
}
?>

<form id="surveySummaryForm"
	<?php 
    if (!isset($summary))
    {
        echo "action='index.php?rt=surveysummary/create' ";
    }
    else
    {
        echo "action='index.php?rt=surveysummary/update&id=".$summary['ID']. "'"; 
    }
    ?> method="post">
    
	<!-- THIS IS THE START OF THE HEADER FOR THE SURVEY SUMMARY -->
	<div style="white-space: nowrap;"><h3>
	<?php echo "NH LAKES 2014 Lake Host Program Ramp Daily Summary Sheet"; ?>
	</h3></div>
	
	<div style="white-space: nowrap;"><h5>
	Date (YYYY-M-D):<input type='date' name='summary[summaryDate]' 
		<?php if (isset($summary)) echo "value='".$summary['summaryDate']."'"; ?>>
	<!-- FIXME the lake host should be a fixed read only field if a lake host is logged in, if a group leader is logged in, then
	they can select the users in their group, if admin is logged in they can select any lake host. 
	so need to implement the fixed if(permission == lakehost) and if (permission == admin) etc... -->
	Lake Host Name:<?php echo $this->selectList($lakeHostNames, 
			array("name" => "summary[lakeHostName]", "id" => "lakeHostName", "class" => "medium selectmenu"),$lakeHostName); ?>
	</h5></div>
	
	<div style="white-space: nowrap;"><h5>
	1<sup>st</sup>Shift Start Time (H:MM):<input type='datetime' name='summary[startShiftTime]'
		<?php
		if (isset($summary))
		{
			//remove the leading date from the string
			$pos = strpos($summary['startShiftTime'], " ");
			$time = substr($summary['startShiftTime'], $pos + 1);
			echo "value='".$time."'";
		}?>>
	Last Shift End Time (H:MM):<input type='datetime' name='summary[endShiftTime]'
		<?php 
		if (isset($summary)) 
		{
			//remove the leading date from the string
			$pos = strpos($summary['endShiftTime'], " ");
			$time = substr($summary['endShiftTime'], $pos + 1);
			echo "value='".$time."'"; 
		}?>>

	</h5></div>
	
	<div style="white-space: nowrap;"><h5>
	Local Group Name: <?php echo $this->selectList($localGroups, 
			array("name" => "summary[localGroup]", "id" => "localGroup", "class" => "medium selectmenu"),$localGroup); ?>
	<!-- waterbody is not stored in the summary database table, it is intended to help filter the boat ramp selection -->
	Waterbody: <?php echo $this->selectList($waterbodies,
			array("name" => "summary[waterbody]", "id" => "waterbody", "class" => "medium selectmenu"),$waterbody); ?>
	</h5></div>
	
	<div style="white-space: nowrap;"><h5>
	<!-- town is not stored in the database summary table, it is intended to help filter the boat ramp selection -->
	Town: <?php echo $this->selectList($towns, 
			array("name" => "summary[town]", "id" => "town", "class" => "medium selectmenu"),$town); ?>
	Ramp Name: <?php echo $this->selectList($rampNames, array("name" => "summary[boatRampName]",
					 "id" => "ramp", "class" => "medium selectmenu"),$rampName); ?>
	</h5></div>

<!-- THIS IS THE START OF THE TABLE CONTAINING THE SURVEY SUMMARY TOTALS DATA-->
<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width=996
 style='width:747.35pt;margin-left:-3.95pt;border-collapse:collapse;border:
 none;mso-border-alt:solid windowtext .5pt;mso-yfti-tbllook:480;mso-padding-alt:
 0in 5.4pt 0in 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=36 rowspan=2 valign=top style='width:27.35pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:8.0pt'>Page # <o:p></o:p></span></b></p>
  </td>
  <td width=48 rowspan=2 valign=top style='width:.5in;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'># Inspect<o:p></o:p></span></p>
  </td>
  <td width=276 colspan=8 valign=top style='width:207.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:8.0pt'>State of <st1:placew:st="on">
  <st1:State w:st="on">Boat</st1:State></st1:place> Registration</span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-size:7.5pt'><o:p></o:p></span></b></p>
  </td>
  <td width=180 colspan=5 valign=top style='width:135.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:8.0pt'>Type of
  Boat<o:p></o:p></span></b></p>
  </td>
  <td width=56 colspan=2 valign=top style='width:42.2pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:8.0pt'>Prior </span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-size:7.0pt'>interaction<span
  style='mso-spacerun:yes'> </span></span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-size:8.0pt'>with LH?<o:p></o:p></span></b></p>
  </td>
  <td width=64 colspan=2 valign=top style='width:47.8pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:8.0pt'>Drain after
  last </span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-size:7.5pt'>water-body?</span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-size:8.0pt'><o:p></o:p></span></b></p>
  </td>
  <td width=60 colspan=2 valign=top style='width:45.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:8.0pt'>Rinsed after
  last <o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:8.0pt'>water-body?<o:p></o:p></span></b></p>
  </td>
  <td width=72 colspan=2 valign=top style='width:.75in;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:8.0pt'>Dry for at
  least 5 days since last water-body?<o:p></o:p></span></b></p>
  </td>
  <td width=108 colspan=3 valign=top style='width:81.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:8.0pt'>Boater
  Awareness<o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:1.3in 102.6pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:8.0pt'>AIS <span
  style='mso-spacerun:yes'> </span>Problem?<o:p></o:p></span></b></p>
  </td>
  <td width=48 colspan=2 valign=top style='width:.5in;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:8.0pt'>Specimen
  Found?<o:p></o:p></span></b></p>
  </td>
  <td width=48 colspan=2 valign=top style='width:.5in;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:8.0pt'>Sent to
  DES?<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:15.7pt'>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>NH<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>MA </span><span style='font-size:7.0pt'>(MS)</span><span
  style='font-size:8.0pt'><o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>ME<o:p></o:p></span></p>
  </td>
  <td width=32 style='width:23.95pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>VT<o:p></o:p></span></p>
  </td>
  <td width=37 style='width:28.05pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>CT<o:p></o:p></span></p>
  </td>
  <td width=27 style='width:20.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>RI<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>NY<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:7.0pt'>Other<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>I/O<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:7.0pt'>PWC<o:p></o:p></span></p>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:7.0pt'>jet<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:6.0pt'>Canoe<o:p></o:p></span></p>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:6.5pt'>kayak</span><span style='font-size:7.0pt'><o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:6.5pt'>Sail<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:7.0pt'>Other<o:p></o:p></span></p>
  </td>
  <td width=32 style='width:24.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>Y<o:p></o:p></span></p>
  </td>
  <td width=24 style='width:.25in;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>N<o:p></o:p></span></p>
  </td>
  <td width=28 style='width:20.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>Y<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>N<o:p></o:p></span></p>
  </td>
  <td width=24 style='width:.25in;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>Y<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>N<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>Y<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>N<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>H<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>M<o:p></o:p></span></p>
  </td>
  <td width=36 style='width:27.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>L<o:p></o:p></span></p>
  </td>
  <td width=24 style='width:.25in;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>Y<o:p></o:p></span></p>
  </td>
  <td width=24 style='width:.25in;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>N<o:p></o:p></span></p>
  </td>
  <td width=24 style='width:.25in;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>Y<o:p></o:p></span></p>
  </td>
  <td width=24 style='width:.25in;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:15.7pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:8.0pt'>N<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes;height:31.45pt'>
  <td width=36 style='width:27.35pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:6.0pt'>T<o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:6.0pt'>O<o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:6.0pt'>T<o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:6.0pt'>A<o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:6.0pt'>L<o:p></o:p></span></b></p>
  </td>
  <td width=48 valign=top style='width:.5in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[totalInspections]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['totalInspections']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[NH]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['NH']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[MA]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['MA']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[ME]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['ME']."'"; ?>>
  
  </span></p>
  </td>
  <td width=32 valign=top style='width:23.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[VT]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['VT']."'"; ?>>
  
  </span></p>
  </td>
  <td width=37 valign=top style='width:28.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[CT]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['CT']."'"; ?>>
  
  </span></p>
  </td>
  <td width=27 valign=top style='width:20.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[RI]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['RI']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[NY]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['NY']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[other]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['other']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[inboardOutboard]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['inboardOutboard']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[pwc]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['pwc']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[canoeKayak]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['canoeKayak']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[sail]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['sail']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[otherBoatType]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['otherBoatType']."'"; ?>>
  
  </span></p>
  </td>
  <td width=32 valign=top style='width:24.2pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[previous]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['previous']."'"; ?>>
  
  </span></p>
  </td>
  <td width=24 valign=top style='width:.25in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name= 'summary[notPrevious]' height="50" size="1"   
  <?php if (isset($summary)) echo "value='".$summary['notPrevious']."'"; ?>>
  
  </span></p>
  </td>
  <td width=28 valign=top style='width:20.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[drained]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['drained']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[notDrained]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['notDrained']."'"; ?>>
  
  </span></p>
  </td>
  <td width=24 valign=top style='width:.25in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[rinsed]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['rinsed']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type=number name='summary[notRinsed]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['notRinsed']."'"; ?>>
  
  </span></p>
  </td>

  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[dry5]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['dry5']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[notDry5]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['notDry5']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[awarenessHigh]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['awarenessHigh']."'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[awarenessMedium]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['awarenessMedium']."'"; ?>>
  
  </span></p>
  </td>
  <td width=24 valign=top style='width:.25in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[awarenessLow]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['awarenessLow']."'"; ?>>
  
  </span></p>
  </td>
  <td width=24 valign=top style='width:.25in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[speciesFoundYes]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['speciesFoundYes']."'"; ?>>
  
  </span></p>
  </td>
  <td width=24 valign=top style='width:.25in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[speciesFoundNo]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['speciesFoundNo']."'"; ?>>
  
  </span></p>
  </td>
  
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[sentDesYes]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['sentDesYes']."'"; ?>>
  
  </span></p>
  
  <td width=24 valign=top style='width:.25in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:51.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='number' name='summary[sentDesNo]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='".$summary['sentDesNo']."'"; ?>>
  
  </span></p>
  </td>
 </tr>
</table>
</br>
<input type='submit' value='Submit' />
</form>    