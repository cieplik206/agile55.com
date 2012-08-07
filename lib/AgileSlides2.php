<?
class AgileSlides2 extends View {
	/*
	   This class implements multiple slides and ajax buttons for next/prev
	 */
	public $step,$data;

	function init(){
		parent::init();
		$this->step=$_GET[$this->name];
		
		
		$this->js('mouseenter')->_selector('#'.$this->name.'_thumb')->find('i')->fadeIn('fast');
		$this->js('mouseenter')->_selector('#'.$this->name.'_thumb')->find('b')->fadeIn('fast');
		
		$this->js('mouseleave')->_selector('#'.$this->name.'_thumb')->find('i')->fadeOut('fast');
		$this->js('mouseleave')->_selector('#'.$this->name.'_thumb')->find('b')->fadeOut('fast');
		
		$this->js('click',
				$this->js()->atk4_loader(array('cut_object'=>$this->name))->atk4_loader('loadURL',$this->js()->_selectorThis()->attr('href'))
				)->_selector('.project-indicator a');
		
		$this->js('click',
				$this->js()->atk4_loader(array('cut_object'=>$this->name))->atk4_loader('loadURL',$this->js()->_selectorThis()->attr('href'))
				)->_selector('a.project-next');

		if(isset($_GET[$this->name])){
			$this->js(true)->_selector('div.project-holder > div > img')->hide()->fadeIn('slow');
		}
	}

	function getNext(){
		$s=$this->step+1;
		if($s>=count($this->data))$s-=count($this->data);

		return $this->api->getDestinationURL(null,array($this->name=>$s));
	}
	function getPrev(){
		$s=$this->step-1;
		if($s<0)$s+=count($this->data);

		return $this->api->getDestinationURL(null,array($this->name=>$s));
	}

	function render(){
		// $this->template->set('prev',$this->getPrev());
		$this->template->set('next',$this->getNext());

		$d=$this->data[$this->step];
		$this->template->set($d);
		// $this->template->set('description',$this->api->locate('template',$d['thumb']));
		$this->template->set('thumb',$this->api->locateURL('template',$d['thumb']));
		// $this->template->set('link',$this->api->getDestinationURL($d['page']));

		parent::render();
	}
	function setSource($data){
		$this->data=$data;

		$this->step=$this->step% count($this->data);
		
		foreach($this->data as $k=>$d){
			$arrBullets[$k] = Array(
				'href'  => $this->api->getDestinationURL(null, array($this->name => $k)),
				'class' => "",
			);
			if($_GET[$this->name]==$k){
				$arrBullets[$k]['class'] = 'current';
			}
		}
		$this->add('CompleteLister',null, 'Bullets', 'Bullets')
			->setStaticSource($arrBullets);

		foreach($this->data as $k=>$d){
			// add bullet
			$el=$this->add('View_HtmlElement',$k,'bullet')
				->setElement('a')
				->set('')
				->setAttr('href',$this->api->getDestinationURL(null,array($this->name=>$k)))
				;
			if($_GET[$this->name]==$k)$el->addClass('current');
		}
		return $this;
	}
}


/*
class SlidesBullets extends CompleteLister {
	public $safe_html_output=false;
	function init(){
		parent::init();
		$arrBullets = Array();
		foreach($this->data as $k=>$d){
			$arrBullets[$k] = Array(
				'href'  => $this->api->getDestinationURL(null,array($this->name=>$k)),
				'class' => "",
			);
			if($_GET[$this->name]==$k){
				$arrBullets[$k]['class'] => ' class="corrent"'
			}
		}

		
		$this->setStaticSource($arrBullets);
	}
}
*/
