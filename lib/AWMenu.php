<?php
class AWMenu extends View {
	public $active,$inactive;
	
	function init(){
		parent::init();
		
		$this->active=$this->template->cloneRegion('active');
		$this->inactive=$this->template->cloneRegion('inactive');
		
		$this->template->del('items');
	}
	function addMenuItem($label,$page=null){
		if(is_null($page))$page=$label;
		
		if($page==$this->api->page){
			$t=$this->active;
		}else{
			$t=$this->inactive;
		}
		
		$t->set('Label',$label);
		// $t->setProperty('id','i40');
		$t->set('href',$this->api->getDestinationURL($page));
		
		$this->template->append('items',$t->render());
		return $this;
	}
	function defaultTemplate(){
		return 'Menu';
	}
	function defaultSpot(){
		return 'Menu';
	}
}
