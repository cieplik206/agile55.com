<?php
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
		$data=array ( 0 => array ( 'id' => '1', 'label' => 'SortMyBooksOnline.com - Online Accounting Software', 'thumb' => 'content/big-smbo.jpg', 'small_thumb' => 'templates/jui/temp/client-thumbs/smbo.jpg', 'short_description' => 'Best online accounting software launched in Ireland. Contains invoices, quotes, payments, time sheets and much more.', 'description' => '<p>Following growing online community, Aisling Software required to build online solution for their desktop software. They&#160;struggled&#160;with different developers before coming Agile.</p><p>Agile took over the project that was one of the most complex financially and technical and delivered amazing solution. While some project functionality was down-scaled, we spent more energy making each component of the project simple, polished and perfect.</p><div class="image clearing"><div class="image-wrap"><img src="/templates/jui/temp/smbo-login.jpg" alt="SMBO Login page" height="481" width="768" /></div><p class="image-comment">&#160;SMBO login page.</p></div><div class="image clearing"><div class="image-wrap"><img src="/templates/jui/temp/smbo-front.jpg" alt="SMBO Front page" height="833" width="768" /></div><p class="image-comment">Front page of SMBO application</p></div>', 'url' => 'smbo', 'www_url' => 'www.sortmybooksonline.com', 'is_show_on_home' => 'Y', 'ord' => '88', 'html_title' => 'SortMyBooksOnline.com - Online Accounting Software', 'html_descr' => 'SortMyBooksOnline.com is finally launched after 1 year of hard work. It includes much more than any other accounting software.', 'html_keywords' => 'year end, audit log, customers, suppliers, fixed assets, reconciliation, vat periods, journals, jobs, projects, online accounting software, sortmybooksonline, smbo, accounting, time sheets, invoices, quotes, reports, payments, realex, bank accounts', ), 1 => array ( 'id' => '3', 'label' => 'Realex Developer\'s Resource Centre', 'thumb' => 'content/big-realex.jpg', 'small_thumb' => 'templates/jui/temp/client-thumbs/realex.jpg', 'short_description' => 'Realex Payments portal to provide technical information required to integrate with Realex containing list of user guides, developer guides, sample code and documentation.', 'description' => '<p>Realex Payments needed to have a more solid framework for their Resource Centre, CMS had to be integrated with their documentation collections and user access control.&#160;</p><p>Agile delivered portal built on top of Agile Toolkit that looked exactly how Realex Payments required while at the same time added functionality for:</p><ul><li>Documentation listing with download options</li><li>Code sample listings with syntax highlighting</li><li>Page-level security restrictions</li><li>Clean registration form</li><li>Forum and Live Chat integration</li><li>Structured CMS system for static pages</li><li>Blog syndication, Inside News and more</li></ul><div class="image clearing"><div class="image-wrap"><img src="/templates/jui/content/case-realex.jpg" alt="Realex Payments" /></div></div>', 'url' => 'realex', 'www_url' => 'resourcecentre.realexpayments.com', 'is_show_on_home' => 'Y', 'ord' => '90', 'html_title' => 'Realex Developer Resource Centre', 'html_descr' => 'New developer portal for Realex payments is now launched. User guides, documentation, shopping carts, news - all in one place', 'html_keywords' => 'developer portal, realex payments, realex, resource centre, user guide, documentation, shopping card, news, blogs', ), 2 => array ( 'id' => '2', 'label' => 'Agile is 2 Years', 'thumb' => 'content/big-agile2y.jpg', 'small_thumb' => 'templates/jui/content/small-agile2y.jpg', 'short_description' => 'Welcome to the party. Grab a slice of cake and relax while you watch the videos we have prepared.', 'description' => '<p>Welcome to the party. Grab a slice of cake and relax while you watch the <a href="http://www.agiletech.ie/newsletter/2009-10/" title="2y anniversary">videos we have prepared</a>.</p><div class="image clearing"><div class="image-wrap"><img src="/templates/jui/content/case-agile2y.jpg" alt="2 Year Anniversary" /></div></div>', 'url' => '2y', 'www_url' => 'www.agiletech.ie/2y', 'is_show_on_home' => 'Y', 'ord' => '93', 'html_title' => 'Agile 2nd Anniversary', 'html_descr' => 'Agile is now 2 years old. Graba slice of cake and celebrate with us', 'html_keywords' => 'job portal, online accounting software, saas, mapping solution, podcasts, domain portal,mypdocast, epicenter, locle, smbo, sortmybooksonline, gradpool, anniversary, agile technologies, agiletech', ), );

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

