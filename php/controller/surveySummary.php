<?php
//FIXME this is code from survey, need to update for summary
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
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Survey Summary';

        $model = new surveySummary();
        $surveySummary = $model->select(); 
        
        //FIXME where is template->surveys defined???
        $this->registry->template->surveys = $surveySummary;
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
    }
    
    /*
    This function returns HTML table. This table contains the survey 
    summary information obtained from the database.
    */
    public function newSurveySummary()
    {
    	//FIXME this is where we need to determine, privelages of the user
    	//to determine if lakehost is fixed or selectable, and get that data
    	//ready fot the UI
    	
    	//FIXME also need to figure out how to update the boat ramp field
    	//based on group, town, and lake when user selects them from
    	//a dropdown menu.
    	
    	$this->model = new surveysummary();
    	
    	//now set get all the data here that is to be used in the _form.php
    	//FIXME will need to get the groups associated with the user here.
    	$localGroups = array("Merrimack","Rockingham", "Coos", "Hillsborough");
    	$waterbodies = array("Echo Lake", "Ammonoosuc River", "Turee Pond", "Pemigewasset River");//$this->getWaterbodies();//FIXME get the waterbodies associated with the group(s) for the lake host
    	$towns = array("Franconia", "Twin Mountain", "Bristol", "Greenland");//$this->getTowns();//FIXME need to get the towns from the waterbody from the group from the userID
    	$ramps = array("Dirt Ramp", "Beer Bottle Ramp", "Big Rock Ramp");
    	
    	//set template variables, these are what are being used in the _form.php
    	$this->registry->template->welcome = 'New Survey Summary';
     	$this->registry->template->localGroups = $localGroups;
     	$this->registry->template->towns = $towns;
     	$this->registry->template->waterbodies = $waterbodies;
     	$this->registry->template->ramps = $ramps;
        
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
        if (isset($_GET["id"]))
        {
            $id = $_GET["id"];
        }
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Edit Survey Summary';
        
        $model = new surveySummary($id);
        $surveySummary = $model->find();
        
        $this->registry->template->survey = $surveySummary[0];

        /*** load the edit template ***/
        $this->registry->template->show($this->name, 'edit');
    }
    
    /**
     * Gets called when a New Survey Summary form is submitted
     **/
    public function create()
    {
    	$model = new surveysummary();//FIXME need the data to pass to both these functions
//    	print_r($_POST["summary"]); //FIXME this line is debug code, remove later
    	$model->addSummary($_POST["summary"]);
    
    	/*** Redirect User to survey summary/Index ***/
    	header("location: index.php?rt=surveysummary/index");
    }
}