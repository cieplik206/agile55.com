<?php
class page_news_view extends AWPage {
	function init(){
		parent::init();
        
        $this->js(true)->_selector('#nav')->find('a[title|=Company]')->parent()->addClass('current-ancestor');
		$news_url = $_GET['url'];
		// var_dump($_GET);
		$newsModel = $this->add('Model_News');
		$arrData   = $newsModel->getByUrl($news_url);
		
		if ($arrData) {
			$this->api->html_title = $arrData['html_title'];
			$this->api->html_descr = $arrData['html_descr'];
			$this->api->html_keywords = $arrData['html_keywords'];
        
            $prev = $newsModel->getNavigation($arrData['id'], $arrData['date'], 'prev');
			if ($prev) {
				$str = '<h3 class="prev">&larr; <a href="/news/' . $prev['year'] . '/' . $prev['url'] . '">' . $prev['formated_date'] . '</a></h3>';
				$this->template->trySet('NewsBefore', $str);
			}
			
			$after = $newsModel->getNavigation($arrData['id'], $arrData['date'], 'next');
			if ($after) {
				$str = '<h3 class="next"><a href="/news/' . $after['year'] . '/' . $after['url'] . '"">' . $after['formated_date'] . '</a> &rarr;</h3>';
				$this->template->trySet('NewsNext', $str);
			}
        
        
			foreach ($arrData as $_k => $_v) {
				$this->template->trySet('News' . ucfirst(strtolower($_k)), $_v);
			}
			if ($this->api->auth->isLoggedIn()){
				$this->add('AWEditable')->enableAdmin('admin/news', Array('id' => $arrData['id']));
			}
		}
	}
	function defaultTemplate(){
		return array('page/news_view','_top');
	}

	//function render(){
		//$this->api->html_title = 'child';
		//parent::render();
	//}
}
