<?php
/**
* Create CRUD methods for this controller
* 
* Create[]
* Read[]
* Update[]
* Delete[]
*/

class InvasiveSpeciesController extends Controller
{
    var $name;
    var $registry;
    
    function invasiveSpeciesController($registry){
        $this->registry = $registry;
        $this->name = strtolower(substr(get_class($this), 0, -10));
    }
    
    public function index()
    { 
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Invasive Species';
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');


    }
    /*
    This function returns HTML table. This table contains the survey information obtained from the database.
    */
    public function newInvasiveSpecies()
    {
        /*** set a template variable ***/
        $this->registry->template->welcome = 'New Invasive Species';
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'new');
    }

    /**
     * 
     * @param Int $survey_id
     * @return Object containing all Survey columns
     */
    public function edit($survey_id)
    {
        
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Edit Invasive Species';
        
        /*** load the edit template ***/
        $this->registry->template->show($this->name, 'edit');
        
    }
}
