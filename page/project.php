<?php
class page_project extends AWPage {
	function init(){
		parent::init();
		
		$this->add('PortfolioRandomList', 'PortfolioRandomList', 'PortfolioRandomList', 'PortfolioRandomList');
		
		$modelNews = $this->add('Model_Portfolio');
		$url = $_GET['url'];
		$arrData   = $modelNews->getByUrl($url);

		$this->api->html_title = $arrData['0']['html_title'];
		$this->api->html_descr = $arrData['0']['html_descr'];
		$this->api->html_keywords = $arrData['0']['html_keywords'];
		
		$pO = $this->add('PortfolioOne', 'PortfolioOne', 'PortfolioOne', 'PortfolioOne');
		$pO->setStaticSource($arrData);
		
		if ($this->api->auth->isLoggedIn()){
			$pO->add('AWEditable')->enableAdmin('admin/portfolio', Array('id' => $arrData[0]['id']));
		}
		
        
        $this->js(true)->_selector('#nav')->find('a[title|=Work]')->parent()->addClass('current-ancestor');
        
        $this->js('mouseenter',$this->js()->_selectorThis()->find('i b')->fadeIn('fast'))->_selector('.project-grid>div>a');
		$this->js('mouseleave',$this->js()->_selectorThis()->find('i b')->fadeOut('fast'))->_selector('.project-grid>div>a');
	}
	
	function defaultTemplate(){
		return array('page/project','_top');
	}
}

class PortfolioOne extends CompleteLister {
	public $safe_html_output=false;
	function init(){
		parent::init();
		
/*
		$modelNews = $this->add('Model_Portfolio');
		$url = $_GET['url'];
		$arrData   = $modelNews->getByUrl($url);
		// var_dump($arrData);
		$this->setStaticSource($arrData);
*/
	}
}

class PortfolioRandomList extends CompleteLister {
	public $safe_html_output=false;
	function init(){
		parent::init();
		
		$modelNews = $this->add('Model_Portfolio');
		$arrData   = $modelNews->getRandomList();
		
		$this->setStaticSource($arrData);
	}
}
