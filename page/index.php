<?php
class page_index extends Page {
    function init() {
        parent::init();

        $this->add('Button',null,'Action')
            ->set('Try our Interractive Spec Builder')
            ->js('click')->univ()->frameURL();
    }
    function defaultTemplate() {
        return array('page/index');
    }
}
