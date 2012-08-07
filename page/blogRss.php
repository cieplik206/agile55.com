<?php
class page_blogRss extends AWPage {
	function init(){
		parent::init();
		$RSSchannel = $this->add('RSSchannel');
		$RSSchannel->title = 'Agillec.ie blog rss';
		// echo $rss;
		$m = $this->add('Model_Blog');
		$arrData = $m->getAll();
		// print_r($arrData);
		if ($arrData){
			foreach ($arrData as $_d){
				$RSSchannel->newItem($_d['title'], $_d['short_descr'], date('r', strtotime($_d['date'])));
			}
		
		}
	}
	
	//function defaultTemplate(){
	//	echo '1';
	//	return array('rss');
	//}
}
