<?
class AWView extends View {
	function enableAdmin($page=null,$args=null){
		if(is_null($page))$page=$this->defaultAdminPage();
		$url=$this->api->getDestinationURL($page,$args);

		$this->js('dblclick')->univ()->dialogURL('Administration',$url);
		if($this->api->auth->isLoggedIn()){
			$this->js('mouseenter',$this->js()->_selectorThis()->css(array('background'=>'#fef')));
			$this->js('mouseleave',$this->js()->_selectorThis()->css(array('background'=>null)));
		}
	}
	function defaultAdminPage(){
		return 'admin/team';
	}
}
