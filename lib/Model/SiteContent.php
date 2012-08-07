<?php
class Model_SiteContent extends AWModel{
	var $_tableName         = 'content';
	var $_databaseDriverKey = 'MyDsql';

	function init(){
		parent::init();
	}

	function getByCKey($c_key){
		return
		$this->_read(Array(
			'mode' => 'do_getHash',
			// 'debug' => true,
			'field' => '*',
			'condition' => Array (
				'ckey' => $c_key
			)
		));
	}
}