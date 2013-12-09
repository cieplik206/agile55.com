<?php
class page_contact extends Page {
    function init(){
        parent::init();

        $f=$this->add('Form',null,'Contact');
        $f->addField('line', 'name', 'Company');
        $f->addField('line', 'email', 'E-mail');
        $f->addField('line', 'phone', 'Phone');
        $f->addField('text', 'message', 'Message');
        $f->addSubmit('Send')->addClass('atk-button atk-swatch-emerald');

        if($f->isSubmitted()){
            if ($f->get('name')==""){
                $f->js()->atk4_form('fieldError', 'name', "Cannot be empty!")->execute();
            }
            if ($f->get('email')==""){
                $f->js()->atk4_form('fieldError', 'email', "Cannot be empty!")->execute();
            }
            if(!filter_var($f->get('email'),FILTER_VALIDATE_EMAIL)){
                $f->js()->atk4_form('fieldError', 'email', "Wrong email format!")->execute();
            }
            if ($f->get('message')==""){
                $f->js()->atk4_form('fieldError', 'message', "Cannot be empty!")->execute();
            }
            $m=$this->add('TMail');
            $m->setTemplate('contact');
            $m->set($f->get());
            $m->set('subject','Contact Request from'.$f->get('name'));
            $x=$m->send($this->api->getConfig('tmail/from'));
            $this->js()->univ()->alert('Your message was delivered')->execute();
        }

        $this->add("View_HtmlElement",null,'tw_link')
            ->setElement('A')
            ->setAttr('href','https://twitter.com/intent/tweet?status='.$this->api->url('/')->useAbsoluteUrl())
            ->setAttr('target','_blank')
            ->addClass('twitter_share')
        ;

        $this->add("View_HtmlElement",null,'fb_link')->setElement('img')
            ->setElement('A')
            ->setAttr('href','https://www.facebook.com/sharer/sharer.php?u='.$this->api->url('/')->useAbsoluteUrl())
            ->setAttr('target','_blank')
            ->addClass('facebook_share')
        ;

        $this->js(true)->_selector('#accordion')->accordion(array('collapsible'=>true,'active'=>false));

    }
    function defaultTemplate(){
        return array('page/contact','_top');
    }

}
