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
