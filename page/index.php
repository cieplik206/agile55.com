<?php
class page_index extends Page {
	function init(){
		parent::init();
		// $this->add('AgileSlides',null,'Slides','Slides')
			// ->setSource($this->api->front_slides)
			// ;
			
			
		$slides = $this->add('AgileSlides2',null,'Slides2','Slides2')
			// ->setSource($this->api->front_slides)
			->setSource(array('foo','bar','baz'));
			;

		$this->js('click')->_selector('.newsletter')
			->univ()->dialogURL('Newsletter',$this->api->getDestinationURL('newsletter.html'),
					array('height'=>390));
		
		
	}
	function defaultTemplate(){
		return array('page/index','_top');
	}
}
