<?
class AgileSlides extends View {
	/*
	   This class implements multiple slides and ajax buttons for next/prev
	 */
	public $step,$data;

	function init(){
		parent::init();
		$this->step=$_GET[$this->name];
		$this->js('mouseenter')->_selector('#'.$this->name.'_thumb')->find('i b')->fadeIn('fast');
		$this->js('mouseleave')->_selector('#'.$this->name.'_thumb')->find('i b')->fadeOut('fast');
		/*
		$this->js('click')->_selector('#'.$this->name.'_thumb')->find('i b')->hide()
			->univ()->dialogURL('Hi',$this->js()->_selectorThis()->attr('href'));
			*/

		$this->js('click',
				$this->js()->atk4_loader(array('cut_object'=>$this->name))->atk4_loader('loadURL',$this->js()->_selectorThis()->attr('href'))
				)->_selector('.slides-nav a');

		if(isset($_GET[$this->name])){
			$this->js(true)->_selector('#'.$this->name.'_thumb')->find('img')->hide()->fadeIn('slow');
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
		$this->template->set('prev',$this->getPrev());
		$this->template->set('next',$this->getNext());

		$d=$this->data[$this->step];
		$this->template->set($d);
		$this->template->set('thumb',$x=$this->api->locateURL('template',$d['thumb']));
		$this->template->set('link',$this->api->getDestinationURL($d['page']));

		parent::render();
	}
	function setSource($data){
		$this->data=$data;

		$this->step=$this->step% count($this->data);

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
