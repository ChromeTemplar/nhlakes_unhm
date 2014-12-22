<?php
/**
* Create CRUD methods for this controller
* 
* Create[]
* Read[]
* Update[]
* Delete[]
*/

class LakeHostController extends Controller
{
    var $name;
    var $registry;
	var $model;
    
    function lakeHostController($registry){
        $this->registry = $registry;
        $this->name = strtolower(substr(get_class($this), 0, -10));
    }
    
    public function index()
    { 
    	
    	/*** Instatiate a new Lake Host model ***/
    	$model = new lakeHost();
    	
    	
    	/*** Get all Lake Hosts ***/
    	$lakehost = $model->all();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Lake Hosts';
        $this->registry->template->lakehost = $lakehost;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');


    }
    /*
    This function returns HTML table. This table contains the survey information obtained from the database.
    */
    public function newLakeHost()
    {
    	
    	$this->model = new lakeHost();
    	
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
        
    	$this->model = new lakeHost($_GET['id']);
    	
    	$lakeHost = $this->model->at_id();
    	
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Edit Lake Host';
		$this->registry->template->lakehost = $lakeHost[0];
		
        /*** load the edit template ***/
        $this->registry->template->show($this->name, 'edit');

    }
    
    public function create() {
    	$model = new lakeHost();
    	$model->addLakeHost($_POST["LakeHost"]);
    
    	/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=lakehost/index");
    }
    
    public function update() {
    	$model = new lakeHost($_GET['id']);
    	$model->updateLakeHost($_POST["LakeHost"]);
		
		/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=lakehost/index");
    
    }
    
    public function delete() {
    	$model = new lakeHost($_GET['id']);
    	$model->deleteLakeHost();
		
		/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=lakehost/index");
    
    }
}
