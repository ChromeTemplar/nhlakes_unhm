<?php

class survey extends Model
{
    
    function __construct($id ="")
    {   
        if (empty($this->table)) {  
            $this->table = strtolower(get_class($this)); 
        }         
         
        if (!empty($id)) { 
            $this->id = $id; 
        } 
    }
    
    
    function all()
    {
        $table = $this->table;
        
        $result = $this->select($table);
        
        while($row = $result->fetch_assoc()){
            $results[] = $row; 
        }
        
        return $results;
    }
    
    
    /** 
     * Import CSV file into database 
     * 
     * @param   array   Data from CSV file 
     */
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
         
        return $this->query("INSERT INTO survey ($fields) VALUES $new_data"); 
    }
}