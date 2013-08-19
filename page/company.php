<?php
class page_company extends AWPage {
	function init(){
		parent::init();

		if(isset($_GET['img'])){
			$this->add('View_HtmlElement')
				->setElement('img')
				->setAttr('src',$_GET['img'])
				->addClass('bigimage')
				->set(null)
				;
			return;
		}

		$d=$this->api->db->dsql()
			// ->debug()
			->table('team')
			->field('id, team.*')
			->do_getAssoc();
			
		// linkedin 	twitter 	google 	facebook 	blog
        $clear_social = false;
		foreach($d as $_k => $_v){
			// var_dump($_v);
			if (!$clear_social && ($_k == $_GET['AgileWeb_company_agileteam'] || !isset($_GET['AgileWeb_company_agileteam']))) {
				$this->checkSocialPresent('email',    $_v['email']);
				$this->checkSocialPresent('linkedin', $_v['linkedin']);
				$this->checkSocialPresent('twitter',  $_v['twitter']);
				$this->checkSocialPresent('google',   $_v['google']);
				$this->checkSocialPresent('facebook', $_v['facebook']);
				$this->checkSocialPresent('blog',     $_v['blog']);
                $clear_social = true;
			}
		}
		
		$team = $this->add('AgileTeam',null,'Team','Team')
			->setSource($d)//$this->api->agile_team)
			;
		
		if ($this->api->auth->isLoggedIn()){
			$team->enableAdmin();
		}
		
		/*
		$this->js('click',
				$this->js()->_selectorThis()->univ()->dialogURL(
						$this->js()->_selectorThis()->attr('title'),
						$this->js()->univ()->addArgument(
							$this->api->getDestinationURL(),
							'img',
							$this->js()->_selectorThis()->attr('href')
							)
					)
			)->_selector('#company-photos a');
		*/
			
		$this->template->trySet('moreNews', '<p><a href="?moreNews=true" class="moreNews">more</a></p>');
		
		$n = $this->add('NewsList', 'NewsList', 'NewsList','NewsList');
		if ($this->api->auth->isLoggedIn()){
			$n->add('AWEditable')->enableAdmin('admin/news');
		}
		if ($_GET['moreNews']){
			$this->template->tryDel('moreNews');
		}
		
	}
	function defaultTemplate(){
		return array('page/company','_top');
	}
	
	function checkSocialPresent($fieldName, $val) {
		// var_dump($fieldName . '>' . $val);
		if (!$val || '' == trim($val)){
			// echo 'del';
			$this->template->tryDel(strtolower($fieldName).'Block');
		}
	}
	

	
}

class NewsList extends CompleteLister {
	public $safe_html_output=false;
	
	private $emptyMessage = 'Error message text when empty CompleteLister (No records found)';
	
	function init(){
		parent::init();
		
		$modelNews = $this->add('Model_News');
		if ($_GET['moreNews']){
			$limit = false;
		}
		else {
			$limit = 5;
		}
		$arrData   = $modelNews->getAllActive($limit);
		
		if($arrData) {
			foreach ($arrData as $v => $_d){
				$arrData[$v]['title'] = $this->truncate($_d['title'], 45);
			}
		}
		// print_r($arrData);
		// $arrData = Array();
		$this->setStaticSource($arrData)->setEmptyStaticSourseMessage();
	}
	
	function setEmptyStaticSourseMessage($m=false){
		if(!$this->data) {
			$this->template->trySet('empty_lister_result', $m?$m:$this->emptyMessage);
			// $this->data['0']['empty_lister_result'] = 'Empty result';
		}
		return $this;
	}
	
	function truncate($string, $length = 80, $etc = '...') {
		if ($length == 0)
			return '';

		if (strlen($string) > $length) {
			$length -= min($length, strlen($etc));
			return substr($string, 0, $length) . $etc;
		} else {
			return $string;
		}
	}
}
