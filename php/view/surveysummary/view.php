<?php
if (isset($summary)) {
    $waterbody = $summary['waterbody'];
    $town = $summary['town'];
    $rampName = $summary['boatRampName'];
    $lakeHostName = $summary['lakeHostName'];
    $localGroup = $summary['localGroup'];
} else {
    $localGroup = '';
    $waterbody = '';
    $town = '';
    $rampName = '';
    $lakeHostName = '';
}
?>

<!-- THIS IS THE START OF THE HEADER FOR THE SURVEY SUMMARY -->
<div style="white-space: nowrap;"><h3>
        <?php echo "NH LAKES 2014 Lake Host Program Ramp Daily Summary Sheet"; ?>
    </h3></div>

<div style="white-space: nowrap;"><h5>
        Date (YYYY-M-D):<input type='date' name='summary[summaryDate]'
            <?php if (isset($summary)) echo "value='" . $summary['summaryDate'] . "'"; ?>>
        <!-- FIXME the lake host should be a fixed read only field if a lake host is logged in, if a group leader is logged in, then
        they can select the users in their group, if admin is logged in they can select any lake host.
        so need to implement the fixed if(permission == lakehost) and if (permission == admin) etc... -->
        Lake Host Name:<?php echo $this->selectList($lakeHostNames,
            array("name" => "summary[lakeHostName]", "id" => "lakeHostName", "class" => "medium selectmenu"), $lakeHostName); ?>
    </h5></div>

<div style="white-space: nowrap;"><h5>
        1<sup>st</sup>Shift Start Time (H:MM):<input type='datetime' name='summary[startShiftTime]'
            <?php
            if (isset($summary)) {
                //remove the leading date from the string
                $pos = strpos($summary['startShiftTime'], " ");
                $time = substr($summary['startShiftTime'], $pos + 1);
                echo "value='" . $time . "'";
            } ?>>
        Last Shift End Time (H:MM):<input type='datetime' name='summary[endShiftTime]'
            <?php
            if (isset($summary)) {
                //remove the leading date from the string
                $pos = strpos($summary['endShiftTime'], " ");
                $time = substr($summary['endShiftTime'], $pos + 1);
                echo "value='" . $time . "'";
            } ?>>

    </h5></div>

<div style="white-space: nowrap;"><h5>
        Local Group Name: <?php echo $this->selectList($localGroups,
            array("name" => "summary[localGroup]", "id" => "localGroup", "class" => "medium selectmenu"), $localGroup); ?>
        <!-- waterbody is not stored in the summary database table, it is intended to help filter the boat ramp selection -->
        <!-- Waterbody: --> <?php //echo $this->selectList($waterbodies,array("name" => "summary[waterbody]", "id" => "waterbody", "class" => "medium selectmenu"),$waterbody); ?>
    </h5></div>

<div style="white-space: nowrap;"><h5>
        <!-- town is not stored in the database summary table, it is intended to help filter the boat ramp selection -->
        <!-- Town: --> <?php // echo $this->selectList($towns,
        // 			array("name" => "summary[town]", "id" => "town", "class" => "medium selectmenu"),$town); ?>
        Ramp Name: <?php echo $this->selectList($rampNames, array("name" => "summary[boatRampName]",
            "id" => "ramp", "class" => "medium selectmenu"), $rampName); ?>
    </h5></div>

<!-- THIS IS THE START OF THE TABLE CONTAINING THE SURVEY SUMMARY TOTALS DATA-->

Number Inspected
<input type='number' name='summary[totalInspections]'
    <?php if (isset($summary)) echo "value='" . $summary['totalInspections'] . "'"; ?> />
<br><br>
<strong>Totals</strong>
<br><br>
<strong>State Boat Registration</strong>
<table border="0" cellpadding="10" cellspacing="3">
    <tr>
        <td>NH</td>
        <td>MA<br>(MS)</td>
        <td>ME</td>
        <td>VT</td>
        <td>CT</td>
        <td>RI</td>
        <td>NY</td>
        <td>Other</td>
    </tr>
    <tr>
        <td>
            <?php if (isset($summary)) echo $summary['NH']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['MA']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['ME']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['VT']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['CT']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['RI']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['NY']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['other']; ?>
        </td>
    </tr>
</table>

<strong>Type of Boat</strong>
<table border="0" cellpadding="10" cellspacing="3">
    <tr>
        <td>I/O</td>
        <td>PWC<br>jet</td>
        <td>Canoe<br>kayak</td>
        <td>Sail</td>
        <td>Other</td>
    </tr>
    <tr>
        <td>
            <?php if (isset($summary)) echo $summary['inboardOutboard']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['pwc']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['canoeKayak']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['sail']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['otherBoatType']; ?>
        </td>
    </tr>
</table>

<strong>Prior interaction with Lake Host?</strong>
<table border="0" cellpadding="10" cellspacing="3">
    <tr>
        <td>Yes</td>
        <td>No</td>
    </tr>
    <tr>
        <td>
            <?php if (isset($summary)) echo $summary['previous']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['notPrevious']; ?>
        </td>
    </tr>
</table>

<strong>Drained after last waterbody?</strong>
<table border="0" cellpadding="10" cellspacing="3">
    <tr>
        <td>Yes</td>
        <td>No</td>
    </tr>
    <tr>
        <td>
            <?php if (isset($summary)) echo $summary['drained']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['notDrained']; ?>
        </td>
    </tr>
</table>

<strong>Rinsed after last waterbody?</strong>
<table border="0" cellpadding="10" cellspacing="3">
    <tr>
        <td>Yes</td>
        <td>No</td>
    </tr>
    <tr>
        <td>
            <?php if (isset($summary)) echo $summary['rinsed']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['notRinsed']; ?>
        </td>
    </tr>
</table>

<strong>Dry for at least 5 days since last waterbody?</strong>
<table border="0" cellpadding="10" cellspacing="3">
    <tr>
        <td>Yes</td>
        <td>No</td>
    </tr>
    <tr>
        <td>
            <?php if (isset($summary)) echo $summary['dry5']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['notDry5']; ?>
        </td>
    </tr>
</table>

<strong>Boater awareness of AIS problem</strong>
<table border="0" cellpadding="10" cellspacing="3">
    <tr>
        <td>High</td>
        <td>Medium</td>
        <td>Low</td>
    </tr>
    <tr>
        <td>
            <?php if (isset($summary)) echo $summary['awarenessHigh']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['awarenessMedium']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['awarenessLow']; ?>
        </td>
    </tr>
</table>

<strong>Specimen found?</strong>
<table border="0" cellpadding="10" cellspacing="3">
    <tr>
        <td>Yes</td>
        <td>No</td>
    </tr>
    <tr>
        <td>
            <?php if (isset($summary)) echo $summary['speciesFoundYes']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['speciesFoundNo']; ?>
        </td>
    </tr>
</table>

<strong>Sent to DES?</strong>
<table border="0" cellpadding="10" cellspacing="3">
    <tr>
        <td>Yes</td>
        <td>No</td>
    </tr>
    <tr>
        <td>
            <?php if (isset($summary)) echo $summary['sentDesYes']; ?>
        </td>
        <td>
            <?php if (isset($summary)) echo $summary['sentDesNo']; ?>
        </td>
    </tr>
</table>

</form>    