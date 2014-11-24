<?php
/**
* Main Model. All other Models Extend this
* 
*/

class Model extends Database {
    var $table; 
    var $fields; 
    var $id; 
     
    /** 
     * Constructor function, gets table name, sets the ID of a current row 
     * and gets all field names from the table 
     * 
     * @param   integer   ID of row to update or delete 
     */ 
    function Model() {
        
    } 
     
    /** 
     * Very simple select 
     * 
     * @param    string   What to order by 
     * @param    string   Where statement 
     * @param    string   Columns to select 
     * @return   result   Result of query 
     */ 
    function select($table, $orderby = 'id DESC', $where = '', $cols = '*', $limit = '') { 
        if (!empty($this->id) && empty($where)) $where .= "id = $this->id"; 

        return parent::select($this->table, $orderby, $where, $cols, $limit); 
     
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
            return $this->update($this->table, $data, "id = '$this->id'"); 
        } 
    } 
     
    /** 
     * Select from table 
     * 
     * @param   string   Order by 
     * @param   string   Where clause 
     * @param   string   Columns to select 
     */ 
    function find_all($orderby = 'id DESC', $where = '', $cols = '*', $limit = '') { 
        
        $orderby = (!empty($orderby)) ? $orderby : 'id DESC'; 
        $where = (!empty($where)) ? $where : ''; 
        $cols = (!empty($cols)) ? $cols : '*'; 
        $limit = (!empty($limit)) ? $limit : ''; 
        
        $this->select($this->table, $orderby, $where, $cols, $limit); 
        
        return $this->get(); 
     
    } 
     
    /** 
     * Select single row 
     * 
     * @param   string   Order by 
     * @param   string   Where clause 
     * @param   string   Columns to select 
     */ 
    function find($orderby = 'id DESC', $where = '', $cols = '*', $limit = '') { 
        $orderby = (!empty($orderby)) ? $orderby : 'id DESC'; 
        $where = (!empty($where)) ? $where : ''; 
        if (!empty($this->id) && empty($where)) $where .= "id = $this->id"; 
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
    function delete($table, $where) { 
     
        if (!empty($this->id) && empty($where)) $where .= "id = $this->id"; 
     
        return parent::delete($this->table, $where); 
     
    } 
}
