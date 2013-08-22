<?php
class Frontend extends ApiFrontend {
    function init() {
        parent::init();

        /* ************************
         *   PATHFINDER
         */
        $this->pathfinder->addLocation('./',array(
            'addons'=>array('../atk4-addons','../addons'),
            'php'=>array('../shared'),
            'css'=>array(
                '../addons/cms/templates/default/css',
            ),
//            'js'=>array(
//                '../addons/cms/templates/js',
//            ),
            //'template'=>'atk4-addons/misc/templates',
        ));
        
        $this->add('jUI');

        $this->template->trySet('year',date('Y',time()));
        
    }

    function initLayout(){
        $m = $this->add('Menu', 'Menu', 'Menu');
        $m->addMenuItem('index','People');
        $m->addMenuItem('services','Services');
        $m->addMenuItem('approach','Approach');
        $m->addMenuItem('portfolio','Portfolio');
        $m->addMenuItem('contact','Contact');

        parent::initLayout();
    }

}
