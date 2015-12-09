<?php
/**
* 
* Creates the Display method for the Lake Host Group
* Loosely adapted from the user controller code
* 
*/

class groupController extends Controller
{
    var $name;
    var $registry;
	var $model;
    
    function groupController($registry){
        $this->registry = $registry;
        $this->name = strtolower(substr(get_class($this), 0, -10));
    }
    
    public function index()
    { 
    	/*** Instatiate a new user model because it is pulling from the user list***/
    	$model = new user();
    	
    	/*** Get all Lake Hosts ***/
    	$user = $model->all();
    	
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Groups';
        $this->registry->template->user = $user;
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');


    }
    /*
    This function returns HTML table. This table contains the survey information obtained from the database.
    */
    public function displayGroup()
    {
    	/*** Instatiate a new user model because it is pulling from the user list ***/
    	$model = new user();
    	
    	$this->model = new user();
    	
    	/*** Get all group members ***/
    	$user = $model->all();
    	
        /*** set a template variable ***/
        $this->registry->template->welcome = 'View Group Members';
        $this->registry->template->user = $user;

        /*** load the index template ***/
        $this->registry->template->show($this->name, 'displayGroup');
    }
    /*
     This function creates a new group element
     */
    public function newgroup()
    {
    	$this->model = new group();
    	 
    	/*** set a template variable ***/
    	$this->registry->template->welcome = 'New Group';
    
    	/*** load the index template ***/
    	$this->registry->template->show($this->name, 'new');
    }
    /*
     This function creates a new group for users
     */
    public function create() {
    	$model = new group();
    	$model->addgroup($_POST["lakeHostGroup"]);
    
    	/*** Redirect User to Group/Index ***/
    	header("location: index.php?rt=group/index");
    }
}