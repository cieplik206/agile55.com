<?php
class page_index extends Page {
    function init() {
        parent::init();

        /*
        $this->add('Button',null,'Action')
            ->set('Hire Us')
            ->addClass('atk-swatch-4')
            ->js('click')->univ()->frameURL();
         */
    }
    function defaultTemplate() {
        return array('page/index');
    }
}
