<!DOCTYPE>
<html>
    <head>
        <!-- CSS -->
       <!--  <link rel="stylesheet" href="assets/css/jplist-core.min.css" />-->
      <!--   <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" /> -->
      
 
      <!--   <link rel="stylesheet" href="assets/css/application.css" /> -->
      <!--   <link rel="stylesheet" href="assets/css/jquery-ui.theme.css" /> -->
      <!--   <link rel="stylesheet" href="assets/css/jplist-textbox-control.min.css" /> -->
      <!--   <link rel="stylesheet" href="assets/css/jplist-pagination-bundle.min.css" />  -->
        
                <!-- Jquery Stuff -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
        <script src="assets/js/jquery-custom.js"></script>
        <script src="assets/js/jquery.validate.js"></script>
        <script src="assets/js/jplist-core.min.js"></script>
        <script src="assets/js/jplist.textbox-control.min.js"></script>
        <script src="assets/js/jplist.pagination-bundle.min.js"></script>   
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
		<script src="assets/js/maps-custom.js"></script>   
      
		
		<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
		<title> NHLakes Survey System</title>
		<link rel="stylesheet" href="assets/css/PrimaryStyle.css" type="text/css" /> 
		
    </head>


<!--
*  CSS Author: Camden C. Marble
-->

<body>

<div id="container"> 
	<div id="header">	
		<a href="http://nhlakes.org/">
        <img src="assets/images/nh_lakes_logo.png" height="75px" width="150px" style="float:right;">	
        <img src="assets/images/UNHLogo.png" height="75" width="175px" style="float:left;">
	</div>
				
	<div id="navigation">
		<?php   require_once 'view/partials/_navigation.php'; ?>
	</div>
			
	<div id="content-container"> 		
			<div id="article">
			
			</div>	
		
			<div id="aside">
				<div id="custom1">

				<?PHP
				$registry->template = new template($registry);
				?>
			<!-- TEMPLATE>Include $Path  MUST GO HERE!!!!!!! 
				<h1> Do Not Revert</h1>
				<h2> Only 1 thing to change and all the views should be fixed!</h2>
				<p>If you look under View>Layout>ApplicationView.PHP you'll see this text. <br>
				The code from PHP>Application>Template.php needs to somehow be called in this area. <br>
				Please ask me any questions </p>
				
				<h1>I NEED A PROGRAMER TO LOOK AT THIS PLEASE</h1>
			-->
			
			  </div>
			</div>
	</div> 
	
	<div id="footer">

	</div>
	
</div> 


</body>
</html>





