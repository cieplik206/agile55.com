<?
class page_demo_d2 extends AWPage {
	function init(){
		parent::init();

		// text
		$this->js(true)->_selector('#footer')->fadeOut(4000);
		$this->js(true)->_selector('#nav')->slideUp(4000);


		$h1=$this->add('View_HtmlElement','h')->setElement('h1')->set('Agile Technologies presents');
		$h1->js(true)->hide()->fadeIn(2000);

		$p1=$this->add('View_HtmlElement','h1')->setElement('p')->set('Agile Toolkit');
		$p1->js(true)->hide()->css(array('font-size'=>'0%'))->delay(3000)->css(array('opacity'=>0))->show()->animate(array('opacity'=>1,'font-size'=>'500%'),2000);

		$t=$this->add('View_HtmlElement','br','r')->setElement('p')->set(
'In Agile Toolkit, we put simplicity, efficiency and productivity first. We are driven by innovation and results, rather than copying languages like Java.
'
);
		$t->js(true)->hide()->css(array('margin-top'=>0))->delay(6000)->fadeIn(2000);

		$t=$this->add('View_HtmlElement','p2','r')->setElement('p')->set(
'A perfect combination of qualities required for good business application and comfortable development platform is a win-win solution for any Web Developer
'
);
		$t->js(true)->hide()->css(array('margin-top'=>0))->delay(9000)->fadeIn(2000);

		$t=$this->add('Button','b1','r')->setLabel('Continue to "Grid" Demo');
		$t->js('click')->closest('.atk4_loader')->atk4_loader('loadURL',
								$this->api->getDestinationURL('demo/d3'));
		$t->js(true)->hide()->delay(11000)->fadeIn(2000);

		$t=$this->add('Button','b2','r')->setLabel('Technical Info');
		$t->js('click')->univ()->dialogURL('More info about this demo',$this->api->getDestinationURL('demo/d2/info'));
		$t->js(true)->hide()->delay(11000)->fadeIn(2000);


	}
	function defaultTemplate(){
		return array('page/demo/codesplit','_top');
	}
}
