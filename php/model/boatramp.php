<?php

class boatRamp extends Model
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
        
        if (isset($results)){
            return $results;
        }else {
            return "";
        }
    } 
}

