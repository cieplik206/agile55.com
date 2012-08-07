<?
class page_demo extends AWPage {
	function init(){
		parent::init();

		$e=$this->add('View_HtmlElement')->set('');
		$e->js(true)->_load('ui.atk4_loader')->atk4_loader();

		//$this->add('Button')->setLabel('Start!')->js('click')->fadeOut('slow',
				$e->js(true)->atk4_loader('loadURL',$this->api->getDestinationURL('./d1'));

		/*
		$this->add('Button','d2')->setLabel('d2')->js('click',//)->fadeOut('slow',
				$e->js()->atk4_loader('loadURL',$this->api->getDestinationURL('./d2')));

		$this->add('Button','d3')->setLabel('d3')->js('click',//)->fadeOut('slow',
				$e->js()->atk4_loader('loadURL',$this->api->getDestinationURL('./d3')));

		$this->add('Button','d4')->setLabel('d4')->js('click',//)->fadeOut('slow',
				$e->js()->atk4_loader('loadURL',$this->api->getDestinationURL('./d4')));
				*/
	}
}
