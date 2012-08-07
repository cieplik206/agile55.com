<?
class page_index extends AWPage {
	function init(){
		parent::init();
		//$this->api->jui->addStylesheet('front','.css',true);
		// $this->add('AgileSlides',null,'Slides','Slides')
			// ->setSource($this->api->front_slides)
			// ;
			
		$modelPortfolio = $this->add('Model_Portfolio');
		$arrData        = $modelPortfolio->getByHomePage();
		
		// var_dump($arrData);
		// var_dump($this->api->front_slides);
			
		$slides = $this->add('AgileSlides2',null,'Slides2','Slides2')
			// ->setSource($this->api->front_slides)
			->setSource($arrData)
			;
			
		if ($this->api->auth->isLoggedIn()){
			$slides->add('AWEditable')->enableAdmin('admin/portfolio');
		}
			
		$b = $this->add('LastBlogRow', 'LastBlogRow', 'LastBlogRow', 'LastBlogRow');
		$b->add('AWEditable')->enableAdmin('admin/blog');

		$this->js('click')->_selector('.newsletter')
			->univ()->dialogURL('Newsletter',$this->api->getDestinationURL('newsletter.html'),
					array('height'=>390));
		
		
	}
	function defaultTemplate(){
		return array('page/index','_top');
	}
}

class LastBlogRow extends CompleteLister {
	public $safe_html_output=false;
	function init(){
		parent::init();
			
		$modelBlog = $this->add('Model_Blog');
		$arrData   = $modelBlog->getLastRow();
		
		// var_dump($arrData);
		
		if ($arrData['is_show_comments'] != 'Y'){
			$arrData['CommentContainer'] = '';
		}
		
		// print_r($arrData);
		
		$this->setStaticSource(Array($arrData));

	}
}
