<?php
class page_portfolio_one extends Page {
    function init(){
        parent::init();
        $prevNextUrls=$this->getPrevNextUrls();
        $this->add('View_PortfolioLinks',array(
                'prev'=>$prevNextUrls['prevUrl'],
                'next'=>$prevNextUrls['nextUrl'],
            ),
            'links');
        $this->add('View_PortfolioOne',array('id'=>$this->getThisUrl()));
    }

    function getPrevNextUrls(){
        $thisUrl=$this->getThisUrl();
        $prevUrl='';
        $i=0;
        foreach($this->api->projects as $project){
            if($project['link']=='portfolio/'.$thisUrl) {
                if($prevUrl=='') {
                    $prevUrl=$this->api->projects[count($this->api->projects)-1]['link'];
                }
                if(isset($this->api->projects[$i+1])){
                    $nextUrl=$this->api->projects[$i+1]['link'];
                }else{
                    $nextUrl=$this->api->projects[0]['link'];
                }
                return array('prevUrl'=>$prevUrl,'nextUrl'=>$nextUrl);
            }
            $prevUrl=$project['link'];
            $i++;
        }
    }
    function getThisUrl(){
        $aUrl=explode('/',$_SERVER['REQUEST_URI']);
        return($aUrl[count($aUrl)-1]);
    }

    function defaultTemplate(){
        return array('page/portfolio/one');//.$_GET['url_hash'],'_top');
    }
}
