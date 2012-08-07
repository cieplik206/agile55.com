<?
class page_apply_process extends AWPage {
	function init(){
		parent::init();

		$f=$this->add('Form',null,'ApplicationForm');
		$f->addField('line','full_name')->validateNotNULL();
		$f->addField('line','email')->validateNotNULL();
		$f->addField('line','country')->validateNotNULL();
		$f->addField('text','Links')->validateNotNULL()
			->setProperty('cols',20)
			->add('Text',null,'after_field')
			->set('<ins>Specify links to 
				Linkedin, portfolio or online resume</ins>');


		$f->add('Text',null,'form_body')->set('We will review your information and will email you further instructions');

		$f->addSubmit('Submit');
		//$f->setSource('applicant');

		if($f->isSubmitted()){
			$f->update();
			//$t=$this->add('TMail');
		}
	}
	function defaultTemplate(){
		return array('page/apply/process','_top');
	}
}
