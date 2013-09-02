<?php
class Frontend extends ApiFrontend {
    function init() {
        parent::init();

        /* ************************
         *   PATHFINDER
         */
        /*
        $this->pathfinder->addLocation('./',array(
            'addons'=>array('../atk4-addons','../addons'),
            'php'=>array('../shared'),
            ),
//            'js'=>array(
//                '../addons/cms/templates/js',
//            ),
            //'template'=>'atk4-addons/misc/templates',
        ));
         */
        
        $this->add('jUI');

        $this->template->trySet('year',date('Y',time()));
        
    }

    function initLayout(){
        $m = $this->add('Menu', 'Menu', 'Menu');
        $m->addMenuItem('index','Home');
        $m->addMenuItem('services','Services');
        $m->addMenuItem('team','Team');
        $m->addMenuItem('portfolio','Portfolio');
        $m->addMenuItem('contact','Contact');

        parent::initLayout();
    }

}
