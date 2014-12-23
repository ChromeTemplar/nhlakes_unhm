<?php

class SurveySummaryController extends Controller
{     
    var $name;
    var $registry;
    var $model;
    
    function SurveySummaryController($registry)
    {
        $this->registry = $registry;
        $this->name = strtolower(substr(get_class($this), 0, -10));
    }
    
    public function index()
    { 
        $model = new surveySummary();
        $surveySummaries = $model->allToday(); 

        $this->registry->template->summary = $surveySummaries;
        $this->registry->template->welcome = 'Survey Summary';
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
    }
    
    /*
    This function returns HTML table. This table contains the survey 
    summary information obtained from the database.
    */
    public function newSurveySummary()
    {
    	$this->model = new surveySummary();
    	
    	//towns are used to filter the boat ramp selection and 
    	//are not downloaded to the summary DB table
    	//FIXME need to make this filter the boat ramps.
    	$townNames = $this->getTownNames();
    	
    	//waterbodies are used to filter the boat ramp selection
    	//and are not downloaded to the summary DB table
    	//FIXME need to make this filter the boat ramps.
    	$waterbodyNames = $this->getWaterbodyNames();
    	
    	$rampNames = $this->getRampNames();
    	
    	//if you're a user you CAN be a lake host.
    	//use this to populate lake hosts field
    	$userNames = $this->getUsers();
    	
    	$localGroups = $this->getLocalGroups();
    	   	
    	//set template variables, these are what are being used in the _form.php
    	$this->registry->template->welcome = 'New Survey Summary';
     	$this->registry->template->localGroups = $localGroups;
     	$this->registry->template->towns = $townNames;
     	$this->registry->template->waterbodies = $waterbodyNames;
     	$this->registry->template->rampNames = $rampNames;
     	$this->registry->template->lakeHostNames = $userNames;
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'new');
    }
    
    private function getLocalGroups()
    {
    	$this->model->lakeHostGroups = $this->model->all('LakeHostGroup');
    	$localGroups = array();
    	for($i = 0; $i < count($this->model->lakeHostGroups); ++$i)
    	{
    		$group = $this->model->lakeHostGroups[$i];
    		$localGroups[$i] = ($group['lakeHostGroupName'] . ' ' . '(' . $group['ID'] . ')');
    	}
    	
    	return $localGroups;
    }
    
    private function getUsers()
    {
    	$this->model->users = $this->model->all('User');
    	$userNames = array();
    	for($i = 0; $i < count($this->model->users); ++$i)
    	{
    		$user = $this->model->users[$i];
    		$userNames[$i] = ($user['firstName'] . ' ' . $user['lastName'] . ' ' . '(' . $user['ID'] . ')');
    	}
    	
    	return $userNames;
    }
    
    private function getRampNames()
    {
    	$this->model->boatRamps = $this->model->all('BoatRamp');
    	$rampNames = array();
    	for($i = 0; $i < count($this->model->boatRamps); ++$i)
    	{
    		$ramp = $this->model->boatRamps[$i];
    		$rampNames[$i] = ($ramp['name'] . ' ' . '(' . $ramp['ID'] . ')');
    	}
    	
    	return $rampNames;
    }
    
    private function getWaterbodyNames()
    {
    	$this->model->waterbodies = $this->model->all('Waterbody');
    	$waterbodyNames = array();
    	for($i = 0; $i < count($this->model->waterbodies); ++$i)
    	{
    		$waterbody = $this->model->waterbodies[$i];
    		$waterbodyNames[$i] = ($waterbody['name'] . ' ' . '(' . $waterbody['ID'] . ')');
    	}
    	
    	return $waterbodyNames;
    }
    
    private function getTownNames()
    {
    	$this->model->towns = $this->model->all('Town');
    	$townNames = array();
    	for($i = 0; $i < count($this->model->towns); ++$i)
    	{
    		$town = $this->model->towns[$i];
    		$townNames[$i] = ($town['name'] . ' ' . '(' . $town['ID'] . ')');
    	}
    	
    	return $townNames;
    }
    
    /**
     * Gets called when a survey summary is deleted
     **/
    public function delete()
    {
    	$model = new surveysummary($_GET['id']);
    	$model->deleteSummary();
    
    	/*** Redirect User to survey summary/Index ***/
    	header("location: index.php?rt=surveysummary/index");
    }
    
    /**
     * Gets called when an Edit survey form is submitted
     **/
    public function update()
    {
    	$model = new surveysummary($_GET['id']);
    	$model->updateSummary($_POST["summary"]);
    
    	/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=surveysummary/index");
    }

    /**
     * 
     * @param Int $survey_id
     * @return Object containing all Survey columns
     */
    public function edit()
    {
       	/*** Instatiate a new boatramp model with the ID of the one we are editing ***/
		$this->model = new surveysummary($_GET['id']);

        /*** Get the Boat Ramp where ID = model->id ***/
        $summary = $this->model->at_id();

        //set the selection boxes selected parameters of the summary header
        $summary['waterbody'] = $this->model->getWaterbodyFromRampID($summary['boatRampID']);
        $summary['town'] = $this->model->getTownFromRampID($summary['boatRampID']);
        $summary['boatRampName'] = $this->model->getRampNameFromID($summary['boatRampID']);
        $summary['lakeHostName'] = $this->model->getLakeHostNameFromUserID($summary['userID']);
        $localGroup = $summary['localGroup'] = $this->model->getLocalGroupFromUserID($summary['userID']);
        
        $rampNames = $this->getRampNames();
        $userNames = $this->getUsers();
        $localGroups = $this->getLocalGroups();
        $townNames = $this->getTownNames();
        $waterbodyNames = $this->getWaterbodyNames();
        
        /*** set the selection boxes and summary data ***/
        $this->registry->template->welcome = 'Edit Survey Summary';
        $this->registry->template->localGroups = $localGroups;
        $this->registry->template->towns = $townNames;
        $this->registry->template->waterbodies = $waterbodyNames;
        $this->registry->template->rampNames = $rampNames;
        $this->registry->template->lakeHostNames = $userNames;
        $this->registry->template->summary = $summary;

        /*** load the edit template ***/
        $this->registry->template->show($this->name, 'edit');
    }
    
   
    
    /**
     * 
     * Gets called when a New Survey Summary form is submitted
     * 
     * Im not sure why we create another model for submitting to the database
     * apparently the one for displaying the summary gets destroyed by the MVC framwork.
     * So apparently I have to use a global to save info which is stupid.
     * Why use OOP if you're going to use globals!
     * 
     **/
    public function create()
    {
    	$model = new surveysummary();
    	$model->addSummary($_POST["summary"]);
    	
    
    	/*** Redirect User to survey summary/Index ***/
    	header("location: index.php?rt=surveysummary/index");
    }
}