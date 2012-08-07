<?
class page_pwcheck extends AWPage {
	function init(){
		parent::init();
		$f=$this->add('AWForm',null,'Form');

		$p=$f->addField('password','password','Password')
			->setProperty('size',60)
			->setProperty('autocomplete','off');
		$p->template->set('after_field','<br/><span id="'.$p->name.'_strength">&nbsp;<span>');

		$p ->js(true)->focus()
			;

		//$f->addSubmit('Check');
		$p->js(true)->univ()->autoChange(1000);

		$p->js('change',$f->js()->submit());

		if($f->isSubmitted()){
			$pas=$f->get('password');

			$cl=$this->add('System_ProcessIO')
				->exec('/usr/sbin/cracklib-check')
				->write_all($pas)
				;
			$out=trim($cl->read_all());
			$out=str_replace($pas,'',$out);
			$out=preg_replace('/^:\s*/','',$out);


			$p->js()->_selector('#'.$p->name.'_strength')->text($out)->css(array('color'=>$out=="OK"?'black':'red'))->execute();
		}
	}
	function defaultTemplate(){
		return array('page/pwcheck','_top');
	}
}
