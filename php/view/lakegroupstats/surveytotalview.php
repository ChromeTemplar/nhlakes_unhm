<!-- Include this file to display survey totals in a table -->
<table class="surveytotal">
    <tr>
        <th colspan='2' class="surveytotalheader">Survey Total</th>
    </tr>
    <tr>
        <td id="surveytotalblue">Group: <?php echo $lakeHostGroupName; ?></td>
        <td><?php echo $surveyTotalGroup ?></td>
    </tr>
    <tr>
        <td id="surveytotalblue">User: <?php echo $_SESSION['firstName'].' '.$_SESSION['lastName']; ?></td>
        <td><?php echo $surveyTotalUser ?></td>
    </tr>
    <tr>
        <td id="surveytotalblue">Total</td>
        <td><?php echo $surveyTotal ?></td>
    </tr>
</table>
<br />