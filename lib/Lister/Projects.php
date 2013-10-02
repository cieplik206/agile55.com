<?php
class Lister_Projects extends CompleteLister {
	function init(){
		parent::init();
	}
    function formatRow(){
        parent::formatRow();

        /* ****************************************
         *
         *     Tags for Isotope jQuery plugin
         *
         */
        $this->current_row_html['tags'] = '';
        $tag_links = array();
        if ($this->current_row['tags'] != '') {
            foreach ($this->current_row['tags'] as $tag) {
                $this->current_row_html['tags'] = $this->current_row_html['tags'] . ' izotag_'.$tag;
                $tag_links[]='<a class="label" href="'.$this->api->url(null,array('tag'=>$tag)).'">'.$tag.'</a>';
            }
        }
        $this->current_row_html['tag_links'] = join(', ',$tag_links);
    }
    function defaultTemplate(){
        return array('view/lister/project');
    }
}
