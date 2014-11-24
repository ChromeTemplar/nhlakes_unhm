<?php


class SurveyController extends Controller
{     
    var $name;
    var $registry;
    
    function surveyController($registry){
        $this->registry = $registry;
        $this->name = strtolower(substr(get_class($this), 0, -10));
    }
    
    public function index()
    { 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Surveys';

        $model = new survey();        
        $surveys = $model->select();
        
        
        $this->registry->template->surveys = $surveys;
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
    }
    /*
    This function returns HTML table. This table contains the survey information obtained from the database.
    */
    public function newSurvey()
    {
        /*** set a template variable ***/
        $this->registry->template->welcome = 'New Survey';
        
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
        if (isset($_GET["id"])){
            $id = $_GET["id"];
        }
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Edit Survey';
        
        $model = new survey($id);
        $survey = $model->find();
        
        $this->registry->template->survey = $survey[0];

        /*** load the edit template ***/
        $this->registry->template->show($this->name, 'edit');
    }
}
