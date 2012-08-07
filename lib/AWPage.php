<?
class AWPage extends Page {
	var $editables=0;
	function init(){
		parent::init();
		if(!$this->isAllowed()){
			throw new BaseException('Page is not allowed');
		}
	}
	function isAllowed(){
		return true;
	}
	function loadContent($content){
		list($content_key,$content)=preg_split('/\n/',$content,2);

		$e=$this->api->page.'_'.$content_key;
		$c=$this->api->db->dsql()
			->table('content')
			->where('ckey',$e)
			->field('content')
			->do_getOne();
		if($c)$content=$c;
		

		// look in the database substitution for $content_key
		
		if($this->api->auth->isLoggedIn()){
			$this->js('mouseenter',$this->js()->_selectorThis()->css(array('background'=>'#fef')))->_selector('#'.$e);
			$this->js('mouseleave',$this->js()->_selectorThis()->css(array('background'=>null)))->_selector('#'.$e);
			$this->js('dblclick')->_selector('#'.$e)->univ()->dialogURL('Administration',$this->api->getDestinationURL('admin/content',array('e'=>$e,
							't'=>$c?false:$content)));
		}
		return '<div id="'.$e.'">'.$content.'</div>';
	}
	function render(){
		$this->template->eachTag('template',array($this->api,'locateTemplate'));
		$this->template->eachTag('misc',array($this->api,'locateMisc'));
		$this->template->eachTag('editable',array($this,'loadContent'));

		$this->_setHtmlMeta();

		parent::render();
	}

	protected function _setHtmlMeta(){
		$n = $this->short_name;
		
		if ($title = $this->api->getConfig('head/' . $n . '/title', false)){
			$this->api->html_title = $title;
		}
		if ($descr = $this->api->getConfig('head/' . $n . '/descr', false)){
			$this->api->html_descr = $descr;
		}
		if ($keywords = $this->api->getConfig('head/' . $n . '/keywords', false)){
			$this->api->html_keywords = $keywords;
		}
	
	}
}
