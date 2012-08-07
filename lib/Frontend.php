<?
class Frontend extends ApiFrontend {

	public $html_title = false;
	public $html_descr = false;
	public $html_keywords = false;

	function initLocations(){
		$this->addLocation('files','misc')
			->setParent($this->pathfinder->base_location);

		$this->addLocation('templates/jui/css','css')
			->setParent($this->pathfinder->base_location);

		$this->addLocation('templates/js','css')
			->setParent($this->pathfinder->atk_location);

		$this->addLocation('addons',array(
					'php'=>array(
						'crm/lib',
						'mvc'
						)
					))
			->setParent($this->pathfinder->base_location);
	}
	
	function init(){
		parent::init();
		$this->initLocations();
		

		//$this->dbConnect();
		//$this->auth=$this->add('SQLAuth');
		//$this->auth->setSource('admin','email','password');
		//$this->auth->usePasswordEncryption('sha1');

		$this->add('jUI');
		$this->js()
			->_load('atk4_univ')
			->_load('atk4_univ_ext')
			//->_load('ui.frame')
			;
		
		
		$this->addMenu();

		$this->template->trySet('page',$this->page);
	}
	function addMenu(){
		return;
		$m=$this->add('AWMenu');

		//$m->addMenuItem('Home','index');
		$m->addMenuItem('About','company');
		$m->addMenuItem('Services','services');
		$m->addMenuItem('Products','products');
		$m->addMenuItem('Portfolio','work');
		$m->addMenuItem('Blog','blog');
		$m->addMenuItem('Contact','contact');

		if($this->auth->isLoggedIn()){
			$m->addMenuItem('Logout','logout');

			$url=$this->api->locateURL('js','wymeditor/jquery.wymeditor.js');
			$this->api->template->append('js_include',
					'<script type="text/javascript" src="'.$url.'"></script>'."\n");
		}

	}
	
	
	function render(){
		$this->template->eachTag('misc',array($this->api,'locateMisc'));
		$this->template->eachTag('scramble',array($this->api,'scramble'));
		if($this->html_title){
			$this->template->trySet('html_title',    htmlspecialchars($this->html_title));
		}
		if($this->html_descr){
			$this->template->trySet('html_descr',    htmlspecialchars($this->html_descr));
		}
		if($this->html_keywords){
			$this->template->trySet('html_keywords', htmlspecialchars($this->html_keywords));
		}
		return parent::render();
	}
	function locateMisc($path){
		return $this->locateURL('misc',$path);
	}
	function scramble($email){
		$e=$this->api->page.'_scramble_';

		$email=preg_split('//',$email);
		$email=array_reverse($email);
		$email=join('',$email);
		$email=str_replace('@','##',$email);
		$email=str_replace('.','#',$email);

		$this->js(true)->_selector('#'.$e)->univ()->unscramble();
			
		return '<a id="'.$e.'" rel="'.$email.'">Scrambled. Use JavaScript.</a>';
	}
	function defaultTemplate(){
		if($_GET['alt-template']){
			$this->api->stickyGET('alt-template');
			return array('alt-shared','_top');
		}
		return parent::defaultTemplate();
	}
}
