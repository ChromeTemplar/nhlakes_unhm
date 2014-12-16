<?php

class sessionendController {
	
	var $name;
	var $registry;
	
	public function sessionendController ($registry){
		$this->registry = $registry;
		$this->name = strtolower(substr(get_class($this), 0, -10));
	}
	
	public function end() {
		$sessionVal = (empty ( $_SESSION ['IDKey'] )) ? '' : $_SESSION ['IDKey'];
		$loginNHVBSRdb = new loginNHVBSRmodel();
		$loginNHVBSRdb->deactivateSession($sessionVal, 'A');
		
		$_SESSION['Login.Error'] = "You are successfully logged off ! ";
		session_destroy();
		$this->registry->template->showlogon('session', 'LoginNHVBSR');
		
	}
	
	
}