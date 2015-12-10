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

<form id="surveySummaryForm"
    <?php
    if (!isset($summary)) {
        echo "action='index.php?rt=surveysummary/create' ";
    } else {
        echo "action='index.php?rt=surveysummary/update&id=" . $summary['ID'] . "'";
    }
    ?> method="post">

    <!-- THIS IS THE START OF THE HEADER FOR THE SURVEY SUMMARY -->
    <div style="white-space: nowrap;"><h2><b>
                <?php echo "NH LAKES 2015 Lake Host Daily Summary Sheet"; ?>
        </h2></b></div>

    <div style="white-space: nowrap;">
        <hr>
        <h5>
            Date (YYYY-M-D):
            <input type='date' name='summary[summaryDate]'
                <?php
                $date = new DateTime();

                echo "value='" . $date->format('Y-m-d') . "'";
                ?>>


            <!-- FIXME the lake host should be a fixed read only field if a lake host is logged in, if a group leader is logged in, then
            they can select the users in their group, if admin is logged in they can select any lake host.
            so need to implement the fixed if(permission == lakehost) and if (permission == admin) etc... -->


            Lake Host Name:<?php echo $this->selectList($lakeHostNames,
                array("name" => "summary[lakeHostName]", "id" => "lakeHostName", "class" => "medium selectmenu"), $lakeHostName); ?>
        </h5></div>

    <div style="white-space: nowrap;"><h5>
            Is this a summary for an entire work day or a single shift?
            <input
                onclick="document.getElementById('startTime').disabled = true; document.getElementById('endTime').disabled = true;"
                type='radio' name='fullDay' id='fullDayYes' value='yes'>Full day
            <input
                onclick="document.getElementById('startTime').disabled = false; document.getElementById('endTime').disabled = false;"
                type='radio' name='fullDay' id='fullDayNo' value='no'>Single shift
    </div>
    </h5>

    <div style="white-space: nowrap;"><h5>
            1<sup>st</sup>Shift Start Time (H:MM):<input type='time' name='summary[startShiftTime]' id='startTime'
                <?php
                if (isset($summary)) {
                    //remove the leading date from the string
                    $pos = strpos($summary['startShiftTime'], " ");
                    $time = substr($summary['startShiftTime'], $pos + 1);
                    echo "value='" . $time . "'";
                } ?>>
            Last Shift End Time (H:MM):<input type='time' name='summary[endShiftTime]' id='endTime'
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
            Waterbody: <?php echo $this->selectList($waterbodies,
                array("name" => "summary[waterbody]", "id" => "waterbody", "class" => "medium selectmenu"), $waterbody); ?>
            <!-- town is not stored in the database summary table, it is intended to help filter the boat ramp selection -->
    </div>
    </h5>
    <div style="white-space: nowrap;"><h5>
            Town: <?php echo $this->selectList($towns,
                array("name" => "summary[town]", "id" => "town", "class" => "medium selectmenu"), $town); ?>
            Ramp Name: <?php echo $this->selectList($rampNames, array("name" => "summary[boatRampName]",
                "id" => "ramp", "class" => "medium selectmenu"), $rampName); ?>
        </h5></div>

    <!-- THIS IS THE START OF THE TABLE CONTAINING THE SURVEY SUMMARY TOTALS DATA-->

    Number Inspected
    <input type='number' name='summary[totalInspections]'
        <?php if (isset($summary)) echo "value='" . $summary['totalInspections'] . "'"; ?> />
    <br></br>
    <hr>
    <u><h2><b>Totals</b></h2></h2></u>
    <br></br>
    <strong>State Boat Registration</strong>
    <table border="0" cellpadding="1" cellspacing="1">
        <tr>
            <td>NH</td>
            <td>MA<br>(MS)</td>
            <td>ME</td>
            <td>VT</td>
        </tr>
        <tr>
            <td>
                <input type='number' name='summary[NH]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['NH'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[MA]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['MA'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[ME]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['ME'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[VT]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['VT'] . "'"; ?> />
            </td>
        </tr>
        <tr>
            <td>CT</td>
            <td>RI</td>
            <td>NY</td>
            <td>Other</td>
        </tr>
        <tr>
            <td>
                <input type='number' name='summary[CT]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['CT'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[RI]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['RI'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[NY]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['NY'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[other]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['other'] . "'"; ?> />
            </td>
        </tr>
    </table>

    <strong>Type of Boat</strong>
    <table border="0" cellpadding="1" cellspacing="1">
        <tr>
            <td>I/O</td>
            <td>PWC<br>jet</td>
            <td>Canoe<br>kayak</td>
            <td>Sail</td>
            <td>Other</td>
        </tr>
        <tr>
            <td>
                <input type='number' name='summary[inboardOutboard]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['inboardOutboard'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[pwc]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['pwc'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[canoeKayak]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['canoeKayak'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[sail]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['sail'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[otherBoatType]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['otherBoatType'] . "'"; ?> />
            </td>
        </tr>
    </table>

    <strong>Prior interaction with Lake Host?</strong>
    <table border="0" cellpadding="1" cellspacing="1">
        <tr>
            <td>Yes</td>
            <td>No</td>
        </tr>
        <tr>
            <td>
                <input type='number' name='summary[previous]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['previous'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[notPrevious]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['notPrevious'] . "'"; ?> />
            </td>
        </tr>
    </table>

    <strong>Drained after last waterbody?</strong>
    <table border="0" cellpadding="1" cellspacing="1">
        <tr>
            <td>Yes</td>
            <td>No</td>
        </tr>
        <tr>
            <td>
                <input type='number' name='summary[drained]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['drained'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[notDrained]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['notDrained'] . "'"; ?> />
            </td>
        </tr>
    </table>

    <strong>Rinsed after last waterbody?</strong>
    <table border="0" cellpadding="1" cellspacing="1">
        <tr>
            <td>Yes</td>
            <td>No</td>
        </tr>
        <tr>
            <td>
                <input type='number' name='summary[rinsed]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['rinsed'] . "'"; ?> />
            </td>
            <td>
                <input type="number" name='summary[notRinsed]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['notRinsed'] . "'"; ?> />
            </td>
        </tr>
    </table>

    <strong>Dry for at least 5 days since last waterbody?</strong>
    <table border="0" cellpadding="1" cellspacing="1">
        <tr>
            <td>Yes</td>
            <td>No</td>
        </tr>
        <tr>
            <td>
                <input type='number' name='summary[dry5]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['dry5'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[notDry5]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['notDry5'] . "'"; ?> />
            </td>
        </tr>
    </table>

    <strong>Boater awareness of AIS problem</strong>
    <table border="0" cellpadding="1" cellspacing="1">
        <tr>
            <td>High</td>
            <td>Medium</td>
            <td>Low</td>
        </tr>
        <tr>
            <td>
                <input type='number' name='summary[awarenessHigh]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['awarenessHigh'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[awarenessMedium]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['awarenessMedium'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[awarenessLow]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['awarenessLow'] . "'"; ?> />
            </td>
        </tr>
    </table>

    <strong>Specimen found?</strong>
    <table border="0" cellpadding="1" cellspacing="1">
        <tr>
            <td>Yes</td>
            <td>No</td>
        </tr>
        <tr>
            <td>
                <input type='number' name='summary[speciesFoundYes]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['speciesFoundYes'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[speciesFoundNo]' min='0'
                    <?php if (isset($summary)) echo "value='" . $summary['speciesFoundNo'] . "'"; ?> />
            </td>
        </tr>
    </table>

    <!--  <strong>Sent to DES?</strong> 
    <table border="0" cellpadding="1" cellspacing="1">
        <tr>
            <td>Yes</td>
            <td>No</td>
        </tr>
        <tr>
            <td>
                <input type='number' name='summary[sentDesYes]' min='0'
                    <//?php if (isset($summary)) echo "value='" . $summary['sentDesYes'] . "'"; ?> />
            </td>
            <td>
                <input type='number' name='summary[sentDesNo]' min='0'
                    <//?php if (isset($summary)) echo "value='" . $summary['sentDesNo'] . "'"; ?> />
            </td>
        </tr>
    </table> --> 


    </br>
    <input type='submit' value='Submit'/>
</form>
  