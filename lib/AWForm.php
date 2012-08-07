<?
class AWForm extends Form {
	public $js_widget='ui.atk4_form';
	function init(){
		parent::init();
		if($this->js_widget){
			$fn=str_replace('ui.','',$this->js_widget);
			$this->js(true)->_load($this->js_widget)->$fn(array(
						'base_url'=>$this->api->getDestinationURL(),
						//'useTipTip'=>true
						));
		}
	}
	function showAjaxError($field,$msg){
		if($msg=='1')throw new BaseException('Hey! Do not pass 1 as error message to showAjaxError!');
		$this->js(true)
			->atk4_form('clearError')
			->atk4_form('fieldError',$field->short_name,$msg)->execute();
	}
}
