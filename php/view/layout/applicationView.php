<!-- CSS -->
<!--  <link rel="stylesheet" href="assets/css/jplist-core.min.css" />-->
<!--   <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" /> -->


<!--   <link rel="stylesheet" href="assets/css/application.css" /> -->
<!--   <link rel="stylesheet" href="assets/css/jquery-ui.theme.css" /> -->
<!--   <link rel="stylesheet" href="assets/css/jplist-textbox-control.min.css" /> -->
<!--   <link rel="stylesheet" href="assets/css/jplist-pagination-bundle.min.css" />  -->

<!-- Jquery Stuff -->
<!--  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<!--  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script> -->
<!-- <script src="assets/js/jquery-custom.js"></script> -->
<!--  <script src="assets/js/jquery.validate.js"></script> -->
<!--  <script src="assets/js/jplist-core.min.js"></script> -->
<!--  <script src="assets/js/jplist.textbox-control.min.js"></script> -->
<!--  <script src="assets/js/jplist.pagination-bundle.min.js"></script> -->
<!--  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script> -->
<!-- <script src="assets/js/maps-custom.js"></script> -->


<!-- <meta http-equiv="Content-Type" content="text/html; charset=Cp1252"> -->
<!-- bgcolor="#285685" -->
<html bgcolor="#285685">
<head>

    <title> New Hampshire Lakes Survey System</title>
    <link rel="stylesheet" href="assets/css/PrimaryStyle.css" type="text/css"/>

</head>


<!--
*  CSS Author: Camden C. Marble
-->
<!-- bgcolor="#285685" -->
<body bgcolor="#285685">

<div id="container">
    <div id="header">
        <br/>
		<div align="center">
        <table class="BannerTableCenter">
		<tr>
			<td Class="BannerTableLeft">
				<img src="assets/images/UNHLogo.png" height="100px" width="150px">

			</td>
			<td class="BannerTableCenter">

				<h2 align="center">New Hampshire Lakes</h2>
				<h1 align="center">Survey System</h1>

			</td>
			<td class="BannerTableRight">
				<a href="http://nhlakes.org/"><img src="assets/images/nh_lakes_logo.png" height="100px" width="150px"> </a>

			</td>
		</tr>
		</table>
		</div>
    </div>

    <div id="navigation">
	<table>
	<tr>
        <img src="assets/images/banner.png" height="90%" width="100%">
	</tr>
	<tr>
        <?php require_once 'view/partials/_navigation.php'; ?>
	</tr>
	</table?	
    </div>

    <!-- <div id="content-container"> -->
    <div id="article">

    </div>

    <div id="aside">
        <div id="custom1">
            <br/>
           
			<?PHP
            global $path;
            require_once $path;	
            ?>


        </div>
    </div>
    <!-- </div> -->

    <div id="footer">
        <br/>
        <p> New Hampshire Lakes Survey System </p>

    </div>

</div>


</body>
</html>





