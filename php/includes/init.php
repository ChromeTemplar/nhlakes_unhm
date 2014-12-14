<?php
 /*** include the controller class ***/
 include __SITE_PATH . '/application/' . 'applicationController.php';

 /*** include the registry class ***/
 include __SITE_PATH . '/application/' . 'registry.php';

 /*** include the router class ***/
 include __SITE_PATH . '/application/' . 'router.php';

 /*** include the template class ***/
 include __SITE_PATH . '/application/' . 'template.php';
 
 /*** include the base model class ***/
 include __SITE_PATH . '/application/' . 'applicationModel.php';

 
 /*** auto load model classes ***/
function __autoload($class_name) {
    $filename = strtolower($class_name) . '.php';
    $file = __SITE_PATH . '/model/' . $filename;
    
    //print_r($file);
    
    if (file_exists($file))
    {
        include_once $file;  
    }
}

 /*** a new registry object ***/
 $registry = new registry;

 /*** create the database registry object ***/
 $registry->db = new Model;