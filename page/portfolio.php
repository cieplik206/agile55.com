<?php
class page_portfolio extends Page {
    function init(){
        parent::init();
        $this->js(true)->_load('jquery.isotope.min');

        $tags_lister=$this->add('Lister_Tags',null,'tags');
        $tags_lister->setSource($this->getTagHashes());

        $projects_lister=$this->add('Lister_Projects',null,'projects');
        $projects_lister->setSource($this->getProjects());

        return;
        $projects_lister->js(true)->isotope(array(
            'itemSelector' => '.isotope-item',
            'animationOptions'=> array(
                 'duration'=> 750,
                 'easing'  => 'linear',
                 'queue'   => false
            ),
        ));

        // $('#container').isotope({ filter: '.metal' });
/*
        $but_set = $this->add('ButtonSet',array(),'tags_buttons');
        foreach ($this->getTags() as $tag) {
            $but_set->addButton($tag)->js('click',
                $projects_lister->js()->isotope(array(
                    'filter' => '.izotag_'.$tag,
                )));
        }
        */
    }

    function getTags(){
        $tags=array('all');
        foreach ($this->projects as $project){
            if( ($project['tags']) && is_array($project['tags']) ){
                foreach ($project['tags'] as $tag){
                    if (!in_array($tag,$tags)) $tags[]=$tag;
                }
            }
        }
        return $tags;
    }
    function getTagHashes() {
        $tags = $this->getTags();
        $tags_hash=array();
        for ($i=0; $i<count($tags); $i++){
            if ($tags[$i]!='all'){
                $tags_hash[]=array(
                    'link'=>$this->api->url(null,array('tag'=>$tags[$i])),
                    'name'=>$tags[$i],
                );
            }else{
                $tags_hash[]=array(
                    'link'=>$this->api->url(null,array('tag'=>null)),
                    'name'=>$tags[$i],
                );
            }
        }
        return $tags_hash;
    }
    function getProjects(){
        if ($_GET['tag'] && $_GET['tag']!=''){
            $projects=array();
            foreach ($this->projects as $p){
                if ($p['tags']){
                    if (in_array($_GET['tag'],$p['tags'])){
                        $projects[]=$p;
                    }
                }
            }
            return $projects;
        }else{
            return $this->projects;
        }
    }

    protected $projects=array(
        // most important
        array(
            'name'=>'The X-Factor - Fame Game',
            'link'=>'portfolio/xfactor',
            'image'=>'images/portfolio/small-xfactor.jpg',
            'tags'=>array('development','design','hosting'),
            'descr'=>'We were contracted to develop a Online RPG game for a major entertainment brand. During period of three months we have developed a fully-functional HTML5-based multiplayer roleplayer game.'
        ),
        array(
            'name'=>'AppsFuel',
            'link'=>'portfolio/appsfuel',
            'image'=>'images/portfolio/small-appsfuel.jpg',
            'tags'=>array('design','training'),
            'descr'=>'AppsFuel is a platform developed and owned by Docomo Japan. We were contracted to provide a commercial Agile Toolkit support. With our help, a team of developers successfully adopted Agile Toolkit for one of the biggest on-line projects run by Docomo.'
        ),
        array(
            'name'=>'SortMyBooks Online',
            'link'=>'portfolio/smbo',
            'image'=>'images/portfolio/smbo.jpg',
            'tags'=>array('development','design','hosting'),
            'descr'=>'A small development company in Ireland contracted us to convert their desktop accounting application into On-line software. By worked together we have built an on-line accounting software which is considered to be one of the most simple-to-use on-line accounting packages for the past 4 years.'
        ),
        array(
            'name'=>'Elexu.com',
            'link'=>'portfolio/elexu',
            'image'=>'images/portfolio/elexu-profile.png',
            'tags'=>array('training','developent','design'),
            'descr'=>'Elexu is an startup working to build a new generation of interractive social television. Our team have developed the initial prototypes and helped to hire and train in-house developers.'
        ),
        array(
            'name'=>'Ven',
            'link'=>'portfolio/ven',
            'image'=>'images/portfolio/small-ven.jpg',
            'tags'=>array('development','design','hosting','training'),
            'descr'=>'HubCulture is a company operating one of the major virtual currencies - Ven. Our team have built a scalable architecture for a next generation of Ven financial framework. Not often PHP is used for high-end financial systems, but with Agile Toolkit the system turned out to be efficient, stable and secure'
        ),
        array(
            'name'=>'Linked Finance',
            'link'=>'portfolio/linkedfinance',
            'image'=>'images/portfolio/small-linkedfinance.jpg',
            'tags'=>array('development','hosting'),
            'descr'=>'Yet another on-line financial project - Linked Finance is a peer-to-peer investment platform. Operating large amount of micro-investments this project rivals Kickstarter in its sophistication. Again - Agile Tookit have excelled at doing pristine job at getting the numbers to match'
        ),
        array(
            'name'=>'surf-accounts',
            'link'=>'portfolio/surfaccounts',
            'image'=>'images/portfolio/surf-accounts.png',
            'tags'=>array('design'),
            'descr'=>'SurfAccounts is one of the rare projects in which we did not develop but only contributed the design. A sophisticated and well-polished user interface was developed to make this on-line accounting and payroll solution easy to use'
        ),
        array(
            'name'=>'Realex',
            'link'=>'portfolio/realex',
            'image'=>'images/portfolio/realex.jpg',
            'tags'=>array('development'),
            'descr'=>'A largest european credit card merchant hired our team to build their Developer Resource Center.'
        ),

        // Less important clients
        array(
            'name'=>'Gradpool',
            'link'=>'portfolio/gradpool',
            'image'=>'images/portfolio/gradpool.jpg',
            'tags'=>array('startup','development','design','hosting'),
            'descr'=>'Gradpool is a start-up aiming at helping out graduate students to find an appropriate internship program. We have helped to develop the initial prototype of the application and then refactor it entirely. Only the flexibility of Agile Toolkit would have alowed us to adopt quicky to the changing business requirements'
        ),
        array(
            'name'=>'3rd Chamber',
            'link'=>'portfolio/3rdchamber',
            'image'=>'images/portfolio/3rd_chamber.png',
            'tags'=>array('startup','development','design','hosting'),
            'descr'=>'An interesting idea on how to improve poitical structure in UK sparked this curious project. Agile Toolkit allowed us to build an initial prototype very quickly and later add design on top of existing business logic.',
        ),
        array(
            'name'=>'My-Tools',
            'link'=>'portfolio/mytools',
            'image'=>'images/portfolio/small-mytools.jpg',
            'tags'=>array('development','design','hosting'),
            'descr'=>'While it appears that My-Tools is just another on-line store, it is actually a highly custom commerce site. It is integrated with an extensive management software from jPoint and is actually one of the biggest on-line stores in Ireland'
        ),


        array(
            'name'=>'zoubizous',
            'link'=>'portfolio/zoubizous',
            'image'=>'images/portfolio/zoubizous-profile.png',
            'tags'=>array('development','design','discontinued'),
            'descr'=>'We have started to develop this project as a joint venture with a private investor, but had to stop after the initial build due to funding problems. We agreed to open-source the project and use it as a tutorial for anyone who wants to earn Agile Toolkit'
        ),
        array(
            'name'=>'whitepier',
            'link'=>'portfolio/whitepier',
            'image'=>'images/portfolio/whitepier.png',
            'tags'=>array('development','design','discontinued'),
        ),
        array(
            'name'=>'yapzar',
            'link'=>'portfolio/yapzar',
            'image'=>'images/portfolio/yapzar.png',
            'tags'=>array(),
        ),
        array(
            'name'=>'SecureHost',
            'link'=>'portfolio/securehost',
            'image'=>'images/portfolio/small-securehost.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'Relate Software',
            'link'=>'portfolio/relate',
            'image'=>'images/portfolio/small-relate.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'PriviTo',
            'link'=>'portfolio/privito',
            'image'=>'images/portfolio/small-privito.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'LimsABC',
            'link'=>'portfolio/lims',
            'image'=>'images/portfolio/small-lims.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'Job Tracker',
            'link'=>'portfolio/jobtracker',
            'image'=>'images/portfolio/small-jobtracker.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'The Alliance of Independent Authors',
            'link'=>'portfolio/alli',
            'image'=>'images/portfolio/small-alli.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'Wine',
            'link'=>'portfolio/wine',
            'image'=>'images/portfolio/small-wine.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'TunePresto.com',
            'link'=>'portfolio/tunepresto',
            'image'=>'images/portfolio/small-tunepresto.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'Newparkschool.ie',
            'link'=>'portfolio/newpark',
            'image'=>'images/portfolio/small-newpark.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'SalesJotter',
            'link'=>'portfolio/salesjotter',
            'image'=>'images/portfolio/small-salesjotter.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'Travelshake',
            'link'=>'portfolio/travelshake',
            'image'=>'images/portfolio/small-travelshake.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'Epicenter',
            'link'=>'portfolio/epicenter',
            'image'=>'images/portfolio/epicenter.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'Obelisk Mobile Communication Websites',
            'link'=>'portfolio/obelisk',
            'image'=>'images/portfolio/obelisk.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'Eircom Locle',
            'link'=>'portfolio/locle',
            'image'=>'images/portfolio/locle.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'IrishDev',
            'link'=>'portfolio/irishdev',
            'image'=>'images/portfolio/irishdev.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'LaMaisonDuTriskel',
            'link'=>'portfolio/lamaisondutriskel',
            'image'=>'images/portfolio/small-triskel.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'DomainClub',
            'link'=>'portfolio/domainclub',
            'image'=>'images/portfolio/domainclub.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'MyPodcast',
            'link'=>'portfolio/mypodcast',
            'image'=>'images/portfolio/mypodcast.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'NextAction',
            'link'=>'portfolio/nextaction',
            'image'=>'images/portfolio/nextaction.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'Transpoco',
            'link'=>'portfolio/transpoco',
            'image'=>'images/portfolio/transpoco.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'iReachOnline',
            'link'=>'portfolio/ireach',
            'image'=>'images/portfolio/ireach.jpg',
            'tags'=>array(),
        ),
    );


    function defaultTemplate(){
        return array('page/portfolio','_top');
    }
}
