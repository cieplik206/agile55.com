<?php
class page_index extends Page {
	function init(){
		parent::init();
		// $this->add('AgileSlides',null,'Slides','Slides')
			// ->setSource($this->api->front_slides)
			// ;
			
			
		$slides = $this->api->add('AgileSlides2',null,'Slides2','Slides2')
			// ->setSource($this->api->front_slides)
			->setSource(array('foo','bar','baz'));
			;

            $this->api->add('AgileTeam',null,'Team','Team')
->setSource(array ( 
	5 => array ( 'name' => 'Romans Malinovskis', 'title' => 'CTO', 'email' => '', 
		'descr' => 'Romans, a innovator in an Open Source field is a founder and a CTO of Elexu Technologies.  Having founded a number of successful software development companies in the past, Romans is skilled entrepreneur with great eye for technical talent and capable project manager. Romans works in London and is widely sought after as a consultant, architect, security and performance analyst.',
		'thumb' => 'romans',
		), 
	6 => array ( 'name' => 'Gita Malinovska', 'title' => 'CEO', 'email' => '', 
		'descr' => 'Gita is an experienced business and project manager.  During her extensive career in the software industry, Gita has served in a number senior leadership capacities, including as CEO and PMO lead.  Gita is expert at helping development organizations regain (and retain) focus on delivering commercially-viable products which delight the customer. ',
		'thumb' => 'gita', 
		), 
	8 => array ( 'name' => 'Dmitry', 'title' => 'Designer', 'email' => '', 
		'descr' => 'Dmitry is the pioneer of a futuristic design in user interface and usability consultant. He successfully started his design career at the age of 14 and continues to build a robust portfolio of outstanding UI and UX project designs. Dmitry helps us greatly to simplify our product design and make them more accessible.',
		 'thumb' => 'm', 
		 ), 
	9 => array ( 'name' => 'Janis Volbergs', 'title' => 'Senior Developer', 'email' => '', 'descr' => 'Janis is the development lead and web software architect. He have participated in over a hundred of client projects. Janis knows exactly how to solve any technical problem. He have started his developer carrier in 1997.', 
		'thumb' => 'jancha', 
		), 
	12 => array ( 'name' => 'Alex', 'title' => 'Development Manager', 'email' => '', 'descr' => 'With over 10 years\' experience in project management, Alex easily handles even the most complex and critical projects with ease. He oversees the process and resources throughout the project and makes sure all the tasks are completed on-time.',
		'thumb' => '', 
		), 
	13 => array ( 'name' => 'Serhij', 'title' => 'root', 'email' => '', 'descr' => 'Stas is a system programmer, Linux admin and our scalability specialist. He has 10+ year experience working with Linux companies and he has advised many companies on how to improve the scalability, security and efficiency of their server infrastructure. In addition to his commercial work, Stas is a part-time university professor and lecturer.', 'thumb' => 'stas', 'linkedin' => '', 'twitter' => '', 'google' => '', 
'facebook' => '', 'blog' => '', ), 14 => array ( 'name' => 'Max (Maxim)', 'title' => 'Developer', 'email' => '', 'descr' => 'Maxim has over 10 years experience in the web development field. He is an active participant in the Russian PHP-community. He knows all about different frameworks such as CakePHP and CodeIgniter.', 'thumb' => 'max', 'linkedin' => '', 'twitter' => '', 'google' => '', 'facebook' => '', 'blog' => '', ), 15 => array ( 'name' => 'Vadym', 'title' => 'Framework Developer', 'email' => '', 'descr' => 'Vadim discovered Agile Toolkit after 6+ years experience developing in Ruby on Rails and Symfony. He quickly realised the potential behind Agile Toolkit and was very eager to join our core team at Agile Technologies. Vadim works on client projects, including Elexuâ�¢ and Plugin Manager.', 'thumb' => '', 'linkedin' => 'http://www.linkedin.com/pub/vadym-radvansky/47/116/1a2', 'twitter' => '', 'google' => '', 'facebook' => '', 'blog' => '', ), )
);




		$this->js('click')->_selector('.newsletter')
			->univ()->dialogURL('Newsletter',$this->api->getDestinationURL('newsletter.html'),
					array('height'=>390));
		
		$f=$this->api->add('Form',null,'Contact')
			;
		$f->addField('line', 'name', 'Company')->setNotNull();
		$f->addField('line', 'email', 'E-mail')->setNotNull();
		$f->addField('line', 'phone', 'Phone')->setNotNull();
		//$f->addField('checkbox', 'nda', 'Request Elexu Technologies to send signed NDA')->setNotNull();
		$f->addField('text', 'message', 'Message');
        $f->addSubmit('Send');

        if($f->isSubmitted()){
        	$m=$this->add('TMail');
            $m->setTemplate('contact');
            //$m->addTransport('SES');
            $m->set($f->get());
            $m->set('subject','Contact Request from'.$f->get('name'));
            $x=$m->send('r@agiletech.ie');
            $this->js()->univ()->alert('Your message was delivered')->execute();


        }
		
	}
	function defaultTemplate(){
		return array('page/index','_top');
	}
}
