<?
class page_subscribe extends AWPage {
	function init(){
		parent::init();

		if($_GET['m']){
			$this->api->stickyGET('m');
			$this->add('View_Info')->set(htmlspecialchars($_GET['m']));
			/*
			$f=$this->add('AWForm');
			if($f->isSubmitted()){
				$f->js()->univ()->closeDialog()->execute();
			}
			*/
			return;
		}

		$this->add('View_Hint')->set('Our newsletter is sent out once every few months. We use it to tell more about our recent projects and links to case studdies');
		$f=$this->add('AWForm');
		$f->addField('line','email')->setProperty('size',40);
		//$f->addField('checkbox','quote','I might want Agile to handle my next Web Software project');
		$f->addField('checkbox','atk','I would like to get updates on Agile Toolkit');
		$f->addField('line','name','Full Name')->setProperty('size',40);
		$c=$this->add('Controller_crm_CampaignMonitor');

		if($f->isSubmitted()){
			$result=$c->addRequest('AddSubscriber')
				->set('ListID',$this->api->getConfig('crm/cm/list/newsletter'))
				->set('Email',$f->get('email'))
				->set('Name',$f->get('name'))
				->process()->result;

			if($f->get('atk')){
				$result=$c->addRequest('AddSubscriber')
					->set('ListID',$this->api->getConfig('crm/cm/list/atk'))
					->set('Email',$f->get('email'))
					->set('Name',$f->get('name'))
					->process()->result;
			}
			$f->js()->closest('.atk4_loader')
				->atk4_loader('loadURL',$this->api->getDestinationURL(null,array(
								'm'=>$result->Message
								)))
				->execute();
			
		}
	}
}
