<?php
/**
* Main Model. All other Models Extend this
* 
*/

class Model {
    var $table; 
    var $fields; 
    var $id; 
    var $conn;

    var $host = 'localhost'; 
    var $user = 'root'; 
    var $pass = ''; 
    var $db   = 'NHVBSR';

     
    /** 
     * Constructor function, gets table name, sets the ID of a current row 
     * and gets all field names from the table 
     * 
     * @param   integer   ID of row to update or delete 
     */ 
    function __construct($host = '', $user = '', $pass = '', $db = '') { 
        
        $host = !empty($host) ? $host : $this->host; 
        $user = !empty($user) ? $user : $this->user; 
        $pass = !empty($pass) ? $pass : $this->pass; 
        $db   = !empty($db)   ? $db   : $this->db; 
     
        $this->conn = mysqli_connect($host, $user, $pass, $db) or $this->error('Could not connect to database. Make sure settings are correct.'); 
       
        if (mysqli_connect_errno())
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        
        if (is_resource($this->conn)) {
            mysqli_select_db($db, $this->conn) or $this->error("Database '$db' could not be found."); 
            return $this->conn;
        }

        return false; 
    }

    /**
    * Simple Select All statemeent for the given table
    * 
    * @param String $table : table name to select from, by default it grabs the name of the model
    * @param String $cols : Column names to select 
    **/
	function all($table = '', $cols= '*') {
       $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	
	// *** Functions below are all queries for the Reporting Page, up until function process() *** ///
	
	// Shows totals for all States
    function allStates($table = '', $cols= '	SUM(NH) as NH, 
												SUM(MA) as MA, 
												SUM(VT) as VT, 
												SUM(CT) as CT, 
												SUM(RI) as RI,
												SUM(NY) as NY
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// Shows totals for all Boat Types
    function allBoatTypes($table = '', $cols= '	SUM(inboardOutboard) as "I/O", 
												SUM(pwc) as "PWC Jet",
												SUM(canoeKayak) as "Canoe/Kayak",
												SUM(sail) as "Sail Boat",
												SUM(otherBoatType) as "Other"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }

	function allPreviousInteractions($table = '', $cols= '	SUM(previous) as "Previously Interacted", 
												SUM(notPrevious) as "Never Interacted"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	function allDrained($table = '', $cols= '	SUM(drained) as "Drained", 
												SUM(notDrained) as "Not Drained"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }

	function allRinsed($table = '', $cols= '	SUM(rinsed) as "Rinsed", 
												SUM(notRinsed) as "Not Rinsed"
												
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	function allDried($table = '', $cols= '	SUM(dry5) as "Dried", 
												SUM(notDry5) as "Not Dried"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	function allAwareness($table = '', $cols= '	SUM(awarenessLow) as "Low Awareness", 
												SUM(awarenessMedium) as "Medium Awareness", 
												SUM(awarenessHigh) as "High Awareness"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	function allSpeciesFound($table = '', $cols= '	SUM(speciesFoundYes) as "Species Found", 
												SUM(speciesFoundNo) as "Species Not Found"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	function allSpecimenSent($table = '', $cols= '	SUM(sentDesYes) as "Sent to DES", 
												SUM(sentDesNo) as "Not Sent to DES"
												') {
        $mysqli = $this->conn;

        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        return $this->process($stmt);
    }
	
	// *** Functions above are all queries for the Reporting Page ***///
	
	
	
	
    /**
    * Exectutes a statement and calls the get_result method.
    *
    * @param Object $stmt : MySQLI query to be executed
    **/
    function process($stmt) {
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        return $this->get_result($stmt);
    }

    /**
    * This will retrieve the results and place them into a nice array to use.
    *
    * @param Object $stmt :  Results of prior query
    **/
    function get_result($stmt) {
        $meta = $stmt->result_metadata();

        while ($field = $meta->fetch_field()) {
            $parameters[] = &$row[$field->name];
        }

        call_user_func_array(array($stmt, 'bind_result'), $parameters);

        while ($stmt->fetch()) {
            foreach($row as $key => $val) {
                $x[$key] = $val;
            }
            $results[] = $x;
        }
        if (isset($results))
            return $results;
    } 


     















//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// DEPRICATED /////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

    /** 
     * Very simple select 
     * 
     * @param    string   What to order by 
     * @param    string   Where statement 
     * @param    string   Columns to select 
     * @return   result   Result of query 
     */ 
    function select($table='', $orderby = '', $where = '', $cols = '*', $limit = '') { 
        if (empty($table))
            $table = $this->table;
        $orderby = (!empty($orderby)) ? "$orderby" : $this->table.'ID DESC';
        
        if (!empty($this->id) && empty($where)) 
            $where .= $this->table."ID = $this->id"; 

        return parent::select($table, $orderby, $where, $cols, $limit); 
    } 
     
    /** 
     * Insert a new record, or update existing 
     * 
     * @param   array   Data to insert (usually $_POST) 
     */ 
    function save($data) { 
     
        if (!is_array($data)) 
            return false; 
     
        for ($i=0; $i<count($this->fields); $i++) { 
            $data[$this->fields[$i]] = !empty($data[$this->fields[$i]]) ? $data[$this->fields[$i]] : ''; 
        } 
         
        if (empty($this->id)) 
            return $this->insert($this->table, $data); 
        else { 
            foreach ($data as $key => $val) { 
                if (empty($data[$key]) || $data[$key] == '') 
                    unset($data[$key]);
            } 
            return $this->update($this->table, $data, $this->table."ID = '$this->id'"); 
        } 
    } 
     
    /** 
     * Select from table 
     * 
     * @param   string   Order by 
     * @param   string   Where clause 
     * @param   string   Columns to select 
     */ 
    function find_all($table = '', $orderby = 'ID DESC', $where = '', $cols = '*', $limit = '') { 
        
        $table = (!empty($table)) ? $table : '';
        $orderby = (!empty($orderby)) ? $orderby : $this->table.'ID DESC'; 
        $where = (!empty($where)) ? $where : ''; 
        $cols = (!empty($cols)) ? $cols : '*'; 
        $limit = (!empty($limit)) ? $limit : '';
        
        return $this->select($table, $orderby, $where, $cols, $limit); 
        
        //return $this->get(); 
     
    } 
     
    /** 
     * Select single row 
     * 
     * @param   string   Order by 
     * @param   string   Where clause 
     * @param   string   Columns to select 
     */ 
    function find($orderby = 'ID DESC', $where = '', $cols = '*', $limit = '') { 
        $orderby = (!empty($orderby)) ? $orderby : $this->table.'ID DESC'; 
        $where = (!empty($where)) ? $where : ''; 
        if (!empty($this->id) && empty($where)) $where .= $this->table."ID = $this->id"; 
        $cols = (!empty($cols)) ? $cols : '*'; 
        $limit = (!empty($limit)) ? $limit : ''; 
     
        $this->select($this->table, $orderby, $where, $cols, $limit); 
        return $this->get_first(); 
     
    } 
     
    /** 
     * Delete row or rows 
     * 
     * @param   string   Where clause 
     */ 
    function delete($table = '', $where = '') { 

        if (!empty($this->id) && empty($where)) 
            $where .= $this->table."ID = $this->id"; 
     
        return parent::delete($this->table, $where); 
     
    } 
}
