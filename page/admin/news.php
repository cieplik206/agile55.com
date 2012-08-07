<?
class page_admin_news extends AdminPage {
	function init(){
		parent::init();

		if(isset($_GET['id'])){
			$this->api->stickyGET('id');

			$f=$this->add('AWForm');
			$f->addField('line','html_title');
			$f->addField('line','html_descr');
			$f->addField('line','html_keywords');
			$f->addField('line','title');
			$f->addField('DatePicker','date');
			$f->addField('line','url');
			$f->addField('checkbox','public');
			$f->addField('line','author');
			//$f->addField('text','descr')->js(true)->wymeditor();

			$f->addField('text','descr')->js(true)->wymeditor(Array(
				'updateEvent'    => 'mouseenter',
				'updateSelector' => '.ui-button',
			));

			//$f->addField('text','descr');

			$f->setSource('news');
			$f->setConditionFromGET('id');

			//$f->addSubmit('Save')->addClass('wymupdate');
			//$f->addButton('Cancel')
				//->js('click')->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>false)));

			if($f->isSubmitted()){
				//var_dump($f->get('descr'));
				//die('end');
				$f->update();
				$f->js()->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>false)))->execute();
			}
			return;
		}
		
		$this->js(true)->_load('ui.atk4_expander')->_load('atk4_univ');


		$g=$this->add('Grid')
			->setSource('news')
			->addColumn('text','date')
			->addColumn('text','title')
			->addColumn('text','author')
			->addColumn('shorttext','descr')
			->addColumn('button','edit')
			;
		$g->addButton('Add')
			->js('click')->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>0)));


		if(isset($_GET['edit'])){
			$g->js()->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>$_GET['edit'])))->execute();
		}

	}
}
