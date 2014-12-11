
<?php
if (isset($summary)) 
{
	//FIXME somewhere need to get the local group(s) from the userID
    $localGroup = '';//$summary['userID'];//FIXME need to get the local group from the userID in the DB?
    $waterbody = '';//$summary['townID'];//FIXME need to get lake name (waterbody) from local group, from the userID in the DB
    $town = '';//$summary['userID'];//FIXME need to get town from waterbody from local group from userID
    $ramp = '';
} 
else 
{
    $localGroup = '';
    $waterbody = '';
    $town = '';
    $ramp = '';
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
        echo "action='index.php?rt=surveysummary/update&id=".$summary['summaryID']. "'"; 
    }
    ?> method="post">
    
	<!-- THIS IS THE START OF THE HEADER FOR THE SURVEY SUMMARY -->
	<div style="white-space: nowrap;"><h3>
	<?php echo "NH LAKES 2014 Lake Host Program Ramp Daily Summary Sheet"; ?>
	</h3></div>
	
	<div style="white-space: nowrap;"><h5>
	Date:<input type='date' name='summary[SummaryDate]' <?php if (isset($summary)) echo "value='".$summary['SummaryDate']."'"; ?>>
	<!-- FIXME the lake host will be a fixed read only field if a lake host is logged in, if a group leader is logged in, then
	they can select the users in their group, if admin is logged in they can select any lake host. 
	so need to implement the fixed if(permission == lakehost) and if (permission == admin) etc... -->
	Lake Host Name:<input type='lakeHostName' name='summary[userID]' size="50"<?php if (isset($summary)) echo "value='$summary->lakeHostName'";?>>
	</h5></div>
	
	<div style="white-space: nowrap;"><h5>
	<!-- FIXME these fields are currently not stored anywhere in the database, once 
	they are will need to add them to summary[dbKey] to populate the _POST[] -->
	1<sup>st</sup>Shift Start Time:<input type='FirstShiftStartTime' name='FirstShiftStartTime'> <?php if (isset($summary)) echo "value='$summary->startTime'"; ?>
	Last Shift End Time:<input type='LastShiftEndTime' name='LastShiftEndTime'<?php if (isset($summary)) echo "value='$summary->endTime'"; ?>>
	</h5></div>
	
	<div style="white-space: nowrap;"><h5>
	Local Group Name: <?php echo $this->selectList($localGroups, 
			//FIXME there is no local group in the summary so figure out what to do with the data here
			//there is only userID foreign key where there is a group--but what if there are muliple groups???
			array("name" => /*"summary[localGroup]"*/ "dummyLocalGroupField",
					"id" => "localGroup", "class" => "medium selectmenu"),$localGroup); ?>
	Waterbody: <?php echo $this->selectList($waterbodies, 
			//FIXME there is no waterbody in the DB for survey, only boatrampID foreign key.
			//watrebody may just filter the boatramp selection down, rather than be a stored value.
			array("name" => "dummyWaterbodyField"/*"summary[waterbody]"*/ ,
					 "id" => "waterbody", "class" => "medium selectmenu"),$waterbody); ?>
	</h5></div>
	
	<div style="white-space: nowrap;"><h5>
	Town: <?php echo $this->selectList($towns, 
			//FIXME there is no town in the DB for survey, only boatrampID foreign key.
			//town may just filter the boatramp selection down, rather than be a stored value.
			array("name" => "dummyTownNameField"/*"summary[townName]"*/,
					 "id" => "town", "class" => "medium selectmenu"),$town); ?>
	Ramp Name: <?php echo $this->selectList($ramps, array("name" => "summary[boatrampID]",
					 "id" => "ramp", "class" => "medium selectmenu"),$ramp); ?>
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
  style='mso-bidi-font-weight:normal'><span style='font-size:8.0pt'>State of <st1:place
  w:st="on"><st1:State w:st="on">Boat</st1:State></st1:place> Registration</span></b><b
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
  
  <input type='TotalInspections' name='summary[TotalInspections]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->TotalInspections'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='NH' name='summary[NH]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->NH'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='MA(MS)' name='summary[MA]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->MA'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='ME' name='summary[ME]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->ME'"; ?>>
  
  </span></p>
  </td>
  <td width=32 valign=top style='width:23.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='VT	' name='summary[VT]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->VT'"; ?>>
  
  </span></p>
  </td>
  <td width=37 valign=top style='width:28.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='CT' name='summary[CT]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->CT'"; ?>>
  
  </span></p>
  </td>
  <td width=27 valign=top style='width:20.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='RI' name='summary[RI]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->RI'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='NY' name='summary[NY]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->NY'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='OtherState' name='summary[Other]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->Other'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='IO' name='summary[InboardOutboard]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->InboardOutboard'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='PWCjet' name='summary[PWC]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->PWC'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='CanoeKayak' name='summary[CanoeKayak]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->CanoeKayak'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='Sail' name='summary[Sail]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->Sail'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='OtherBoat' name='summary[OtherBoatType]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->OtherBoatType'"; ?>>
  
  </span></p>
  </td>
  <td width=32 valign=top style='width:24.2pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='PriorYes' name='summary[Previous]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->Previous'"; ?>>
  
  </span></p>
  </td>
  <td width=24 valign=top style='width:.25in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <!-- FIXME this field is not in database yet... 'summary[NoPrevious]' -->
  <input type='PriorNo' name= 'dummyPriorNoField' height="50" size="1"   
  <?php if (isset($summary)) echo "value='$summary->dummyPriorNoField'"; ?>>
  
  </span></p>
  </td>
  <td width=28 valign=top style='width:20.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='DrainYes' name='summary[Drained]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->Drained'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
   <!-- FIXME this field is not in database yet... 'summary[NoDrain]' -->
  <input type='DrainNo' name='dummyDrainNoField' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->dummyDrainNoField'"; ?>>
  
  </span></p>
  </td>
  <td width=24 valign=top style='width:.25in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='RinsedYes' name='summary[Rinsed]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->Rinsed'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <!-- FIXME this field is not in database yet... 'summary[NoRinse]' -->
  <input type='RinsedNo' name='dummyRinsedNoField' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->dummyRinsedNoField'"; ?>>
  
  </span></p>
  </td>

  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='Dry5Yes' name='summary[Dry5]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->Dry5'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <!-- FIXME this field is not in database yet... 'summary[NoDry5]' -->
  <input type='Dry5No' name='dummyDry5NoField' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->dummyDry5NoField'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='BoaterHigh' name='summary[AwarenessHigh]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->AwarenessHigh'"; ?>>
  
  </span></p>
  </td>
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='BoaterMedium' name='summary[AwarenessMedium]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->AwarenessMedium'"; ?>>
  
  </span></p>
  </td>
  <td width=24 valign=top style='width:.25in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='BoaterLow' name='summary[AwarenessLow]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->AwarenessLow'"; ?>>
  
  </span></p>
  </td>
  <td width=24 valign=top style='width:.25in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='SpecimenYes' name='summary[SpeciesFoundYes]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->SpeciesFoundYes'"; ?>>
  
  </span></p>
  </td>
  <td width=24 valign=top style='width:.25in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='SpecimenNo' name='summary[SpeciesFoundNo]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->SpeciesFoundNo'"; ?>>
  
  </span></p>
  </td>
  
  <td width=36 valign=top style='width:27.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:31.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='DESYes' name='summary[SentDesYes]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->SentDesYes'"; ?>>
  
  </span></p>
  
  <td width=24 valign=top style='width:.25in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:51.45pt'>
  <p class=MsoNormal style='tab-stops:85.5pt 1.25in 94.5pt 117.0pt 157.5pt 265.5pt 4.5in 5.25in 387.0pt 391.5pt 6.25in'><span
  style='font-size:10.0pt'><o:p>&nbsp;</o:p>
  
  <input type='DESNo' name='summary[SentDesNo]' height="50" size="1" 
  <?php if (isset($summary)) echo "value='$summary->SentDesNo'"; ?>>
  
  </span></p>
  </td>
 </tr>
</table>
</br>
<input type='submit' value='Submit' />
</form>    