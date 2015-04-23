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
		//These functions are in applicationModel with descriptions within it
    	$summary = $model->allStates();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Reports - All State Totals';
		// Assigns $report to equal $summary?
        $this->registry->template->report = $summary;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');

		
		///////////////////////////////////////
		//** Start Section for Boat Types ** //
    	$summary = $model->allBoatTypes();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Reports - All Boat Type Totals';
		// Assigns $report to equal $summary?
        $this->registry->template->report = $summary;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
		//*** End Section for Boat Types ***///
		//////////////////////////////////////
		
		// ** //
		//** Start Section for all Previous Interactions ** //
    	$summary = $model->allPreviousInteractions();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Reports - All Previous Lake Host Interaction Totals';
		// Assigns $report to equal $summary?
        $this->registry->template->report = $summary;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
		//*** End Section for all Previous Interactions ***///
		// ** //
		
		// ** //
		//** Start Section for allDrained ** //
    	$summary = $model->allDrained();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Reports - Drained or Not Drained Totals';
		// Assigns $report to equal $summary?
        $this->registry->template->report = $summary;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
		//*** End Section for allDrained ***///
		// ** //
		
		// ** //
		//** Start Section for allRinsed ** //
    	$summary = $model->allRinsed();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Reports - Rinsed or Not Rinsed Totals';
		// Assigns $report to equal $summary?
        $this->registry->template->report = $summary;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
		//*** End Section for allRinsed ***///
		// ** //
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
