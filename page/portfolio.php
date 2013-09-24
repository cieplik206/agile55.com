<?php
class page_portfolio extends Page {
    function init(){
        parent::init();

        $tags_lister=$this->add('Lister_Tags',null,'tags');
        $tags_lister->setSource($this->getTags());

        $projects_lister=$this->add('Lister_Projects',null,'projects');
        $projects_lister->setSource($this->getProjects());
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
        ),
        array(
            'name'=>'Ven',
            'link'=>'portfolio/ven',
            'image'=>'images/portfolio/small-ven.jpg',
        ),
        array(
            'name'=>'zoubizous',
            'link'=>'portfolio/zoubizous',
            'image'=>'images/portfolio/zoubizous-profile.png',
        ),
        array(
            'name'=>'Elexu.com',
            'link'=>'portfolio/elexu',
            'image'=>'images/portfolio/elexu-profile.png',
        ),
        array(
            'name'=>'whitepier',
            'link'=>'portfolio/whitepier',
            'image'=>'images/portfolio/whitepier.png',
        ),
        array(
            'name'=>'yapzar',
            'link'=>'portfolio/yapzar',
            'image'=>'images/portfolio/yapzar.png',
        ),
        array(
            'name'=>'surf-accounts',
            'link'=>'portfolio/surfaccounts',
            'image'=>'images/portfolio/surf-accounts.png',
        ),
        array(
            'name'=>'SecureHost',
            'link'=>'portfolio/securehost',
            'image'=>'images/portfolio/small-securehost.jpg',
        ),
        array(
            'name'=>'Relate Software',
            'link'=>'portfolio/relate',
            'image'=>'images/portfolio/small-relate.jpg',
        ),
        array(
            'name'=>'PriviTo',
            'link'=>'portfolio/privito',
            'image'=>'images/portfolio/small-privito.jpg',
        ),
        array(
            'name'=>'Linked Finance',
            'link'=>'portfolio/linkedfinance',
            'image'=>'images/portfolio/small-linkedfinance.jpg',
        ),
        array(
            'name'=>'LimsABC',
            'link'=>'portfolio/lims',
            'image'=>'images/portfolio/small-lims.jpg',
        ),
        array(
            'name'=>'Job Tracker',
            'link'=>'portfolio/jobtracker',
            'image'=>'images/portfolio/small-jobtracker.jpg',
        ),
        array(
            'name'=>'Apps Fuel',
            'link'=>'portfolio/appsfuel',
            'image'=>'images/portfolio/small-appsfuel.jpg',
        ),
        array(
            'name'=>'The Alliance of Independent Authors',
            'link'=>'portfolio/alli',
            'image'=>'images/portfolio/small-alli.jpg',
        ),
        array(
            'name'=>'Wine',
            'link'=>'portfolio/wine',
            'image'=>'images/portfolio/small-wine.jpg',
        ),
        array(
            'name'=>'TunePresto.com',
            'link'=>'portfolio/tunepresto',
            'image'=>'images/portfolio/small-tunepresto.jpg',
        ),
        array(
            'name'=>'Newparkschool.ie',
            'link'=>'portfolio/newpark',
            'image'=>'images/portfolio/small-newpark.jpg',
        ),
        array(
            'name'=>'SalesJotter',
            'link'=>'portfolio/salesjotter',
            'image'=>'images/portfolio/small-salesjotter.jpg',
        ),
        array(
            'name'=>'Travelshake',
            'link'=>'portfolio/travelshake',
            'image'=>'images/portfolio/small-travelshake.jpg',
        ),
        array(
            'name'=>'SortMyBooksOnline',
            'link'=>'portfolio/smbo',
            'image'=>'images/portfolio/smbo.jpg',
        ),
        array(
            'name'=>'Realex',
            'link'=>'portfolio/realex',
            'image'=>'images/portfolio/realex.jpg',
        ),
        array(
            'name'=>'Epicenter',
            'link'=>'portfolio/epicenter',
            'image'=>'images/portfolio/epicenter.jpg',
        ),
        array(
            'name'=>'Obelisk Mobile Communication Websites',
            'link'=>'portfolio/obelisk',
            'image'=>'images/portfolio/obelisk.jpg',
        ),
        array(
            'name'=>'Eircom Locle',
            'link'=>'portfolio/locle',
            'image'=>'images/portfolio/locle.jpg',
        ),
        array(
            'name'=>'Gradpool',
            'link'=>'portfolio/gradpool',
            'image'=>'images/portfolio/gradpool.jpg',
        ),
        array(
            'name'=>'IrishDev',
            'link'=>'portfolio/irishdev',
            'image'=>'images/portfolio/irishdev.jpg',
        ),
        array(
            'name'=>'LaMaisonDuTriskel',
            'link'=>'portfolio/lamaisondutriskel',
            'image'=>'images/portfolio/small-triskel.jpg',
        ),
        array(
            'name'=>'DomainClub',
            'link'=>'portfolio/domainclub',
            'image'=>'images/portfolio/domainclub.jpg',
        ),
        array(
            'name'=>'MyPodcast',
            'link'=>'portfolio/mypodcast',
            'image'=>'images/portfolio/mypodcast.jpg',
        ),
        array(
            'name'=>'NextAction',
            'link'=>'portfolio/nextaction',
            'image'=>'images/portfolio/nextaction.jpg',
        ),
        array(
            'name'=>'Transpoco',
            'link'=>'portfolio/transpoco',
            'image'=>'images/portfolio/transpoco.jpg',
        ),
        array(
            'name'=>'iReachOnline',
            'link'=>'portfolio/ireach',
            'image'=>'images/portfolio/ireach.jpg',
        ),
    );


    function defaultTemplate(){
        return array('page/portfolio','_top');
    }
}
