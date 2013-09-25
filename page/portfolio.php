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
        array(
            'name'=>'3rd Chamber',
            'link'=>'portfolio/3rdchamber',
            'image'=>'images/portfolio/3rd_chamber.png',
            'tags'=>array('business','test'),
        ),
        array(
            'name'=>'X-Factor',
            'link'=>'portfolio/xfactor',
            'image'=>'images/portfolio/small-xfactor.jpg',
            'tags'=>array('business','test2'),
        ),
        array(
            'name'=>'My-Tools',
            'link'=>'portfolio/mytools',
            'image'=>'images/portfolio/small-mytools.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'Ven',
            'link'=>'portfolio/ven',
            'image'=>'images/portfolio/small-ven.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'zoubizous',
            'link'=>'portfolio/zoubizous',
            'image'=>'images/portfolio/zoubizous-profile.png',
            'tags'=>array(),
        ),
        array(
            'name'=>'Elexu.com',
            'link'=>'portfolio/elexu',
            'image'=>'images/portfolio/elexu-profile.png',
            'tags'=>array(),
        ),
        array(
            'name'=>'whitepier',
            'link'=>'portfolio/whitepier',
            'image'=>'images/portfolio/whitepier.png',
            'tags'=>array(),
        ),
        array(
            'name'=>'yapzar',
            'link'=>'portfolio/yapzar',
            'image'=>'images/portfolio/yapzar.png',
            'tags'=>array(),
        ),
        array(
            'name'=>'surf-accounts',
            'link'=>'portfolio/surfaccounts',
            'image'=>'images/portfolio/surf-accounts.png',
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
            'name'=>'Linked Finance',
            'link'=>'portfolio/linkedfinance',
            'image'=>'images/portfolio/small-linkedfinance.jpg',
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
            'name'=>'Apps Fuel',
            'link'=>'portfolio/appsfuel',
            'image'=>'images/portfolio/small-appsfuel.jpg',
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
            'name'=>'SortMyBooksOnline',
            'link'=>'portfolio/smbo',
            'image'=>'images/portfolio/smbo.jpg',
            'tags'=>array(),
        ),
        array(
            'name'=>'Realex',
            'link'=>'portfolio/realex',
            'image'=>'images/portfolio/realex.jpg',
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
            'name'=>'Gradpool',
            'link'=>'portfolio/gradpool',
            'image'=>'images/portfolio/gradpool.jpg',
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
