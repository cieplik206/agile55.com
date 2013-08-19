<?php
class AdminPage extends AWPage {
	function isAllowed(){
		if(!$this->api->auth->isLoggedIn()){
			if($this->api->isAjaxOutput())$this->api->js(null,'document.location="'.$this->api->getDestinationURL('login').'"')->execute();
			if($_GET['cut_page']||$_GET['cut_object']||$_GET['cut_region']){
				// TODO - rely on header instead
				$this->js(true,'document.location="'.$this->api->getDestinationURL('login').'"');
				throw new Exception_StopInit();
			}

			// Finally if this is ordinary request
			$this->api->redirect('login');
		}
		$this->api->auth->check();
		return true;
	}
}
