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
        if ($this->current_row['tags'] != '') {
            foreach ($this->current_row['tags'] as $tag) {
                $this->current_row_html['tags'] = $this->current_row_html['tags'] . ' izotag_'.$tag;
            }
        }

    }
    function defaultTemplate(){
        return array('view/lister/project');
    }
}
