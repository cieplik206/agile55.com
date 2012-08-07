<?
class page_demo_d1 extends AWPage {
	function init(){
		parent::init();

		$h1=$this->add('View_HtmlElement','h1')->setElement('h1')->set('What\'s common between PHP and jQuery?');
		$h2=$this->add('View_HtmlElement','h2')->setElement('h1')->set('They are - lightweight, simple to use, powerful, fast, extendable');

		$t1=$this->add('View_HtmlElement','t1')->setElement('h1')->set('What is the best way to use them together?');
		$t2=$this->add('View_HtmlElement','t2')->setElement('h1')->set('Through a toolkit - lightweigth, simple, fast end extensible');

		$h2->js(true)->hide();
		$t1->js(true)->hide();
		$t2->js(true)->hide();

		// text
		$h1->js(true)->hide()->fadeIn(2000)->delay(2000)->fadeOut('fast',
				$h2->js()->_enclose()->fadeIn(2000)->delay(2000)->fadeOut('fast',
					$t1->js()->_enclose()->fadeIn(2000)->delay(2000)->fadeOut('4000',
						$t2->js()->_enclose()->fadeIn(4000,
							$t2->js()->_enclose()->closest('.atk4_loader')->atk4_loader('loadURL',
								$this->api->getDestinationURL('demo/d2')))
						)
					)
				);


		// slowly hide menu
	}
	function defaultTemplate(){
		return array('page/demo/center','_top');
	}
}
