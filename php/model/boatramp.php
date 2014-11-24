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
    
    
}

