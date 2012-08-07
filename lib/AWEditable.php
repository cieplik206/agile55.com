<?
class AWEditable extends AbstractController {
	function enableAdmin($page,$args=null){
		$url=$this->api->getDestinationURL($page,$args);

		$this->owner->js('dblclick')->univ()->dialogURL('Administration',$url);
		if($this->api->auth->isLoggedIn()){
			$this->owner->js('mouseenter',$this->owner->js()->_selectorThis()->css(array('background'=>'#fef')));
			$this->owner->js('mouseleave',$this->owner->js()->_selectorThis()->css(array('background'=>null)));
		}
	}
}
