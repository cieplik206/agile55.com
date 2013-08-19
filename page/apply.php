<?php
class page_apply extends AWPage {
	function init(){
		parent::init();
		$this->template->trySet('process_url',$this->api->getDestinationURL('apply/process'));
		$this->template->trySet('apply_ru',$this->api->getDestinationURL('apply/ru'));
	}
	function defaultTemplate(){
		return array('page/apply/index','_top');
	}
}
