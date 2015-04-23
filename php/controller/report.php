<?php

class reportController extends Controller
{
    var $name;
    var $registry;
	var $model;
    
    function reportController($registry){
        $this->registry = $registry;
        $this->name = strtolower(substr(get_class($this), 0, -10));
    }
    
    public function index()
    { 
    	
    	/*** Instantiate a new Report model ***/
    	$model = new report();
    	
    	
    	/*** Get all Summaries ***/
		//Breaks it up into different sections on the screen for reporting
		//These functions are in applicationModel with descriptions
    	$summary = $model->allStates();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Reports';
		// Assigns $report to equal $summary?
        $this->registry->template->report = $summary;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');

    	$summary = $model->allStates();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Reports - States';
		// Assigns $report to equal $summary?
        $this->registry->template->report = $summary;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
    }
    /*
    This function returns HTML table. This table contains the survey information obtained from the database.
    */
    public function newReport()
    {
    	
    	$this->model = new report();
    	
        /*** set a template variable ***/
        $this->registry->template->welcome = 'New Report';
  
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'new');
    }

}
