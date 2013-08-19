<?php
class page_work extends AWPage {
	function init(){
		parent::init();

	//	$this->add('Button',null,'buttons')->js('click')->univ()->dialogURL('Hi There',$this->api->getDestinationURL('./smbo'));
		$p = $this->add('Portfilio', 'Portfilio', 'Portfilio', 'Portfilio');
		
		if ($this->api->auth->isLoggedIn()){
			$p->add('AWEditable')->enableAdmin('admin/portfolio');
		}
		
		$this->js('mouseenter',$this->js()->_selectorThis()->find('i b')->fadeIn('fast'))->_selector('.project-grid>div>a');
		$this->js('mouseleave',$this->js()->_selectorThis()->find('i b')->fadeOut('fast'))->_selector('.project-grid>div>a');
		/*
		$this->js('click',
				$this->js()->_selectorThis()->find('i b')->univ()
					->dialogURL(
						$this->js()->_selectorThis()->find('span')->text(),
						$this->js()->_selectorThis()->attr('href')
					)
			)->_selector('.project-grid>div>a');
		*/
	}
	function defaultTemplate(){
		return array('page/work','_top');
	}
}

class Portfilio extends CompleteLister {
	public $safe_html_output=false;
	function init(){
		parent::init();
		$modelPortfolio = $this->add('Model_Portfolio');
		$arrData        = $modelPortfolio->getAll();
		$this->setStaticSource($arrData);
	}
}
