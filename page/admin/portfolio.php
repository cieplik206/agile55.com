<?php
class page_admin_portfolio extends AdminPage {
	function init(){
		parent::init();
		// var_dump(get_defined_constants());
		if(isset($_GET['id'])){
			$this->api->stickyGET('id');
			
			/*
			$d = dirname(__FILE__) . '/../../templates/jui/temp';
			$files_list = $this->list_dir($d);
			*/
			
			$f=$this->add('AWForm');
			// id 	title 	thumb 	short_descr 	desc 	url 	is_show_on_home
			$f->addField('line','html_title');
			$f->addField('line','html_descr');
			$f->addField('line','html_keywords');
			$f->addField('line', 'label');
			
			/*
			$f->addField('dropdown', 'thumb')->setValueList(
				$files_list
			);
			*/
			
			$f->addField('line', 'thumb');
			$f->addField('line', 'small_thumb');
			$f->addField('text', 'short_description');
			$f->addField('text', 'description')->js(true)->wymeditor(Array(
				'updateEvent'    => 'mouseenter',
				'updateSelector' => '.ui-button',
			));
			$f->addField('line','url');
			$f->addField('line','www_url');
			$f->addField('checkbox','is_show_on_home');
			$f->addField('line', 'ord');

			$f->setSource('portfolio');
			$f->setConditionFromGET('id');

			//$f->addSubmit('Save')->addClass('wymupdate');
			//$f->addButton('Cancel')
				//->js('click')->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>false)));

			if($f->isSubmitted()){
				if ($f->get('is_show_on_home') == '') {
					//Don't work
					//$f->dq->set('is_show_on_home', "N");
					
					//Working ok
					$f->getElement('is_show_on_home')->set("N");
				} else {
					$f->getElement('is_show_on_home')->set("Y");
				}
				$f->update();
				$f->js()->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>false)))->execute();
			}
			return;
		}
		
		$this->js(true)->_load('ui.atk4_expander')->_load('atk4_univ');


		
		$g=$this->add('Grid')
			->setSource('portfolio')
			->addColumn('text','label')
			// ->addColumn('text','short_description')
			->addColumn('text', 'url')
			->addColumn('text', 'www_url')
			->addColumn('text', 'is_show_on_home')
			->addColumn('text', 'ord')
			->addColumn('button','edit')
			->addColumn('button','delete')
			;
		$g->dq->order('FIND_IN_SET(is_show_on_home, "Y,N") ASC, ord ASC');
		// $g->dq->debug();
		$g->addButton('Add')
			->js('click')->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>0)));


		if(isset($_GET['edit'])){
			$g->js()->closest('.atk4_loader')->atk4_loader('loadURL',$this->api->getDestinationURL(null,array('id'=>$_GET['edit'])))->execute();
		}
		
		if(isset($_GET['delete'])){
			$this->api->db->dsql()->table('portfolio')->where('id', $_GET['delete'])->do_delete();
			$g->js()->reload()->execute();
		}

	}
	
	function list_dir($dir){
		$arrFiles = Array();
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					$arrFiles[$file] = $file;
				}
			}
			closedir($handle);
		}
		return ($arrFiles);
	}
}
