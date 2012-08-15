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
->setSource(
array ( 5 => array ( 'name' => 'Gita Malinovska', 'title' => 'CEO', 'email' => '', 'descr' => 'Gita joined Agile Toolkit in 2009 as the CEO. She has helped the company to regain its focus and to deliver a commercial product â�� Agile Toolkit. Gita also participates in project testing and quality assurance process.', 'thumb' => 'gita', 'linkedin' => 'http://ie.linkedin.com/in/agiletech', 'twitter' => '', 'google' => '', 'facebook' => '', 'blog' => '', ), 6 => array ( 'name' => 'Romans Malinovskis', 'title' => 'CTO', 'email' => '', 'descr' => 'Romans is the lead developer of Agile Toolkit since 1999. He founded Agile Technologies in 2008 to fund further development and commercialization of Agile Toolkit. Romans works in London and is sought after as a consultant, architect, security and performance analyst.', 'thumb' => 'romans', 'linkedin' => 'http://ie.linkedin.com/in/romansmalinovskis', 'twitter' => 'romaninsh', 'google' => 'http://profiles.google.com/romaninsh', 'facebook' => '', 'blog' => 'http://agiletoolkit.org/blog', ), 8 => array ( 'name' => 'Dmitry', 'title' => 'Designer', 'email' => '', 'descr' => 'Dmitry is the pixel-perfect designer behind Agile Toolkit and many client User Interface designs. He learned Photohop at the age of 14. Dmitry also participates in projects as a Creative Designer, CSS/HTML coder and UI usability expert.', 'thumb' => 'm', 'linkedin' => '', 'twitter' => 'http://www.twitter.com/mayacking', 'google' => 'http://mayack.com/', 'facebook' => '', 'blog' => 'http://dribbble.com/mayack', ), 9 => array ( 'name' => 'Janis Volbergs', 'title' => 'Senior Developer', 'email' => '', 'descr' => 'Janis is the development lead and architect for client projects. He and his team have worked on hundreds of client projects. Janis knows exactly how to solve any technical problem.', 'thumb' => 'jancha', 'linkedin' => 'http://www.linkedin.com/in/janisvolbergs', 'twitter' => 'jancha', 'google' => '', 'facebook' => '', 'blog' => '', ), 12 => array ( 'name' => 'Alex Chizhevski', 'title' => 'Development Manager', 'email' => '', 'descr' => 'With over 10 year experience of project management, Alex Chizhevski is the leader of the client project development division of Agile Technologies. He oversees the process as a project coordinator and resource manager.', 'thumb' => '', 'linkedin' => '', 'twitter' => '', 'google' => '', 'facebook' => '', 'blog' => '', ), 13 => array ( 'name' => 'Serhij', 'title' => 'root', 'email' => '', 'descr' => 'Stas is a system programmer, Linux admin and our scalability specialist. He has 10+ year experience working with Linux companies and he has advised many companies on how to improve the scalability, security and efficiency of their server infrastructure. In addition to his commercial work, Stas is a part-time university professor and lecturer.', 'thumb' => 'stas', 'linkedin' => '', 'twitter' => '', 'google' => '', 
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
		$f->addField('checkbox', 'nda', 'Request Elexu Technologies to send signed NDA')->setNotNull();
		$f->addField('text', 'message', 'Message');
        $f->addSubmit('Send');
		
	}
	function defaultTemplate(){
		return array('page/index','_top');
	}
}
