<?php
class Model_Portfolio extends AWModel{
	var $_tableName         = 'portfolio';
	var $_databaseDriverKey = 'MyDsql';
	function init(){
		parent::init();
	}
	
	function getByHomePage(){
		return
		$this->_read(Array(
			'field' => '*',
			'condition' => Array (
				'is_show_on_home' => 'Y'
			),
			'order' => 'ord ASC'
		));
	}
	
	function getAll(){
		return
		$this->_read(Array(
			'mode'      => 'do_getAllHash',
			'field'     => '*',
			'order' => 'ord ASC'
		));
	}
	
	function getRandomList($num=4){
		return $this->api->db->dsql()->table($this->_tableName)
			// ->debug()
			->field('*')
			->limit($num)
			->order('RAND()')
			->do_getAllHash();
	}
	function getByUrl($url){
		return $this->api->db->dsql()->table($this->_tableName)
			// ->debug()
			->field('*')
			->where('url', $url)
			->do_getAllHash();
	
	}
	
}