<!-- Include this file to display survey totals in a table -->
<table class="surveytotal">
    <tr>
        <th colspan='2' class="surveytotalheader">Survey Total</th>
    </tr>
    <tr>
        <td id="surveytotalblue"><?php echo $lakeHostGroupName; ?> has completed:</td>
        <td><?php echo $surveyTotalGroup ?> surveys</td>
    </tr>
    <tr>
        <td id="surveytotalblue"><?php echo $_SESSION['firstName'] . ' ' . $_SESSION['lastName']; ?> has completed:</td>
        <td><?php echo $surveyTotalUser ?> surveys</td>
    </tr>
    <tr>
        <td id="surveytotalblue">Total completed by all hosts:</td>
        <td><?php echo $surveyTotal ?> surveys</td>
    </tr>
</table>
<br/>
<input type="button" onclick="location.href='/nhvbsr/model/export.php';" value="Export Survey Summary Data"/>