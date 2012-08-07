<?
class page_admin_content extends AdminPage {
	function init(){
		parent::init();

		$this->api->stickyGET('e');

		$f=$this->add('AWForm');
		$f->addField('readonly','Key')->set($_GET['e']);
		$f->addField('text','content')->set($_GET['t'])->js(true)->wymeditor(Array(
			'updateEvent'    => 'mouseenter',
			'updateSelector' => '.ui-button',
		));

		$f->setSource('content');
		$f->setConditionFromGET('ckey','e');

		//$f->addSubmit('Save')->addClass('wymupdate');
		//$f->addButton('Cancel')
			//->js('click')->univ()->closeDialog();

		if($f->isSubmitted()){
			$f->update();
			$f->js()->univ()->closeDialog()->execute();
		}
	}
}
