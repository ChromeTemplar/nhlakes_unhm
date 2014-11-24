<?php
/**
* Create CRUD methods for this controller
* 
* Create[]
* Read[]
* Update[]
* Delete[]
*/

class BoatRampController extends Controller
{
    var $name;
    var $registry;
    
    function boatRampController($registry){
        $this->registry = $registry;
        $this->name = strtolower(substr(get_class($this), 0, -10));
    }
    
    public function index()
    { 
        $model = new boatRamp();        
        $ramps = $model->all();
        
        /*** set template variables ***/
        $this->registry->template->welcome = 'Boat Ramps';
        $this->registry->template->ramps = $ramps;
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
        
     
        

    }
    /*
    This function returns HTML table. This table contains the survey information obtained from the database.
    */
    public function newBoatRamp()
    {   
        $model = new boatRamp();
        
        $states = array("NH","ME");
        $towns = array("Town1","Town2","Town3");
        $waterbodies = array("Lake1","Lake2","Lake3");
        
        /*** set a template variable ***/
        $this->registry->template->welcome = 'New Boat Ramp';
        $this->registry->template->states = $states;
        $this->registry->template->towns = $towns;
        $this->registry->template->waterbodies = $waterbodies;
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'new');
    }

    /**
     * 
     * @param Int $survey_id
     * @return Object containing all Survey columns
     */
    public function editBoatRamp()
    {
        
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Edit Boat Ramp';
        
        /*** load the edit template ***/
        $this->registry->template->show($this->name, 'edit');
        
        //$model = new SurveyModel($survey_id);

        //$tmpSurvey = $model->find_all();
        //$survey = $tmpSurvey[0];

        //return $survey;
    }
    
    public function create() {
        
        print_r($_POST["ramp"]);
        
        $model = new boatRamp();
        $model->save($_POST["ramp"]);
        
        header("location: index.php?rt=boatRamp/index");
    }
}

