<?php
/**
* Create CRUD methods for this controller
* 
* Create[]
* Read[]
* Update[]
* Delete[]
*/

class userController extends Controller
{
    var $name;
    var $registry;
	var $model;
    
    function userController($registry){
        $this->registry = $registry;
        $this->name = strtolower(substr(get_class($this), 0, -10));
    }
    
    public function index()
    { 
    	
    	/*** Instatiate a new Lake Host model ***/
    	$model = new user();
    	
    	
    	/*** Get all Lake Hosts ***/
    	$user = $model->all();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Lake Hosts';
        $this->registry->template->user = $user;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');


    }
    /*
    This function returns HTML table. This table contains the survey information obtained from the database.
    */
    public function newuser()
    {
    	
    	$this->model = new user();
    	
        /*** set a template variable ***/
        $this->registry->template->welcome = 'New Lake Host';
  
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'new');
    }

    /**
     * 
     * @param Int $survey_id
     * @return Object containing all Survey columns
     */
    public function edit()
    {
        
    	$this->model = new user($_GET['id']);
    	
    	$user = $this->model->at_id();
    	
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Edit Lake Host';
		$this->registry->template->user = $user[0];
		
        /*** load the edit template ***/
        $this->registry->template->show($this->name, 'edit');

    }
    
    public function create() {
    	$model = new user();
    	$model->adduser($_POST["user"]);
    
    	/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=user/index");
    }
    
    public function update() {
    	$model = new user($_GET['id']);
    	$model->updateuser($_POST["user"]);
		
		/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=user/index");
    
    }
    
    public function delete() {
    	$model = new user($_GET['id']);
    	$model->deleteuser();
		
		/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=user/index");
    
    }
}
