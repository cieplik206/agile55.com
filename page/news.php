<?php
class page_news extends AWPage {
	function init(){
		parent::init();
		
		$this->js(true)->_selector('#nav')->find('a[title|=Company]')->parent()->addClass('current-ancestor');
		
		$modelNews = $this->add('Model_News');
		
		if ($_GET['y']){
			$y = $_GET['y'];
		}
		else {
			$y = $modelNews->getLastYear();
		}

		$n = $this->add('NewsList','NewsList','NewsList','NewsList');
		$arrData   = $modelNews->getAllActiveForYear($y);
		$n->setStaticSource($arrData);
		$n->add('AWEditable')->enableAdmin('admin/news');
        
		$arrData   = $modelNews->getAllYears();
		
		foreach ($arrData as $_k => $_v){
			if ($_v['year'] == $y){
				$arrData[$_k]['class'] = ' class="selection darkblue"';
			}
			else {
				$arrData[$_k]['class'] = ' ';
			}
			//else
			// if ()
		}
		

		$y = $this->add('YearsList', 'YearsList', 'YearsList', 'YearsList');
		$y->setStaticSource($arrData);
		
		
		
	}
	
	function defaultTemplate(){
		return array('page/news','_top');
	}
}

class NewsList extends CompleteLister {
	public $safe_html_output=false;
	function init(){
		parent::init();
	}
}

class YearsList extends CompleteLister {
	public $safe_html_output=false;
	function init(){
		parent::init();
		

	}
}