<?php
class page_admin_blog_comment extends AdminPage {
	function init(){
		parent::init();
		
		$this->js(true)->_load('atk4_univ');
		
		if(isset($_GET['id'])){
			// echo 'id';
			
			$f = $this->add('AWForm');
			
			$this->api->stickyGET('id');
			$this->api->stickyGET('edit');
			
			$f->setSource('blog_comment');
			$f->setCondition('id', $_GET['edit']);
			$f->addField('line', 'name');
			$f->addField('line', 'email');
			$f->addField('line', 'url');
			$f->addSubmit('Update');
			// $f->dq->debug();
			
			if($f->isSubmitted()){
				$f->update();
			}
			// $this->js()->univ()->successMessage('Edit Item')->execute();
		}
		
		$g=$this->add('Grid')
			->setSource('blog_comment')
			->addColumn('text', 'id')
			->addColumn('text', 'blog_id')
			->addColumn('text', 'visitor_id')
			->addColumn('text', 'name')
			->addColumn('text', 'email')
			->addColumn('text', 'url')
			->addColumn('text', 'is_enable')
			->addColumn('button','edit')
			->addColumn('button','status')
			->addColumn('button','delete')
			;
		$g->dq->where('blog_id', $_GET['id']);
		
		if ($_GET['status']){
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
			$g->js()->reload()->execute();
			
			// $this->js()->univ()->successMessage('Change Status')->execute();
		}
		
		if(isset($_GET['edit'])){
			$this->js()->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>$_GET['edit'])))->execute();
		}
	}
}
