<?php
class AgileTeam extends View {
	/*
	   This class implements multiple slides and ajax buttons for next/prev
	 */
	public $data;
	public $first_id=null;

	function init(){
		parent::init();
		$this->js('mouseenter')->_selector('#'.$this->name.'_thumb')->find('i b')->fadeIn('fast');
		$this->js('mouseleave')->_selector('#'.$this->name.'_thumb')->find('i b')->fadeOut('fast');
		/*
		$this->js('click')->_selector('#'.$this->name.'_thumb')->find('i b')->hide()
			->univ()->dialogURL('Hi',$this->js()->_selectorThis()->attr('href'));
			*/

		$this->js('click',
				$this->js()->atk4_loader(array('cut_object'=>$this->name))->atk4_loader('loadURL',$this->js()->_selectorThis()->attr('href'))
				)->_selector('.thumb-grid a');

		if(isset($_GET[$this->name])){
			$this->js(true)->_selector('#'.$this->name.'_thumb')->find('img')->hide()->fadeIn('slow');
		}
	}

	function render(){

		$d=$this->data[$_GET[$this->name]];
		if(!$d)$d=$this->data[$this->first_id];
		if($d) {
			//$d['email'] = $this->scramble($d['email'], '');
			$this->template->set($d);
            //$this->template->setHTML('email',$d['email']);
		}

		try{
			$this->template->set('thumb',$this->api->locateURL('template','temp/team-'.$d['thumb'].'-on.jpg'));
		}catch (PathFinder_Exception $e){
			try{
				$this->template->set('thumb',$this->api->locateURL('template','temp/team-'.$d['thumb'].'-on.png'));
			}catch (PathFinder_Exception $e){
				$this->template->set('thumb',$this->api->locateURL('template','temp/team-collibri-on.png'));
			}

		}
		//$this->template->set('link',$this->api->getDestinationURL($d['page']));

		parent::render();
	}
	function setSource($data){
		$this->data=$data;
		
		foreach($this->data as $f => $d){
			$k = $d['id'] = $f;
			// add bullet
			if(!$this->first_id)$this->first_id=$k;
			if(!isset($_GET[$this->name]))$_GET[$this->name]=$this->first_id;
			$el=$this->add('View',$k,'bullet',array('page/company','bullet'))
				;
			try{
				$el->template->set('thumb',$this->api->locateURL('template','temp/team-'.$d['thumb'].($_GET[$this->name]==$k?'-on':'-off').'.jpg'));
			}catch (PathFinder_Exception $e){
				try{
					$el->template->set('thumb',$this->api->locateURL('template','temp/team-'.$d['thumb'].($_GET[$this->name]==$k?'-on':'-off').'.png'));
				}catch (PathFinder_Exception $e){
					$el->template->set('thumb',$this->api->locateURL('template','temp/team-collibri'.($_GET[$this->name]==$k?'-on':'-off').'.png'));
				}
			}
			if($_GET[$this->name]!=$k)$el->template->del('selected');
			$el->template->set('href',$this->api->getDestinationURL(null,array($this->name=>$k)));



					//)$el->addClass('current');
		}

		$flip=$this->add('View_HtmlElement','flip','flip')->setElement('a')
			->addClass('flip_link');

		if($_GET[$this->name.'_contact']){
			$this->template->del('about');
			$flip->setAttr('href',$this->api->getDestinationURL(null,array($this->name=>$_GET[$this->name],
							$this->name.'_contact'=>false
							)))
			->set('Back to Bio')
			;
		}else{
			$this->template->del('contacts');
			$flip->setAttr('href',$this->api->getDestinationURL(null,array($this->name=>$_GET[$this->name],
							$this->name.'_contact'=>true
							)))
			->set('Contact Info')
			;
		}


		return $this;
	}
	
	function scramble($email, $title = false){
		$e=$this->api->page.'_scramble_'.preg_replace('~[^0-9a-z]~', '', $email);

		$email=preg_split('//',$email);
		$email=array_reverse($email);
		$email=join('',$email);
		$email=str_replace('@','##',$email);
		$email=str_replace('.','#',$email);
		if ($title) {
			$title = " title='" . $title . "'";
		}
		else {
			$title = "";
		}
		
		// var_dump($email);

		$this->js(true)->_selector('#'.$e)->univ()->unscramble();
			
		return '<a id="'.$e.'" rel="'.$email.'"' . $title . '>Scrambled. Use JavaScript.</a>';
	}
}
