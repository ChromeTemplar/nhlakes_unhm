<?php

class surveyModel extends Model
{
    
    /** 
     * Import CSV file into database 
     * 
     * @param   array   Data from CSV file 
     */
    function __construct($id ="")
    {   
        if (empty($this->table)) {  
            $this->table = strtolower(substr(get_class($this), 0, -5)); 
        }         
        if (empty($this->fields)) { 
            $this->query("SHOW COLUMNS FROM $this->table"); 
            foreach ($this->get() as $col) {
                $this->fields[] = $col->Field; 
            }
        } 
        if (!empty($id)) { 
            $this->id = $id; 
        } 
    }
    
    function import($data) 
    { 
     
        if (!is_array($data)) 
            return false; 
         
        for ($i=0; $i<count($data); $i++) { 
            for ($x=0; $x<count($data[$i]); $x++) 
                $data[$i][$x] = trim($this->escape($data[$i][$x])); 
            $new_data[] = '('.implode(',', $data[$i]).')'; 
        } 
         
        $new_data = implode(',', $new_data); 
         
        unset($this->fields[0]); 
        $fields = implode(',', $this->fields); 
         
        return $this->query("INSERT INTO agency ($fields) VALUES $new_data"); 
    }
}