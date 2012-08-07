<?php
class NotifySender extends AbstractController{
	private $__sUserMail;
	private $__sMailSubject;
	private $__sMailBody;
	private $__sMailTemplate;
	private $__arrMailTags;
	private $__objMailer;
	
	private $__sMailFrom;
	
	private function __getMailer(){
		if(!$this->__objMailer){
			$this->__objMailer = $this->add('TMail');
		}
		return $this->__objMailer;
	}
	
	function initSender($sMail, $sSubject, $sBody=false, $sTemplate=false, $arrTags=false, $sFrom=false){
		$this->__setUserMail($sMail);
		$this->__setMailSubject($sSubject);
		$this->__setMailBody($sBody);
		$this->__setMailTemplate($sTemplate);
		$this->__setMailTags($arrTags);
		$this->__setMailFrom($sFrom);
	}
	
	private function __getUserMail(){
		if (!$this->__sUserMail){
			throw new NotifySenderException('User email must be set ');
		}
		else {
			return $this->__sUserMail;
		}
	}
	
	private function __getMailSubject(){
		if (!$this->__sMailSubject){
			throw new NotifySenderException('Mail Subject must be set ');
		}
		else {
			return $this->__sMailSubject;
		}
	}
	
	private function __getMailBody(){
		if (!$this->__sMailBody){
			throw new NotifySenderException('Mail Body must be set ');
		}
		else {
			return $this->__sMailBody;
		}	
	}
	
	private function __getMailTemplate(){
		return $this->__sMailTemplate;
	}
	
	private function __getArrMailTags(){
		return $this->__arrMailTags;
	}
	
	private function __getMailFrom(){
		return $this->__sMailFrom;
	}
	
	private function __setUserMail($string){
		if (!preg_match('/^(.+)@([^@]+)$/', $string)){
			throw new NotifySenderException('Invalid email ' . $string);
		} 
		else {
			$this->__sUserMail = trim($string);
		}
	}
	
	protected function __setMailSubject($string){
		$this->__sMailSubject = trim($string);
	}
	
	protected function __setMailBody($mailBody=false){
		if ($mailBody){
			if (is_array($mailBody)){
				$this->__sMailBody = implode(PHP_EOL, $mailBody);
			}
			else {
				$this->__sMailBody = trim($mailBody);
			}
		}
	}
	
	private function __setMailTemplate($template=false){
		if ($template){
			$this->__sMailTemplate = trim($template);
		}
	}
	
	private function __setMailTags($arrTags=false){
		if ($arrTags){
			$this->__arrMailTags = trim($arrTags);
		}
	}
	
	private function __setMailFrom($mail=false){
		if ($mail){
			$this->__sMailFrom = trim($mail);
		}
	}
	
	function send($data=false){
		if ($data) {
			$this->initSender($data['mail'], $data['subject'], $data['body'], 
				$data['template'], $data['tags'], $data['from']);

			if (!$this->__getUserMail() || !$this->__getMailSubject()){
				throw new NotifySenderException('Please initSender() before send() ');
			}
			else {
				$this->__send();
			}
		}
		else {
			$this->__send();
		}
	}
	
	protected function __send(){
		$this->__getMailer()->set('subject', $this->__getMailSubject());
		
		if ($this->__getMailFrom()) {
			$this->__getMailer()->set('from', $this->__getMailFrom());
		}

		if ($this->__getMailBody()) {
			$this->__getMailer()->body = $this->__getMailBody();
		}
		
		if ($this->__getMailTemplate()) {
			$this->__getMailer()->loadTemplate($this->__getMailTemplate());
		}
		
		if ($this->__getArrMailTags()) {
			foreach ($this->__getArrMailTags() as $k => $v){
				$this->__getMailer()->setTag($k, $v);
			}
		}
		/*
		*/
		$this->__getMailer()->send($this->__getUserMail());
	}
}

class NotifySenderException extends BaseException{}