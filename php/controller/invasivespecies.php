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
        
       /*** Instatiate a new boatramp model ***/
        $model = new invasiveSpecies();  


        /*** Get all Invasive Species ***/
        $invasivespecies = $model->all("invasivesurvey");
        
   
        
        /*** set a template variable ***/
        
        $this->registry->template->invasivespecies = $invasivespecies;
        
        $this->registry->template->welcome = 'Invasive Survey';
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');


    }
    /**
    * Loads a blank BoatRamp Form
    **/
    public function newInvasiveSurvey()
    {   
        /*** Instatiate a new boatramp model ***/
        $this->model = new invasiveSpecies();

   

        /*** set template variables ***/
        $this->registry->template->welcome = 'New Invasive Survey';


        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'new');
    }

    /**
     * 
     * @param Int $survey_id
     * @return Object containing all Survey columns
     */
    public function edit($ID)
    {
        
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Edit Invasive Survey';
        
        /*** load the edit template ***/
        $this->registry->template->show($this->name, 'edit');
        
    }
    
    
        /**
    * Gets called when a InvasiveSpecies form is submitted
    **/
    public function create() {
        $model = new invasiveSpecies();
      //  print_r ($_POST["InvasiveSurvey"]);
        $model->addInvasiveSpecies($_POST["InvasiveSurvey"]);
        
        
        
        /*** Redirect User to InvasiveSpecies/Index ***/
       header("location: index.php?rt=InvasiveSpecies/index");
    }
    
    
     /**
    * Gets called when an Edit Invasive Species form is submitted
    **/
    public function update() {
        $model = new invasiveSpecies($_GET['id']);
        $model->updateInvasiveSpecies($_POST["ramp"]);
        
        /*** Redirect User to BoatRamp/Index ***/
        header("location: index.php?rt=InvasiveSpecies/index");
    }
    
    /**
    * Gets called when a Boat Ramp is deleted
    **/
    public function delete() {
        $model = new invasiveSpecies($_GET['id']);
        $model->deleteInvasiveSpecies();
        
        /*** Redirect User to BoatRamp/Index ***/
        header("location: index.php?rt=InvasiveSpecies/index");
    }
    
    
    
    
    
    
}