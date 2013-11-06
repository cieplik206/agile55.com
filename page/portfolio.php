<?php
class page_portfolio extends Page {
    function init(){
        parent::init();
        $this->js(true)
                ->_load('jquery.isotope.min')
                ->_css('isotope')
        ;

        //$tags_lister=$this->add('Lister_Tags',null,'tags');
        //$tags_lister->setSource($this->getTagHashes());

        $projects_lister=$this->add('Lister_Projects',null,'projects');
        $projects_lister->setSource($this->getProjects());

        $projects_lister->js(true)->isotope(array(
            'itemSelector' => '.isotope-item',
            'animationOptions'=> array(
                 'duration'=> 750,
                 'easing'  => 'linear',
                 'queue'   => false
            ),
        ));

        $this->template->set('isotope_container',$projects_lister->name);

        // $('#container').isotope({ filter: '.metal' });

        $but_set = $this->add('View',array(),'tags_buttons')->setClass('atk-move-right');
        $tags=$this->getTags();
        for ($i=0; $i<count($tags); $i++) {
            $but_set->add('View')->setClass('atk-move-left tag_item')->set($tags[$i])->js('click',
                $projects_lister->js()->isotope(array(
                    'filter' => '.izotag_'.$tags[$i],
                )));
            if ($i<(count($tags)-1)) $but_set->add('View')->setClass('atk-move-left')->set(', ');
        }
            /*
            $but_set->addButton($tag)->js('click',
                $projects_lister->js()->isotope(array(
                    'filter' => '.izotag_'.$tag,
                )));
            */
    }

    function getTags(){
        $tags=array('all');
        foreach ($this->api->projects as $project){
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
            foreach ($this->api->projects as $p){
                if ($p['tags']){
                    if (in_array($_GET['tag'],$p['tags'])){
                        $projects[]=$p;
                    }
                }
            }
            return $projects;
        }else{
            return $this->api->projects;
        }
    }


    function defaultTemplate(){
        return array('page/portfolio','_top');
    }
}
