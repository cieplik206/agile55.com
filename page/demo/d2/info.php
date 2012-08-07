<?
class page_demo_d2_info extends AWPage {
	function init(){
		parent::init();
		$this->add('Text')
			->set('
<h2>How this demo works?</h2>
<p>
This demo is also developed using Agile Toolkit. In fact, even through it features many jQuery effects - we didn\'t add even a single line of
raw JavaScript code. Demo consists of 4 main pages, loader and some supplimentary pages. Steps are changed dynamically through AJAX and are
executed by your browser.</p>
<p>
Use Inspector (or FireBug) to see what requests are passed between your browser and the backend. 
</p>

<h2>How Grid demo is done?</h2>
<p>
The Grid demo consists of 3 main components: The Source, The Grid and The Form.
<p>Form is being submitted through AJAX request when you click Apply. After validation page
issues a short command instructing browser to re-load 2 regions of the page through AJAX. Submitted data is passed
on. Finally results are drawn.</p>
<p><b>This demo does not use any customised Views or Controllers - simply becasue they are not needed here.</b>
</p>

');
		$tt=$this->add('View_HtmlElement','t')->setElement('div')->set('oo');
		$tt->js(true)->atk4_loader()->atk4_loader('loadURL',$this->api->getDestinationURL('company',
					array('cut_object'=>'agileteam',
						'AgileWeb_company_agileteam'=>6))
				);

	}
}
