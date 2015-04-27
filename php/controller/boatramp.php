<?php
class BoatRampController extends Controller
{
    /*** Set Class Attribute Variables ***/
    var $name;
    var $registry;
    var $model;
    
    /**
    * Constructor
    **/
    function boatRampController($registry){
        /*** Sets The registry object ***/
        $this->registry = $registry;
        
        /*** Sets a name variable for the Controller ***/
        $this->name = strtolower(substr(get_class($this), 0, -10));
    }

    /**
    * Landing Page for Boat Ramps. Displays all ramps
    **/
    public function index()
    { 
        /*** Instatiate a new boatramp model ***/
        $model = new boatramp();  

        /*** Get all Ramps ***/
        $ramps = $model->all();
        
        /*** set template variables ***/
        $this->registry->template->welcome = 'Boat Ramps';
        $this->registry->template->ramps = $ramps;
        
        

        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
    }

    /**
    * Loads a blank BoatRamp Form
    **/
    public function newBoatRamp()
    {   
        /*** Instatiate a new boatramp model ***/
        $this->model = new boatramp();

        
        /*** Get States ***/
        $states = array("NH","ME");
        /*** Get Towns ***/
        $towns = $this->getTowns();
        /*** Get Waterbodies ***/
        $waterbodies = $this->getWaterbodies();
        

        /*** set template variables ***/
        $this->registry->template->welcome = 'New Boat Ramp';
        $this->registry->template->states = $states;
        $this->registry->template->towns = $towns;
        $this->registry->template->waterbodies = $waterbodies;

        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'create');
    }

    /**
     * Loads the form to view a Boat Ramp
     **/
    public function view()
    {
    	/*** Instatiate a new boatramp model with the ID of the one we are editing ***/
    	$this->model = new boatramp($_GET['id']);
    
    
    	/*** Get the Boat Ramp where ID = model->id ***/
    	$ramp = $this->model->at_id();
    	/*** Get States ***/
    	$states = array("NH","ME");
    	/*** Get Towns ***/
    	$towns = $this->getTowns();
    	/*** Get Waterbodies ***/
    	$waterbodies = $this->getWaterbodies();
    
    	/*** set template variables ***/
    	$this->registry->template->welcome = 'View Boat Ramp';
    	$this->registry->template->states = $states;
    	$this->registry->template->towns = $towns;
    	$this->registry->template->waterbodies = $waterbodies;
    	$this->registry->template->ramp = $ramp[0];
    
    
    	/*** load the edit template ***/
    	$this->registry->template->show($this->name, 'view');
    
    }
    
    
    /**
     * Loads the form to edit a Boat Ramp
     **/
    public function edit()
    {
        /*** Instatiate a new boatramp model with the ID of the one we are editing ***/
        $this->model = new boatramp($_GET['id']);


        /*** Get the Boat Ramp where ID = model->id ***/
        $ramp = $this->model->at_id();
        /*** Get States ***/
        $states = array("NH","ME");
        /*** Get Towns ***/
        $towns = $this->getTowns();
        /*** Get Waterbodies ***/
        $waterbodies = $this->getWaterbodies();
        
        /*** set template variables ***/
        $this->registry->template->welcome = 'Edit Boat Ramp';
        $this->registry->template->states = $states;
        $this->registry->template->towns = $towns;
        $this->registry->template->waterbodies = $waterbodies;
        $this->registry->template->ramp = $ramp[0];
        

        /*** load the edit template ***/
        $this->registry->template->show($this->name, 'edit');
        
    }
    
    /**
    * Gets called when a New Boat Ramp form is submitted
    **/
    public function create() {
    	if (isset($_SESSION['roleID']) && ($_SESSION['roleID'] < 3)) {
	        $model = new boatramp();
	        $model->addBoatRamp($_POST["ramp"]);
    	}
	        
        /*** Redirect User to BoatRamp/Index ***/
        header("location: index.php?rt=boatramp/index");
    }
    
    /**
    * Gets called when an Edit Boat Ramp form is submitted
    **/
    public function update() {
    	$edit = $_POST['edit'];
    	 
    	if($edit == "Submit")
	    {
	    	if (isset($_SESSION['roleID']) && ($_SESSION['roleID'] < 3)) {
		        $model = new boatramp($_GET['id']);
		        $model->updateBoatRamp($_POST["ramp"]);
	    	}
    	}
    	/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=boatramp/index");
    }
    
    
    /**
     * Loads the form to view a Boat Ramp to delete
     **/
    public function delete()
    {
    	/*** Instatiate a new boatramp model with the ID of the one we are editing ***/
    	$this->model = new boatramp($_GET['id']);
    
    
    	/*** Get the Boat Ramp where ID = model->id ***/
    	$ramp = $this->model->at_id();
    	/*** Get States ***/
    	$states = array("NH","ME");
    	/*** Get Towns ***/
    	$towns = $this->getTowns();
    	/*** Get Waterbodies ***/
    	$waterbodies = $this->getWaterbodies();
    
    	/*** set template variables ***/
    	$this->registry->template->welcome = 'Delete Boat Ramp';
    	$this->registry->template->states = $states;
    	$this->registry->template->towns = $towns;
    	$this->registry->template->waterbodies = $waterbodies;
    	$this->registry->template->ramp = $ramp[0];
    
    
    	/*** load the edit template ***/
    	$this->registry->template->show($this->name, 'delete');
    
    }
    
    
    /**
    * Gets called when a Boat Ramp is deleted
    **/
    public function deleteRamp() {
    	
    	$delete = $_POST['delete'];
    	
    	if($delete == "Delete")
    	{
	    	if (isset($_SESSION['roleID']) && ($_SESSION['roleID'] < 3)) {
		        $model = new boatramp($_GET['id']);
		        $model->deleteBoatRamp();
	    	}
    	}
    	/*** Redirect User to BoatRamp/Index ***/
    	header("location: index.php?rt=boatramp/index");
    }


    /**
    * Get and return all towns as an array 
    **/
    public function getTowns() {
        /*** Get all Towns ***/
        $items = $this->model->all('Town');

        /*** Formats an array to work with a select list ***/
        /***        Format: Array(Value, Display)             ***/
        for($i=0;$i<count($items);$i++){
            $list[$i] = array($items[$i]['ID'],$items[$i]['name']);
        }
        
        return $list;    
    }
    

    /**
    * Get and return all waterbodies as an array 
    **/
    public function getWaterbodies() {
        /*** Get All Waterbodies ***/
        $items = $this->model->all('Waterbody');
        
        /*** Formats an array to work with a select list ***/
        /***        Format: Array(Value, Display)             ***/
        for($i=0;$i<count($items);$i++){
            $list[$i] = array($items[$i]['ID'],$items[$i]['name']);
        }

        return $list;
    }
    
    /**
     * Takes in a list of objects returns an html table for the Index pages for our data
     * Includes an Edit button
     *
     * @param Array $surveys List of objects
     * @return string
     */
    
}

