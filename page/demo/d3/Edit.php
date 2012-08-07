<?
class page_demo_d3_Edit extends AWPage {
	function init(){
		parent::init();
		$this->add('LoremIpsum')->setLength(2,15);
	}
}
