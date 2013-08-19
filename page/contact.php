<?php
class page_contact extends AWPage {
	function init(){
		parent::init();
		$f=$this->add('Form',null,'Contact')
			;
		$f->addField('line', 'name', 'Name')->setNotNull();
		$f->addField('line', 'email', 'E-mail')->setNotNull();
		$f->addField('line', 'phone', 'Phone')->setNotNull();
		$f->addField('text', 'message', 'Your Message');
		$sec_image_field = $f->addField('line', 'sec_image', 'Security code')->setNotNull()->setNoSave()
			->setProperty('size', 10);
		;
		$sec_image_field->js(true)->closest('dl')->addClass('form_captcha');


		$session_name = $this->api->name;

		// $this->api->recall('captcha_keystring');
		// var_dump($_SESSION);
		$captcha_src = '/lib/kcaptcha/?' . $session_name . '=' . session_id();
		$kaptcha_img = $sec_image_field->getTag('img',array('src' => $captcha_src, 'id' => 'kpt' ));
		$kaptcha_img .= ' <a href="#" onclick="d=new Date(); (jQuery(\'#kpt\')'.
			'.attr(\'src\', \'' . $captcha_src . '&t=\' + d.getTime()));return false;">';
		$kaptcha_img .= '<i class="atk-icon atk-icons-nobg atk-icon-arrows-left3"></i>';
		$kaptcha_img .= ' reload</a>';
		$sec_image_field->template->set('after_field', '<ins>Enther the code you see below</ins> <span>' . $kaptcha_img . '</span>');

		$f->getElement('sec_image')->js(true)->parent()->addClass('form_captcha');

		$f->addSubmit('Send');

		if($f->isSubmitted()){

			if(!$this->api->recall('captcha_keystring', false) || $this->api->recall('captcha_keystring') != $f->get('sec_image')){
				$this->js()->univ()->successMessage('Security image error')->execute();
				die('<h1><font color="Red">Spammer? He, he.... (=</font></h1>');
			}

			$this->Notify = $this->add('NotifySender');
			// if (0) {
			$this->Notify->send(Array(
				'mail'    => $this->api->getConfig('contact/mailto', 'r@agiletech.ie'),
				'from'    => $f->get('name') . ' <' . $f->get('email') . '>',
				// 'from'    => 'maxim.antonuk@mail.ru',
				'subject' => 'CF: <' . $f->get('phone') . '>',
				'body'    => $f->get('message'),
			));
			// }
			
			$f->js(true)->univ()
                //->successMessage('Thank you for contacting us, we will get back to you shortly.')
					->location($this->api->getDestinationURL('contact/thanks'))
					->execute();
		}
	}
	function defaultTemplate(){
		return array('page/contact','_top');
	}
}
