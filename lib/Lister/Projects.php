<?php
class Lister_Projects extends CompleteLister {
	function init(){
		parent::init();
	}
    function formatRow(){
        parent::formatRow();

    }
    function defaultTemplate(){
        return array('view/lister/project');
    }
}
