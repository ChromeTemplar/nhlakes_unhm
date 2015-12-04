<!--
*  CSS Author: Camden C. Marble
-->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title> Lakes Lay Monitoring - Standard Mode</title>
<link rel="stylesheet" href="assets/css/PrimaryStyle.css" type="text/css" /> 
</head>
<body>

<div id="container"> 
	<div id="header">	
			
		<h1>Welcome to NHLSS</h1>		
	</div>
				
	<div id="navigation">
	
	</div>
			
	<div id="content-container"> 		
			<div id="article">
			
			</div>	
		
			<div id="aside">
				<div id="custom1">
				<form action="index.php?rt=home/index" method="post">
				<input type="text" name="userId" value="User ID" class="userId" onblur="onBlur(this)" onfocus="onFocus(this)"/> <br />
				<br /> <input type="password" name="password" value="Password" onblur="onBlur(this)" onfocus="onFocus(this)"
					class="password" /> <br /> <br /> <input type="submit"
					value="Login" class="button" /> <br />
				</form>
				<script>
					function onBlur(el) {
    				if (el.value == '') {
      				  el.value = el.defaultValue;
    					}
					}
					function onFocus(el) {
   			 		if (el.value == el.defaultValue) {
    			    el.value = '';
		   			 }
					}
					
				</script>
					<?php
					//the below lines of codes are displaying the error message 	
						if (isset ( $_SESSION ['Login.Error'] )) {
						echo $_SESSION ['Login.Error'];
						unset ( $_SESSION ['Login.Error'] );
						echo "<script type=text/javascript>";
						echo "alert('Error 400'.')";
						echo "</script>";
						}
						?>

						<?php
						// the below lines of codes are displaying the information message
						if (isset ( $_SESSION ['LOGIN.info'] )) {
							echo $_SESSION ['LOGIN.info'];
							unset ( $_SESSION ['LOGIN.info'] );
						}
						?>	
			  </div>
			</div>
	</div> 
	
	<div id="footer">

	</div>
	
</div> 


</body>
</html>





