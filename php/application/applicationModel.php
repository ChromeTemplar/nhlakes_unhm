<?php

/**
 * Main Model. All other Models Extend this
 *
 */
class Model
{
    var $table;
    var $fields;
    var $id;
    var $conn;

    /**
     * Constructor function, gets table name, sets the ID of a current row
     * and gets all field names from the table
     *
     * @param   integer   ID of row to update or delete
     */
    function __construct($host = '', $User = '', $pass = '', $db = '')
    {
        return $this->connectToDb();
    }

    function connectToDb()
    {
        $hostName = gethostname();
        include_once("connect.php");

        if (strtolower($hostName) == "stem3") {
            $this->conn = Connect::getProdConn() or $this->error('Could not connect to database. Make sure settings are correct.');
        } else {
            $this->conn = Connect::getDevConn() or $this->error('Could not connect to database. Make sure settings are correct.');
        }

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

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
     * @param String $where : where filter on group coordinator ids
     **/
    function all($table = '', $cols = '*', $where = '')
    {
        $mysqli = $this->conn;

        if (empty($table))
            $table = $this->table;

        if(is_numeric($where)) {
            $sql = "Select $cols FROM $table WHERE ID = $where";
        } else if(!empty($where)) {
            //this is a hack, fixing this the right way would require a large redesign
            $sql = "Select $cols FROM $table WHERE coordinatorID = ";

            $coordinatorIds = explode(',', $where);
            $sql .= implode(' OR coordinatorID = ', $coordinatorIds);

        } else {
            $sql = "Select $cols FROM $table";
        }

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        return $this->process($stmt);
    }


    /**
     * Exectutes a statement and calls the get_result method.
     *
     * @param Object $stmt : MySQLI query to be executed
     **/
    function process($stmt)
    {
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
    function get_result($stmt)
    {
        $meta = $stmt->result_metadata();

        while ($field = $meta->fetch_field()) {
            $parameters[] = &$row[$field->name];
        }

        call_User_func_array(array($stmt, 'bind_result'), $parameters);

        while ($stmt->fetch()) {
            foreach ($row as $key => $val) {
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
    function select($table = '', $orderby = '', $where = '', $cols = '*', $limit = '')
    {
        if (empty($table))
            $table = $this->table;
        $orderby = (!empty($orderby)) ? "$orderby" : $this->table . 'ID DESC';

        if (!empty($this->id) && empty($where))
            $where .= $this->table . "ID = $this->id";

        return parent::select($table, $orderby, $where, $cols, $limit);
    }

    /**
     * Insert a new record, or update existing
     *
     * @param   array   Data to insert (usually $_POST)
     */
    function save($data)
    {

        if (!is_array($data))
            return false;

        for ($i = 0; $i < count($this->fields); $i++) {
            $data[$this->fields[$i]] = !empty($data[$this->fields[$i]]) ? $data[$this->fields[$i]] : '';
        }

        if (empty($this->id))
            return $this->insert($this->table, $data);
        else {
            foreach ($data as $key => $val) {
                if (empty($data[$key]) || $data[$key] == '')
                    unset($data[$key]);
            }
            return $this->update($this->table, $data, $this->table . "ID = '$this->id'");
        }
    }

    /**
     * Select from table
     *
     * @param   string   Order by
     * @param   string   Where clause
     * @param   string   Columns to select
     */
    function find_all($table = '', $orderby = 'ID DESC', $where = '', $cols = '*', $limit = '')
    {

        $table = (!empty($table)) ? $table : '';
        $orderby = (!empty($orderby)) ? $orderby : $this->table . 'ID DESC';
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
    function find($orderby = 'ID DESC', $where = '', $cols = '*', $limit = '')
    {
        $orderby = (!empty($orderby)) ? $orderby : $this->table . 'ID DESC';
        $where = (!empty($where)) ? $where : '';
        if (!empty($this->id) && empty($where)) $where .= $this->table . "ID = $this->id";
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
    function delete($table = '', $where = '')
    {

        if (!empty($this->id) && empty($where))
            $where .= $this->table . "ID = $this->id";

        return parent::delete($this->table, $where);

    }
}
