<?
class page_admin_blog extends AdminPage {
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
			$f->addField('line','header_image');
			$f->addField('line','index_image');
			$f->addField('checkbox','public');
			$f->addField('checkbox', 'is_show_comments');
			$f->addField('checkbox', 'is_commented');
			$f->addField('line','author');
			$f->addField('text', 'short_descr');
			$f->addField('line','custom_view');

			$f->addField('text','descr')->js(true)->wymeditor(Array(
				'updateEvent'    => 'mouseenter',
				'updateSelector' => '.ui-button',
			));

			$af = $f->addField('checkbox', 'autosave')->setNoSave();
			$af->js(true)->parent()->hide();

			$f->setSource('blog');
			$f->setConditionFromGET('id');

			//$sbm = $f->addSubmit('Save')->addClass('wymupdate');
			//$f->addButton('Cancel')
				//->js('click')->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>false)));
				
				
			$autosave_cookie_name = $f->name.'descr';
			
			if ($_COOKIE[$autosave_cookie_name]) {
				$f->getElement('descr')->set($_COOKIE[$autosave_cookie_name]);
			}
			
			// $this->js(true)->univ()->makeAutosave('#'.$sbm->name, '#' . $af->name);
			
			if($f->isSubmitted()){
				if ($f->get('is_show_comments') == '') {
					$f->set('is_show_comments', 'N');
				}
				if ($f->get('is_commented') == '') {
					$f->set('is_commented', 'N');
				}
				if($f->get('autosave') == 'Y') {
					// echo '!!!!!!!!!!!!!!!!!!!!';
					setcookie ($autosave_cookie_name, $f->get('descr'), time() + 3600);
					$f->js()->execute();
				}
				else {
					// if ()
					$f->update();
					setcookie ($autosave_cookie_name, "", time() - 3600);
					$f->js()->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>false)))->execute();
				}
			}
			return;
		}
		
		$this->js(true)->_load('ui.atk4_expander')->_load('atk4_univ');


		$g=$this->add('Grid')
			->setSource('blog')
			->addColumn('text','date')
			->addColumn('text','title')
			->addColumn('text','author')
			// ->addColumn('shorttext','descr')
			->addColumn('button', 'edit')
			->addColumn('button', 'delete')
			;
		$g->addButton('Add')
			->js('click')->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>0)));


		if(isset($_GET['edit'])){
			$g->js()->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>$_GET['edit'])))->execute();
		}
		
		if(isset($_GET['delete'])){
			$this->api->db->dsql()->table('blog')->where('id', $_GET['delete'])->do_delete();
			$g->js()->reload()->execute();
		}

	}
}
