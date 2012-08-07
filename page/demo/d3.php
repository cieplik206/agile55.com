<?
class page_demo_d3 extends AWPage {
	function init(){
		parent::init();

		$h1=$this->add('View_HtmlElement','h')->setElement('h1')->set('What you write');

		$p1=$this->add('View_HtmlElement','h1')->setElement('pre')->set('$g=$this');
		$p1->js(true)->css(array('font-size'=>'200%'));

		$p1=$this->add('View_HtmlElement','h2')->setElement('pre');
		$src=
'  ->add(\'Grid\')
  ->setSource(\'team\')
  ->addColumn(\'text\',\'name\')
  ->addColumn(\'text\',\'title\')
  ';
				
		$p1->js(true)->css(array('font-size'=>'200%'))->hide()->delay(2000)->fadeIn();

		$t=$this->add('View_HtmlElement','br','r')->setElement('h1')->set('What you get');
		$t->js(true)->css(array('margin-top'=>0));

		$gg=$this->add('View_HtmlElement','gg','r')->setElement('div')->set('');

		$g=$gg->add('Grid',null)
			->setSource('team')
			->addColumn('text','name')
			->addColumn('text','title')
			;
		if(!isset($_GET['order'])){
			$g->js(true)->hide()->delay(4000)->fadeIn();
		}

		$f=$this->frame('Play with it')->add('AWForm');
		$f->owner->js(true)->hide()->delay(6000)->fadeIn();

		$f->addField('dropdown','order','Order table by')->setValueList(array(''=>'','name'=>'name','title'=>'title'));
		$f->addField('checkbox','draggable','Make Draggable');
		$f->addField('Slider','results','Limit')->set(10)->setLabels(0,'Max');

		$f->addField('checkbox','select','Allow Selection');
		$f->addField('line','select_n','Selection')->js(true)->closest('dl')->hide();

		$f->addField('checkbox','button_t','Add Top Button');
		$f->addField('checkbox','button_r','Add Row Button');

		$f->addField('checkbox','exp','Add Expander');

		$f->addSubmit('Apply');
		$f->addButton('Conclusion')->js('click')->closest('.atk4_loader')->atk4_loader('loadURL',
								$this->api->getDestinationURL('demo/d4'));


		if($_GET['button_r']){
			$g->addColumn('button','Test');
			$src.="->addColumn('button','Test')\n  ";
		}
		if($_GET['exp']){
			$this->js()->_load('ui.atk4_expander');
			$g->addColumn('expander_widget','Edit');
			$src.="->addColumn('expander_widget','Edit')\n  ";
		}


		if($_GET['order']=='name'){
			$g->dq->order('name');
			$src.="->order('name')\n  ";
		}
		if($_GET['order']=='title'){
			$g->dq->order('title');
			$src.="->order('title')\n  ";
		}
		if($_GET['draggable']){
			$g->js(true)->draggable();
			$src.=";\n\$g->js(true)->dragable()";
		}
		if(isset($_GET['results']) && $_GET['results']<10){
			$g->dq->limit((int)$_GET['results']);
			$src.=";\n\$g->dq->limit(".((int)$_GET['results']).")";
		}
		if($_GET['select']){
			$g->addSelectable($f->getElement('select_n'));
			$src.=";\n\$g->addSelectable(\$f->getElement('select_n'));";
		}

		if($_GET['button_t']){
			$g->addButton('Top Button')->js('click')->univ()->alert('hello world');
			$src.=";\n\$g->addButton('Top Button')\n  ->js('click')->univ()\n  ->alert('hello world')";
		}

		if($_GET['Test']){
			$g->js()->execute();
		}
		$p1->set($src.";");

		if($f->isSubmitted()){
			// refresh grid
			$gg->js(null,$p1->js()->reload($f->getAllData()))->reload($f->getAllData())->execute();
		}
	}
	function defaultTemplate(){
		return array('page/demo/codesplit','_top');
	}
}
