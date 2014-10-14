<?php
/**
* Main Controller. All other controllers Extend this
* 
*/
Abstract class Controller 
{
    
    /*
    * @registry object
    */
    protected $registry;

    function __construct($registry) {
        $this->registry = $registry;
    }

    /**
    * @all controllers must contain an index method
    */
    abstract function index();
    
}
