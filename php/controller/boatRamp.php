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
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Boat Ramps';
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');


    }
    /*
    This function returns HTML table. This table contains the survey information obtained from the database.
    */
    public function newBoatRamp()
    {
        /*** set a template variable ***/
        $this->registry->template->welcome = 'New Boat Ramp';
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'new');
    }

    /**
     * 
     * @param Int $survey_id
     * @return Object containing all Survey columns
     */
    public function editBoatRamp($survey_id)
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
}

