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
        $this->registry->template->welcome = 'States';
		// Assigns $report to equal $summary?
        $this->registry->template->report = $summary;


        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');


		///////////////////////////////////////
		//** Start Section for Boat Types ** //
    	$summary = $model->allBoatTypes();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Boat Types';
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
        $this->registry->template->welcome = 'All Previous Lake Host Interactions';
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
        $this->registry->template->welcome = 'Drained and Not Drained Totals';
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
        $this->registry->template->welcome = 'Rinsed and Not Rinsed Totals';
		// Assigns $report to equal $summary?
        $this->registry->template->report = $summary;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
		//*** End Section for allRinsed ***///
		// ** //
		
		// ** //
		//** Start Section for allDried ** //
    	$summary = $model->allDried();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Dried and Not Dried Totals';
		// Assigns $report to equal $summary?
        $this->registry->template->report = $summary;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
		//*** End Section for allDried ***///
		// ** //
		
		// ** //
		//** Start Section for allAwareness ** //
    	$summary = $model->allAwareness();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Awareness Totals';
		// Assigns $report to equal $summary?
        $this->registry->template->report = $summary;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
		//*** End Section for allAwareness ***///
		// ** //
		
		// ** //
		//** Start Section for allSpeciesFound ** //
    	$summary = $model->allSpeciesFound();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Specimen Found';
		// Assigns $report to equal $summary?
        $this->registry->template->report = $summary;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
		//*** End Section for allSpeciesFound ***///
		// ** //		
		
		// ** //
		//** Start Section for allSpecimenSent ** //
    	$summary = $model->allSpecimenSent();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Specimen Sent';
		// Assigns $report to equal $summary?
        $this->registry->template->report = $summary;
        
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
		//*** End Section for allSpecimenSent ***///
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
