<?
class page_admin_team extends AdminPage {
	function init(){
		parent::init();

		if(isset($_GET['id'])){
			$this->api->stickyGET('id');

			$f=$this->add('AWForm');
			$f->addField('line','name');
			$f->addField('line','title');
			$f->addField('line','email');
			$f->addField('line','thumb');
			$f->addField('text','descr');

			$f->addField('line','linkedin','LinkedIn Profile');
			$f->addField('line','twitter','Twitter name');
			$f->addField('line','google','Google profile');
			$f->addField('line','facebook','Facebook name');
			$f->addField('line','blog','Blog URL');


			$f->setSource('team');
			$f->setConditionFromGET('id');

			$f->addSubmit('Save');
			$f->addButton('Cancel')
				->js('click')->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>false)));

			if($f->isSubmitted()){
				$f->update();
				$f->js()->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>false)))->execute();
			}
			return;
		}


		$g=$this->add('Grid')
			->setSource('team')
			->addColumn('text','id')
			->addColumn('text','name')
			->addColumn('text','email')
			->addColumn('text','thumb','pic')
			->addColumn('shorttext','descr')
			->addColumn('button','edit')
			->addColumn('button', 'delete')
			;
		$g->addButton('Add')
			->js('click')->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>0)));


		if(isset($_GET['edit'])){
			$g->js()->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>$_GET['edit'])))->execute();
		}
		if(isset($_GET['delete'])){
			$this->api->db->dsql()->table('team')->where('id', $_GET['delete'])->do_delete();
			$g->js()->reload()->execute();
		}

	}
}
