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
        $ramps = $model->select();
        
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
        $waterbodies = $model->select('waterbody', 'id DESC', '', 'id,Name');

        foreach($waterbodies as $wb){
            $formWaterbodies[] = $wb;
        }
        
        /*** set a template variable ***/
        $this->registry->template->welcome = 'New Boat Ramp';
        $this->registry->template->states = $states;
        $this->registry->template->towns = $towns;
        $this->registry->template->waterbodies = $formWaterbodies;
        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'new');
    }

    /**
     * 
     * 
     * @return Object containing all Survey columns
     */
    public function edit()
    {
        $model = new boatRamp();
        
        $states = array("NH","ME");
        $towns = array("Town1","Town2","Town3");
        $waterbodies = $model->select('waterbody', 'id DESC', '', 'id,Name');

        foreach($waterbodies as $wb){
            $formWaterbodies[] = $wb;
        }
        
        /*** set a template variable ***/
        $this->registry->template->welcome = 'New Boat Ramp';
        $this->registry->template->states = $states;
        $this->registry->template->towns = $towns;
        $this->registry->template->waterbodies = $formWaterbodies;
        
        /*** load the edit template ***/
        $this->registry->template->show($this->name, 'edit');
        
    }
    
    public function create() {
        
        $model = new boatRamp();
        $model->save($_POST["ramp"]);
        
        header("location: index.php?rt=boatRamp/index");
    }
    
    public function delete() {
        
        $model = new boatRamp($_GET['id']);
        
        $model->delete();
        
        header("location: index.php?rt=boatRamp/index");
    }
}

