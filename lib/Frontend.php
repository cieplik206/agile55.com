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

        $l = $this->add('Layout_Fluid');

        $m = $l->addMenu('Menu');
        $m->addMenuItem('index','Home');
        $m->addMenuItem('services','Services');
        $m->addMenuItem('team','Team');
        $m->addMenuItem('portfolio','Portfolio');
        $m->addMenuItem('contact','Contact');

        $l->addFooter()->setHTML('&copy; 2003-2013 Agile55');

        parent::initLayout();
    }

}
