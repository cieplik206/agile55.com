<?php
class Lister_Tags extends CompleteLister {
	function init(){
		parent::init();
	}
    function formatRow(){
        parent::formatRow();

        $this->current_row['effect']=$_GET['tag']==$this->current_row['name']?'success':'info';

        //$this->current_row_html['link']=$this->api->url(null,array('tag'=>$this->current_row['link']));
    }
    function defaultTemplate(){
        return array('view/lister/tag');
    }
}
