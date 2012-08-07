<?
class page_admin_comment extends AdminPage {
	function init(){
		parent::init();
		
		$modelBlog = $this->add('Model_Blog');
		$arrData   = $modelBlog->getById($_GET['blog_id']);
		$this->add('Text')->set('<h1>Blog: ' . $arrData['title'] . '</h1>');
		// var_dump($arrData);

		if(isset($_GET['id'])){
			$this->api->stickyGET('id');
			$this->api->stickyGET('blog_id');
			
			$f=$this->add('AWForm');
			$f->addField('line', 'name');
			$f->addField('line', 'email');
			$f->addField('line', 'url');
			$f->addField('text', 'comment');
			$f->addField('checkbox', 'is_enable');
			
			if (!$_GET['id']){
				$f->addField('line', 'blog_id')->set($_GET['blog_id'])->js(true)->parent()->parent()->parent()->hide();
			}

			$f->setSource('blog_comment');
			$f->setConditionFromGET('id');

			$f->addSubmit('Save');
			$f->addButton('Cancel')
				->js('click')->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>false)));

			if($f->isSubmitted()){
				if ($f->get('is_enable') == '') {
					$f->getElement('is_enable')->set('N');
				}
				$f->update();
				$f->js()->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>false)))->execute();
			}
			return;
		}
		
		$g=$this->add('Grid')
			->setSource('blog_comment')
			->addColumn('text','id')
			->addColumn('text','name')
			->addColumn('text','email')
			->addColumn('text','url')
			->addColumn('text','comment')
			->addColumn('text','is_enable')
			->addColumn('button','status')
			->addColumn('button','edit')
			->addColumn('button','delete')
			;
		// $g->dq->debug();
		$g->dq->where('blog_id', $_GET['blog_id']);
		$g->addButton('Add')
			->js('click')->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>0, 'blog_id' => $_GET['blog_id'])));
			
			
		if ($_GET['status']){
		
			$blog_id = $this->api->db->dsql()->table('blog_comment')->field('blog_id')
				->where('id', $_GET['status'])->do_getOne();
			
			$status = $this->api->db->dsql()->table('blog_comment')->where('id', $_GET['status'])
				->field('is_enable AS status')
				->do_getOne();
			
			if ($status == 'Y') {
				$this->api->db->dsql()->table('blog_comment')->where('id', $_GET['status'])
					->set('is_enable', 'N')->do_update();
			}
			else {
				$this->api->db->dsql()->table('blog_comment')->where('id', $_GET['status'])
					->set('is_enable', 'Y')->do_update();
			}
			$g->js()->reload(Array('blog_id' => $blog_id))->execute();
		}


		if(isset($_GET['edit'])){
			$blog_id = $this->api->db->dsql()->table('blog_comment')->field('blog_id')
				// ->debug()
				->where('id', $_GET['edit'])->do_getOne()
				;
			$g->js()->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>$_GET['edit'], 'blog_id' => $blog_id)))->execute();
		}
		
		if(isset($_GET['delete'])){
			$blog_id = $this->api->db->dsql()->table('blog_comment')->field('blog_id')
				->where('id', $_GET['delete'])->do_getOne();
			
			$this->api->db->dsql()->table('blog_comment')->where('id', $_GET['delete'])->do_delete();
			$g->js()->reload(Array('blog_id' => $blog_id))->execute();
		}

	}
}
