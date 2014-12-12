<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of router
 *
 * @author colby
 */
class router {
    /*
     * @the registry
     */
     private $registry;

     /*
     * @the controller path
     */
     private $path;

     private $args = array();

     public $file;

     public $controller;

     public $action;
     
     function __construct($registry) {
        $this->registry = $registry;
     }
     
    /**
    *
    * @set controller directory path
    *
    * @param string $path
    *
    * @return void
    *
    */
    function setPath($path) {
        
        /*** check if path is a directory ***/
        if (is_dir($path) == false)
        {
            throw new Exception ('Invalid controller path: `' . $path . '`');
        }
        /*** set the path ***/
        $this->path = $path;
    }
    
    
    /**
    *
    * @load the controller
    *
    * @access public
    *
    * @return void
    *
    */
    public function loader()
    {
        /*** check the route ***/
        $this->getController();	
        
        /*** if the file is not there die ***/
        if (is_readable($this->file) == false)
        {
            echo $this->file;
            die ('404 Not Found');
        }
        
        /*** include the controller ***/
        include $this->file;
        
        /*** a new controller class instance ***/
        $class = $this->controller . 'Controller';

        $controller = new $class($this->registry);
        
        /*** check if the action is callable ***/
        if (is_callable(array($controller, $this->action)) == false)
        {
            $action = 'index';
            
        }
        else
        {
            $action = $this->action;
        }
        
        /*** run the action ***/
        $controller->$action();
        
    }
    
    /**
    *
    * @get the controller
    *
    * @access private
    *
    * @return void
    *
    */
    private function getController() {

        /*** get the route from the url ***/
        $route = (empty($_GET['rt'])) ? '' : $_GET['rt'];
		
		/**
		 * Before the userLogin the Login Screen is loaded 
		 * 1. The index method in the LoginNHVBSRController class is executed
		 * 2. After the userEnters the userId and password the validate 
		 * method is executed 
		 */
        
        $sessionVal = '';
        
		if (! (empty ( $route ))) {
			
			if (session_status() == PHP_SESSION_NONE) {
				session_start ();
			}
			
			$sessionVal = (empty ( $_SESSION ['IDKey'] )) ? '' : $_SESSION ['IDKey'];
		} 
        
		if (empty ( $route ) && empty ( $sessionVal )) {
			$this->action = 'index';
			$this->controller = 'LoginNHVBSR';
		} else if ((!empty ( $route )) && empty ( $sessionVal )) {
			$this->action = 'validateUserId';
			$this->controller = 'LoginNHVBSR';
		} else if (! empty ( $sessionVal )) {
			
			//validates if the request to the webapp has a active sesion
			//setup 
			$this->validateActiveSession($sessionVal);
			
			if (empty ( $route )) {
				$route = 'index';
			} else {
				/**
				 * * get the parts of the route **
				 */
				$parts = explode ( '/', $route );
				$this->controller = $parts [0];
				if (isset ( $parts [1] )) {
					$this->action = $parts [1];
				}
			}
			
			if (empty ( $this->controller )) {
				$this->controller = 'home';
			}
			
			/**
			 * * Get action **
			 */
			if (empty ( $this->action )) {
				$this->action = 'index';
			}
		}

        /*** set the file path ***/
        $this->file = $this->path .'/'. $this->controller . '.php';
    }
    
    /***
     * Below method will be called to check if the request to the
     * webApp has a active session, if an active session is not 
     * found error message is thrown 
     * @param unknown $sessionVal
     */
    private function validateActiveSession($sessionVal) {
    	
    	//LoginNHVBSRController
    	/*** include the controller ***/
    	$klassLoc = $this->path . '/' . 'LoginNHVBSR.php';
    	include $klassLoc;
    	
    	$klass = 'LoginNHVBSR' . 'Controller'; 
    	$loginCntrller = new $klass($this->registry);
    	if ($loginCntrller->checkActiveSession($sessionVal)) {
    		return true;
    	} else {
    		return false;
    	}
    }
}
