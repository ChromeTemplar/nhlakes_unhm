<?php
class pageTemplate{
	//public $pageTitle;
	//public $bodyView;
	public function header($pageTitle) { 
		echo
		<<<EOT
		<html>
		  <head>
		    <title>{$pageTitle}</title>
		    <link rel="stylesheet" type="text/css" href="../css/mainLayout.css" />
			<script src="//code.jquery.com/jquery-1.9.1.js"></script>
			<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		    <script src="form.js"></script>
		  </head>
		  <body>
		  
		  	<div id='cssmenu'>
					<ul>
					   <li><a href='index.php'><span>NHVBSR</span></a></li>
					   <li><a href='C:/devel/web/php/survey.php'><span>Survey</span></a></li>
					   <li><a href='#'><span>View</span></a></li>
					   <li><a href='C:/devel/web/php/edit.php'><span>Edit</span></a></li>
					   <li><a href='#'><span>Logout</span></a></li>
					</ul>
			</div>
			<br><br><br>
EOT;

	}
	
	public function siteBody($pageTitle = null){
		echo <<<EOT
		 <div id="info">
			<h2>{$pageTitle}</h2>
			<hr>
EOT;
		
	}
	
	public function footer(){
		echo <<<EOT
		    </div>
		  </body>
		</html>
EOT;
	}
}