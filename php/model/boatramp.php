<?php

class BoatRamp extends Model
{
    function __construct($id ="")
    {   
        if (empty($this->table)) {  
            $this->table = get_class($this); 
        }         
         
        if (!empty($id)) { 
            $this->id = $id; 
        } 
    }
    
    
}

