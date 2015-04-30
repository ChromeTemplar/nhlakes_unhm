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
		$model = new report();

        /*** set a template variable ***/
        $this->registry->template->welcome = 'Reports';
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
	}
	
    public function allReports()
    { 
    	
    	/*** Instantiate a new Report model ***/
    	$model = new report();
    	
    	
    	/*** Get all Summaries ***/
		//Breaks it up into different sections on the screen for reporting
		//These functions are in applicationModel with descriptions within it
		//** Start Section for States ** //
    	$summary = $model->allStates();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'States';
		// Assigns $allreport to equal $summary?
        $this->registry->template->allreport = $summary;

        /*** load the view ***/
        $this->registry->template->show($this->name, 'allReports');


		//** Start Section for Boat Types ** //
    	$summary = $model->allBoatTypes();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Boat Types';
		// Assigns $allreport to equal $summary?
        $this->registry->template->allreport = $summary;
        
        /*** load the view ***/
        $this->registry->template->show($this->name, 'allReports');

		
		//** Start Section for all Previous Interactions ** //
    	$summary = $model->allPreviousInteractions();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'All Previous Lake Host Interactions';
		// Assigns $allreport to equal $summary?
        $this->registry->template->allreport = $summary;
        
        /*** load the view ***/
        $this->registry->template->show($this->name, 'allReports');

		
		//** Start Section for allDrained ** //
    	$summary = $model->allDrained();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Drained and Not Drained Totals';
		// Assigns $allreport to equal $summary?
        $this->registry->template->allreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'allReports');

		
		//** Start Section for allRinsed ** //
    	$summary = $model->allRinsed();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Rinsed and Not Rinsed Totals';
		// Assigns $allreport to equal $summary?
        $this->registry->template->allreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'allReports');

		
		//** Start Section for allDried ** //
    	$summary = $model->allDried();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Dried and Not Dried Totals';
		// Assigns $allreport to equal $summary?
        $this->registry->template->allreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'allReports');

		
		//** Start Section for allAwareness ** //
    	$summary = $model->allAwareness();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Awareness Totals';
		// Assigns $allreport to equal $summary?
        $this->registry->template->allreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'allReports');

		
		//** Start Section for allSpeciesFound ** //
    	$summary = $model->allSpeciesFound();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Specimen Found';
		// Assigns $allreport to equal $summary?
        $this->registry->template->allreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'allReports');

		
		//** Start Section for allSpecimenSent ** //
    	$summary = $model->allSpecimenSent();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Specimen Sent';
		// Assigns $allreport to equal $summary?
        $this->registry->template->allreport = $summary;
  
        /*** load the view***/
        $this->registry->template->show($this->name, 'allReports');
    }
	
	public function rampReports()
    { 
    	
    	/*** Instantiate a new Report model ***/
    	$model = new report();
    	
    	
    	/*** Get all Summaries ***/
		//Breaks it up into different sections on the screen for reporting
		//These functions are in applicationModel with descriptions within it
		//** Start Section for States ** //
    	$summary = $model->allStatesRamp();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'States';
		// Assigns $rampreport to equal $summary?
        $this->registry->template->rampreport = $summary;

        /*** load the view ***/
        $this->registry->template->show($this->name, 'rampReports');


		//** Start Section for Boat Types ** //
    	$summary = $model->allBoatTypesRamp();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Boat Types';
		// Assigns $rampreport to equal $summary?
        $this->registry->template->rampreport = $summary;
        
        /*** load the view ***/
        $this->registry->template->show($this->name, 'rampReports');

		
		//** Start Section for all Previous Interactions ** //
    	$summary = $model->allPreviousInteractionsRamp();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'All Previous Lake Host Interactions';
		// Assigns $rampreport to equal $summary?
        $this->registry->template->rampreport = $summary;
        
        /*** load the view ***/
        $this->registry->template->show($this->name, 'rampReports');

		
		//** Start Section for allDrained ** //
    	$summary = $model->allDrainedRamp();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Drained and Not Drained Totals';
		// Assigns $rampreport to equal $summary?
        $this->registry->template->rampreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'rampReports');

		
		//** Start Section for allRinsed ** //
    	$summary = $model->allRinsedRamp();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Rinsed and Not Rinsed Totals';
		// Assigns $rampreport to equal $summary?
        $this->registry->template->rampreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'rampReports');

		
		//** Start Section for allDried ** //
    	$summary = $model->allDriedRamp();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Dried and Not Dried Totals';
		// Assigns $rampreport to equal $summary?
        $this->registry->template->rampreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'rampReports');

		
		//** Start Section for allAwareness ** //
    	$summary = $model->allAwarenessRamp();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Awareness Totals';
		// Assigns $rampreport to equal $summary?
        $this->registry->template->rampreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'rampReports');

		
		//** Start Section for allSpeciesFound ** //
    	$summary = $model->allSpeciesFoundRamp();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Specimen Found';
		// Assigns $rampreport to equal $summary?
        $this->registry->template->rampreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'rampReports');

		
		//** Start Section for allSpecimenSent ** //
    	$summary = $model->allSpecimenSentRamp();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Specimen Sent';
		// Assigns $rampreport to equal $summary?
        $this->registry->template->rampreport = $summary;
  
        /*** load the view***/
        $this->registry->template->show($this->name, 'rampReports');
    }
	
	public function groupReports()
    { 
    	
    	/*** Instantiate a new Report model ***/
    	$model = new report();
    	
    	
    	/*** Get all Summaries ***/
		//Breaks it up into different sections on the screen for reporting
		//These functions are in applicationModel with descriptions within it
		//** Start Section for States ** //
    	$summary = $model->allStatesGroup();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'States';
		// Assigns $groupreport to equal $summary?
        $this->registry->template->groupreport = $summary;

        /*** load the view ***/
        $this->registry->template->show($this->name, 'groupReports');


		//** Start Section for Boat Types ** //
    	$summary = $model->allBoatTypesGroup();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Boat Types';
		// Assigns $groupreport to equal $summary?
        $this->registry->template->groupreport = $summary;
        
        /*** load the view ***/
        $this->registry->template->show($this->name, 'groupReports');

		
		//** Start Section for all Previous Interactions ** //
    	$summary = $model->allPreviousInteractionsGroup();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'All Previous Lake Host Interactions';
		// Assigns $groupreport to equal $summary?
        $this->registry->template->groupreport = $summary;
        
        /*** load the view ***/
        $this->registry->template->show($this->name, 'groupReports');

		
		//** Start Section for allDrained ** //
    	$summary = $model->allDrainedGroup();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Drained and Not Drained Totals';
		// Assigns $groupreport to equal $summary?
        $this->registry->template->groupreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'groupReports');

		
		//** Start Section for allRinsed ** //
    	$summary = $model->allRinsedGroup();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Rinsed and Not Rinsed Totals';
		// Assigns $groupreport to equal $summary?
        $this->registry->template->groupreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'groupReports');

		
		//** Start Section for allDried ** //
    	$summary = $model->allDriedGroup();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Dried and Not Dried Totals';
		// Assigns $groupreport to equal $summary?
        $this->registry->template->groupreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'groupReports');

		
		//** Start Section for allAwareness ** //
    	$summary = $model->allAwarenessGroup();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Awareness Totals';
		// Assigns $groupreport to equal $summary?
        $this->registry->template->groupreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'groupReports');

		
		//** Start Section for allSpeciesFound ** //
    	$summary = $model->allSpeciesFoundGroup();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Specimen Found';
		// Assigns $groupreport to equal $summary?
        $this->registry->template->groupreport = $summary;
        
        /*** load the view***/
        $this->registry->template->show($this->name, 'groupReports');

		
		//** Start Section for allSpecimenSent ** //
    	$summary = $model->allSpecimenSentGroup();
    	 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Specimen Sent';
		// Assigns $groupreport to equal $summary?
        $this->registry->template->groupreport = $summary;
  
        /*** load the view***/
        $this->registry->template->show($this->name, 'groupReports');
    }

}
