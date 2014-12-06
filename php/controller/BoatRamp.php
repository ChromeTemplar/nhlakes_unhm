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
    var $model;
    
    function boatRampController($registry){
        $this->registry = $registry;
        $this->name = strtolower(substr(get_class($this), 0, -10));
    }
    
    public function index()
    { 
        $model = new boatramp();        
        //$ramps = $model->select();
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
        $this->model = new boatramp();
        
        $states = array("NH","ME");
        $towns = $this->getTowns();
        $waterbodies = $this->getWaterbodies();
        
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
     * 
     * @return Object containing all Survey columns
     */
    public function edit()
    {
        $this->model = new boatramp($_GET['id']);
        
        $ramp = $this->model->at_id();

        print_r($ramp);
        
        $states = array("NH","ME");
        $towns = $this->getTowns();
        $waterbodies = $this->getWaterbodies();
        
        /*** set a template variable ***/
        $this->registry->template->welcome = 'Edit Boat Ramp';
        $this->registry->template->states = $states;
        $this->registry->template->towns = $towns;
        $this->registry->template->waterbodies = $waterbodies;
        $this->registry->template->ramp = $ramp[0];
        
        /*** load the edit template ***/
        $this->registry->template->show($this->name, 'edit');
        
    }
    
    public function create() {
        $model = new boatramp();
        $model->addBoatRamp($_POST["ramp"]);
        
        header("location: index.php?rt=boatramp/index");
    }
    
    public function update() {
        $model = new boatramp($_GET['id']);
        $model->updateBoatRamp($_POST["ramp"]);
        
        header("location: index.php?rt=boatramp/index");
    }
    
    public function delete() {
        $model = new boatramp($_GET['id']);
        $model->deleteBoatRamp();
        
        header("location: index.php?rt=boatramp/index");
    }



    
    public function getTowns() {
        $items = $this->model->all('Town');
        
        if (isset($items[0])) {
            for($i=0;$i<count($items);$i++){
                $list[$i] = array($items[$i]['townID'],$items[$i]['Name']);
            }
        }else {
                $list = array($items['townID'],$items['Name']);
        }
        
        return $list;    }
    
    public function getWaterbodies() {
        $items = $this->model->all('Waterbody');
        
        if (isset($items[0])) {
            for($i=0;$i<count($items);$i++){
                $list[$i] = array($items[$i]['waterbodyID'],$items[$i]['Name']." ".$items[$i]['Watertype']);
            }
        }else {
                $list = array($items['waterbodyID'],$items['Name']." ".$items['Watertype']);
        }
        
        return $list;
    }
}

