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
    
    /*
     This function sets the basic template for a user.
     */
    public function index()
    { 
    	
    	/*** Instatiate a new user model ***/
    	$model = new user();
    	
    	
    	/*** Get all users ***/
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
     * This function obtains which user to edit and where to edit
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
    /*
     This function creates new users by calling code in the model
     */
    public function create() {
    	$model = new user();
    	$model->adduser($_POST["user"]);
    
    	/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=user/index");
    }
    /*
     This function updates current users by calling code in the model
     */
    public function update() {
    	$model = new user($_GET['id']);
    	$model->updateuser($_POST["user"]);
		
		/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=user/index");
    
    }
    /*
     This function activates deactivated users
     */
    public function activate() {
    	$model = new user($_GET['id']);
    	$model->activateUser();
    
    	/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=user/index");
    }    
    /*
     This function deactivates activated users
     */
    public function deactivate() {
    	$model = new user($_GET['id']);
    	$model->deactivateUser();
    
    	/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=user/index");
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////// DEPRICATED /////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////    
    
    public function delete() {
    	$model = new user($_GET['id']);
    	$model->deleteuser();
		
		/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=user/index");
    
    }
}