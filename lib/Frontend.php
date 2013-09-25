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

        $m = $l->addMenu('MainMenu');
        $m->addMenuItem('index','Home');
        $m->addMenuItem('services','Services');
        $m->addMenuItem('team','Team');
        $m->addMenuItem('portfolio','Portfolio');
        $m->addMenuItem('contact','Contact');

        $l->addFooter()->setHTML('<div class="atk-cells"><div class="atk-cell atk-jackscrew">'.
            '&copy; 2003-2013 Agile55</div><div class="atk-cell">Powered by Agile Toolkit 4.3</div></div>');

        parent::initLayout();
    }

}
