<?php
/**
* Create CRUD methods for this controller
* 
* Create[]
* Read[]
* Update[]
* Delete[]
*/

class ReportController extends Controller
{
    var $name;
    var $registry;
    
    function reportController($registry){
        $this->registry = $registry;
        $this->name = strtolower(substr(get_class($this), 0, -10));
    }
    
    public function index()
    { 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Reports';
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');


    }
    /*
    This function returns HTML table. This table contains the survey information obtained from the database.
    */
    public function newReport($survey_id)
    {
        /*** set a template variable ***/
        $this->registry->template->welcome = 'New Report';
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'new');
    }
}
 
