<?php
class page_work_view extends AWPage {
	function init(){
		parent::init();
	}
	function defaultTemplate(){
		$url = basename($_GET['url']);
		return array('page/work/'.$url,'_top');
	}
}
