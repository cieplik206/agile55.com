<?php
class View_PortfolioOne extends View {
    function init() {
        parent::init();
    }
    function defaultTemplate() {
        return array('view/portfolio/'.$this->id);
    }
}