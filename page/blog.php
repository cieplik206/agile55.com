<?php
class page_blog extends AWPage {
	function init(){
		parent::init();
		
		if($_GET['blog_id']){
			$this->js()->univ()->dialogURL('Edit',
					$this->api->getDestinationURL('./edit',array('id'=>$_GET['edit'])),
					array('width'=>'400px','resizable'=>false)
					)->execute();
		}
		
		$f = $this->add('Model_Comment');
		
		$b = $this->add('Blog','Blog','Blog','Blog');
		if ($this->api->auth->isLoggedIn()){
			$b->add('AWEditable')->enableAdmin('admin/blog');
		}
	}
	function defaultTemplate(){
		return array('page/blog','_top');
	}
}

class Blog extends CompleteLister {
	public $safe_html_output=false;
	function init(){
		parent::init();
		$b = $this->add('Model_Blog');
		$arrData = $b->getAll();
		
		foreach ($arrData as $_k => $_v){
			if ($arrData[$_k]['is_show_comments'] != 'Y'){
				$arrData[$_k]['CommentContainer'] = '';
			}
		}
		
		$this->setStaticSource($arrData);
	}
}

class Comment extends CompleteLister {
	public $safe_html_output=false;
	function init(){
		parent::init();
		$this->setSource('blog_comment');
		$this->dq
			->order('id desc')
			->where('blog_id', '1')
			// ->debug()
		;
	}
}