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
		/*** set a template variable ***/
        $this->registry->template->welcome = 'All Summaries';
    	
    	/*** Get all Summaries ***/
		//Breaks it up into different sections on the screen for reporting
		//These functions are in applicationModel with descriptions within it
		
		//** Start Section for States ** //
		// Assigns $allstate  
        $this->registry->template->allstate = $model->allStates();
		
		//** Start Section for Boat Types ** //
		// Assigns $allboat  
        $this->registry->template->allboat = $model->allBoatTypes();
		
		//** Start Section for all Previous Interactions ** //
		// Assigns $allprev  
        $this->registry->template->allprev = $model->allPreviousInteractions();
		
		//** Start Section for allDrained ** //
		// Assigns $alldrained  
        $this->registry->template->alldrained = $model->allDrained();
       
		//** Start Section for allRinsed ** //
		// Assigns $allrinsed  
        $this->registry->template->allrinsed = $model->allRinsed();
		
		//** Start Section for allDried ** //
		// Assigns $alldried  
        $this->registry->template->alldried = $model->allDried();

		//** Start Section for allAwareness ** //
		// Assigns $allaware  
        $this->registry->template->allaware = $model->allAwareness();
        
		//** Start Section for allSpeciesFound ** //
		// Assigns $allfound  
        $this->registry->template->allfound = $model->allSpeciesFound();
 		
		//** Start Section for allSpecimenSent ** //
		// Assigns $allsent  
        $this->registry->template->allsent = $model->allSpecimenSent();
  
  
  		/*** load the view***/
        $this->registry->template->show($this->name, 'allReports');

    }
	
	public function rampReports()
    { 
    	
    	/*** Instantiate a new Report model ***/
    	$model = new report();
    	
    	/*** set a template variable ***/
        $this->registry->template->welcome = 'All Summaries By Boat Ramp';
    	/*** Get all Summaries ***/
		//Breaks it up into different sections on the screen for reporting
		//These functions are in applicationModel with descriptions within it
		//** Start Section for States ** //
		// Assigns $rampreport  
        $this->registry->template->rampstate = $model->allStatesRamp();

		//** Start Section for Boat Types ** //
		// Assigns $rampreport  
        $this->registry->template->rampboat = $model->allBoatTypesRamp();

		//** Start Section for all Previous Interactions ** //
		// Assigns $rampreport  
        $this->registry->template->rampprev = $model->allPreviousInteractionsRamp();

		//** Start Section for allDrained ** //
		// Assigns $rampreport  
        $this->registry->template->rampdrained = $model->allDrainedRamp();

		//** Start Section for allRinsed ** //
		// Assigns $rampreport  
        $this->registry->template->ramprinsed = $model->allRinsedRamp();
		
		//** Start Section for allDried ** //
		// Assigns $rampreport  
        $this->registry->template->rampdried = $model->allDriedRamp();
		
		//** Start Section for allAwareness ** //
		// Assigns $rampreport  
        $this->registry->template->rampaware = $model->allAwarenessRamp();

		//** Start Section for allSpeciesFound ** //
		// Assigns $rampreport  
        $this->registry->template->rampfound = $model->allSpeciesFoundRamp();;

		//** Start Section for allSpecimenSent ** //
		// Assigns $rampreport  
        $this->registry->template->rampsent = $model->allSpecimenSentRamp();
  
  
        /*** load the view***/
        $this->registry->template->show($this->name, 'rampReports');
    }
	
	public function groupReports()
    { 
    	/*** Instantiate a new Report model ***/
    	$model = new report();
		
		/*** set a template variable ***/
        $this->registry->template->welcome = 'All Summaries By Lake Host Group';
    	
    	/*** Get all Summaries ***/
		//Breaks it up into different sections on the screen for reporting
		//These functions are in applicationModel with descriptions within it
		//** Start Section for States ** //
		// Assigns $groupstate  
        $this->registry->template->groupstate = $model->allStatesGroup();

		//** Start Section for Boat Types ** //
		// Assigns $groupboat
        $this->registry->template->groupboat = $model->allBoatTypesGroup();

		//** Start Section for all Previous Interactions ** //
		// Assigns $groupprev  
        $this->registry->template->groupprev = $model->allPreviousInteractionsGroup();

		//** Start Section for allDrained ** //
		// Assigns $groupdrained  
        $this->registry->template->groupdrained = $model->allDrainedGroup();

		//** Start Section for allRinsed ** //
		// Assigns $grouprinsed  
        $this->registry->template->grouprinsed = $model->allRinsedGroup();
		
		//** Start Section for allDried ** //
		// Assigns $groupdried  
        $this->registry->template->groupdried = $model->allDriedGroup();
		
		//** Start Section for allAwareness ** //
		// Assigns $groupaware  
        $this->registry->template->groupaware = $model->allAwarenessGroup();
		
		//** Start Section for allSpeciesFound ** //
		// Assigns $groupfound  
        $this->registry->template->groupfound = $model->allSpeciesFoundGroup();
		
		//** Start Section for allSpecimenSent ** //
		// Assigns $groupsent  
        $this->registry->template->groupsent = $model->allSpecimenSentGroup();
  
  
        /*** load the view***/
        $this->registry->template->show($this->name, 'groupReports');
    }

}
