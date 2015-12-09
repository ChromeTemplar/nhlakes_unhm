<?php 
/**
* Create CRUD methods for this controller
* 
* Create[]
* Read[]
* Update[]
* Delete[]
*/

class HomeController extends Controller
{
    var $name;
    var $registry;
    
    function homeController($registry){
        $this->registry = $registry;
        $this->name = strtolower(substr(get_class($this), 0, -10));
    }
    
    public function index()
    { 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Home';
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');


    }
}