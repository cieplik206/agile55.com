<?
class page_useskype extends AWPage {
	function init(){
		parent::init();

		$this->add('Text')->set('<h1>Why <i>the hell</i> did we set up that every <i>damn</i> skype account is being auto-recharged? So that next time
				someone is not sure about something - you could call Romans / Jancha / Everyone else</h1>');
		$this->js(true)->_selector('#content')->find('i')->hide();

		$show=$this->add('Button')->setLabel('Show Irish accent');
		$show->js('click',$this->js()->_selector('#content')->find('i')->show());

		$aa=$this->add('Button','b2')->setLabel('I CALLED!! (or tried!)');//->js('click')->univ()->alert('You shall be forgiven!');

		$t2=$this->add('View_HtmlElement','t3')->setElement('h2')->set('You shall be forgiven!');
		$t2->js(true)->hide();
		$aa->js('click',$t2->js()->show('slow'));


		$this->add('Text','t4')->set('<hr/><h3>Source:</h3>');
		$this->add('View_HtmlElement','source')->set(highlight_file(__FILE__,true));

	}
}
