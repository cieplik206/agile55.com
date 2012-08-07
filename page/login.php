<?
class page_login extends AWPage {
	function init(){
		parent::init();

		$this->frame('Accident?')->add('Text')->set('Whops? Did you double-click by accident? We used Agile Toolkit to turn our page into simple
				and flexible CMS. Double-clicking brings up a editing element. Want to know more? Get in touch with us and we
				will give you a demo!!');

		$f=$this->frame('Authentication for content editing')->add('Form');
		$f->addField('line','username','Login');
		$f->addField('password','password','Password');

		$f->addSubmit('Login');

		if($f->isSubmitted()){
			$a=$this->api->auth;

			if(!$a->verifyCredintials(
						$f->get('username'),
						$a->encryptPassword($f->get('password'))
						)){
				$a->loggedIn($f->get('username'),$a->encryptPassword($f->get('password')));
				$a->memorize('info',$a->info);
				$this->js()->univ()->location('/')->execute();
				//$a->loginRedirect();
			}
			$f->getElement('password')->displayFieldError('Incorrect login information');
		}
	}
}
?>
