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
        $towns = $this->getTowns();
        $waterbodies = $model->select('waterbody', 'id DESC', '', 'id,Name,Type');
                
        if (isset($waterbodies[0])) {
            for($i=0;$i<count($waterbodies);$i++){
                $formWaterbodies[$i] = array($waterbodies[$i]['id'],$waterbodies[$i]['Name'].$waterbodies[$i]['Type']);
            }
        }else {
                $formWaterbodies = array($waterbodies['id'],$waterbodies['Name'].$waterbodies['Type']);
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
        $towns = $this->getTowns();
        $waterbodies = $model->select('waterbody', 'id DESC', '', 'id,Name');

        if (isset($waterbodies[0])) {
            for($i=0;$i<count($waterbodies);$i++){
                $formWaterbodies[$i] = array($waterbodies[$i]['id'],$waterbodies[$i]['Name'].$waterbodies[$i]['Type']);
            }
        }else {
                $formWaterbodies = array($waterbodies['id'],$waterbodies['Name'].$waterbodies['Type']);
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
    
    public function getTowns() {
        return $towns = array("Acworth","Albany","Alexandria","Allenstown","Alstead","Alton","Amherst","Andover","Antrim","Ashland","Atkinson","Auburn","Barnstead","Barrington","Bartlett","Bath","Bedford","Belmont","Bennington","Benton","Berlin","Bethlehem","Boscawen","Bow","Bradford","Brentwood","Bridgewater","Bristol","Brookfield","Brookline","Campton","Canaan","Candia","Canterbury","Carroll","Center","Charlestown","Chatham","Chester","Chesterfield","Chichester","Claremont","Clarksville","Colebrook","Columbia","Concord","Conway","Cornish","Croydon","Dalton","Danbury","Danville","Deerfield","Deering","Derry","Dorchester","Dover","Dublin","Dummer","Dunbarton","Durham","East","Easton","Eaton","Effingham","Ellsworth","Enfield","Epping","Epsom","Errol","Exeter","Farmington","Fitzwilliam","Francestown","Franconia","Franklin","Freedom","Fremont","Gilford","Gilmanton","Gilsum","Goffstown","Gorham","Goshen","Grafton","Grantham","Greenfield","Greenland","Greenville","Groton","Hampstead","Hampton","Hampton","Hancock","Hanover","Harrisville","Hart's","Haverhill","Hebron","Henniker","Hill","Hillsborough","Hinsdale","Holderness","Hollis","Hooksett","Hopkinton","Hudson","Jackson","Jaffrey","Jefferson","Keene","Kensington","Kingston","Laconia","Lancaster","Landaff","Langdon","Lebanon","Lee","Lempster","Lincoln","Lisbon","Litchfield","Littleton","Londonderry","Loudon","Lyman","Lyme","Lyndeborough","Madbury","Madison","Manchester","The","Marlborough","Marlow","Mason","Meredith","Merrimack","Middleton","Milan","Milford","Milton","Monroe","Mont","Moultonborough","Nashua","Nelson","New","New","New","New","New","New","Newbury","Newfields","Newington","Newmarket","Newport","Newton","North","Northfield","Northumberland","Northwood","Nottingham","Orange","Orford","Ossipee","Pelham","Pembroke","Peterborough","Piermont","Pittsburg","Pittsfield","Plainfield","Plaistow","Plymouth","Portsmouth","Randolph","Raymond","Richmond","Rindge","Rochester","Rollinsford","Roxbury","Rumney","Rye","Salem","Salisbury","Sanbornton","Sandown","Sandwich","Seabrook","Sharon","Shelburne","Somersworth","South","Springfield","Stark","Stewartstown","Stoddard","Strafford","Stratford","Stratham","Sugar","Sullivan","Sunapee","Surry","Sutton","Swanzey","Tamworth","Temple","Thornton","Tilton","Troy","Tuftonboro","Unity","Wakefield","Walpole","Warner","Warren","Washington","Waterville","Weare","Webster","Wentworth","Westmoreland","Whitefield","Wilmot","Wilton","Winchester","Windham","Windsor","Wolfeboro","Woodstock");
    }
}

