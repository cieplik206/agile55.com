<?php
class page_contact extends Page {
    function init(){
        parent::init();

        $f=$this->add('Form',null,'Contact');
        $f->addField('line', 'name', 'Company')->setMandatory('required');
        $f->addField('line', 'email', 'E-mail')->setMandatory('required');
        $f->addField('line', 'phone', 'Phone')->setMandatory('required');
        $f->addField('text', 'message', 'Message');
        $f->addSubmit('Send');

        if($f->isSubmitted()){
            $m=$this->add('TMail');
            $m->setTemplate('contact');
            $m->set($f->get());
            $m->set('subject','Contact Request from'.$f->get('name'));
            $x=$m->send('info@agiletech.ie');
            $this->js()->univ()->alert('Your message was delivered')->execute();
        }
    }
    function defaultTemplate(){
        return array('page/contact','_top');
    }

}
