<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Logon Screen sample</title>
<link type="text/css" rel="stylesheet" href="assets/css/logonDeco.css" />
</head>

<body class="background_style">
	<div id="wholeBody">
		<br /> <br /> <br /> <br /> <br />
		<div id="form">
			<form action="index.php?rt=home/index" method="post">
				<input type="text" name="userId" value="User ID" class="userId" onblur="onBlur(this)" onfocus="onFocus(this)"/> <br />
				<br /> <input type="password" name="password" value="Password" onblur="onBlur(this)" onfocus="onFocus(this)"
					class="password" /> <br /> <br /> <input type="submit"
					value="Submit" class="button" /> <br />
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
		</div>
	</div>
	<span class="err_msg">
		<?php
	//the below lines of codes are displaying the error message 	
if (isset ( $_SESSION ['Login.Error'] )) {
			echo $_SESSION ['Login.Error'];
			unset ( $_SESSION ['Login.Error'] );
			echo "<script type=text/javascript>";
			echo "alert('Login information incorrect')";
			echo "</script>:";
		}
		?>
	</span>
	<span class="info_msg">
		<?php
		// the below lines of codes are displaying the information message
		if (isset ( $_SESSION ['LOGIN.info'] )) {
			echo $_SESSION ['LOGIN.info'];
			unset ( $_SESSION ['LOGIN.info'] );
		}
		?>	
	</span>
</body>

</html>