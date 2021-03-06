<!--link rel="stylesheet" href="assets/css/PrimaryStyle.css" type="text/css"/-->
<!--<link rel="shortcut icon" href="favicon.ico"> -->


<!--div id="body"-->
<?php
//$view = new View;


/*** error reporting on ***/
error_reporting(E_ALL);

/*** define the site path constant ***/
$site_path = realpath(dirname(__FILE__));
define('__SITE_PATH', $site_path);

/*** include the init.php file ***/
include 'includes/init.php';

/*** load the router ***/
$registry->router = new router($registry);

/*** set the controller path ***/
$registry->router->setPath(__SITE_PATH . '/controller');

/*** load up the template ***/
$registry->template = new template($registry);

/*** load the controller ***/
$registry->router->loader();

?>

<!--/div-->