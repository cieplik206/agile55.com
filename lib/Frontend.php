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

        $this->pathfinder->addLocation('.',array(
            'mail'=>array('atk4/mail','templates/mail'),
//            'php'=>array('lib','../atk4-addons','../addons'),
        ))
            ->setBasePath(getcwd())
//            ->setBaseURL($this->api->url('/').'/atk4')
        ;

        $this->add('jUI');

        $this->template->trySet('year',date('Y',time()));

    }

    function initLayout(){

        $l = $this->add('Layout_Fluid');

        $m = $l->addMenu('MainMenu');
        $m->addMenuItem('services','Services');
        $m->addMenuItem('team','Team');
        $m->addMenuItem('portfolio','Portfolio');
        $m->addMenuItem('contact','Contact');

        $l->addFooter()->setHTML('<div class="atk-cells atk-jackscrew"><div class="atk-cell">'.
            'Powered by Agile Toolkit 4.3</div><div class="atk-cell atk-align-right"><a href="'.
            $this->api->url('login')
            .'"><span class="icon-key-1"></span>Client Login</a></div></div>');

        parent::initLayout();
    }

}
