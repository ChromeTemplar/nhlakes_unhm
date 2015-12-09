<?php
class WaterbodyController extends Controller {
    /*** Set Class Attribute Variables ***/
    var $name;
    var $registry;

    /**
    * Constructor
    **/
    function waterbodyController($registry){
        $this->registry = $registry;
        $this->name = strtolower(substr(get_class($this), 0, -10));
    }
    
    /**
    * Landing Page for Boat Ramps. Displays all ramps
    **/
    public function index()
    { 
        /*** Instantiate a new Waterbody Model ***/
        $model = new waterbody();


        /*** Get all Waterbodies ***/
        $waterbodies = $model->all();

        
        /*** set template variables ***/
        $this->registry->template->welcome = 'Waterbodies';
        $this->registry->template->waterbodies = $waterbodies;

        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'index');
    }

    /**
    * Loads a blank Waterbody Form
    **/
    public function newWaterbody()
    {   
        /*** Instantiate a new Waterbody Model ***/
        $model = new waterbody();

        
        /*** Get Types ***/
        $types = array("Lake","Pond","River");

        
        /*** set a template variable ***/
        $this->registry->template->welcome = 'New Waterbody';
        $this->registry->template->types = $types;

        
        /*** load the index template ***/
        $this->registry->template->show($this->name, 'new');
    }

     /**
     * Loads the form to edit a Waterbody
     **/
    public function edit()
    {
        /*** Instatiate a new Waterbody model with the ID of the one we are editing ***/
        $model = new waterbody($_GET['id']);
                

        /*** Get the Waterbody where ID = model->id ***/
        $waterbody = $model->at_id();
        /*** Get the water types ***/
        $types = array("Lake","Pond","River");

        
        /*** set template variables ***/
        $this->registry->template->welcome = 'Edit Waterbody';
        $this->registry->template->waterbody = $waterbody[0];
        $this->registry->template->types = $types;

        
        /*** load the edit template ***/
        $this->registry->template->show($this->name, 'edit');
    }

    /**
    * Gets called when a New Waterbody form is submitted
    **/
    public function create() {    
        $model = new waterbody();
        $model->addWaterbody($_POST["waterbody"]);
        
        /*** Redirect User to Waterbody/Index ***/
        header("location: index.php?rt=waterbody/index");
    }

    /**
    * Gets called when an Edit Waterbody form is submitted
    **/
    public function update() {
        $model = new waterbody($_GET['id']);
        $model->updateWaterbody($_POST["waterbody"]);
        
        /*** Redirect User to Waterbody/Index ***/
        header("location: index.php?rt=waterbody/index");
    }
    
    /**
    * Gets called when a Waterbody is deleted
    **/
    public function delete() {
        $model = new waterbody($_GET['id']);
        $model->deleteWaterbody();
        
        /*** Redirect User to Waterbody/Index ***/
        header("location: index.php?rt=waterbody/index");
    }
}
