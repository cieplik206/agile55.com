<?php
class View_PortfolioLinks extends View {
    function init() {
        parent::init();
        $this->template->set('prev_url',$this->api->url($this->prev));
        $this->template->set('next_url',$this->api->url($this->next));
    }
    function defaultTemplate() {
        return array('view/portfolio/_links');
    }
}