<?php

class Model_Visitor extends AWModel{
	var $_tableName         = 'visitor';
	var $_databaseDriverKey = 'MyDsql';

	function init(){
		parent::init();
	}
	
	function generateUniqId(){
		return (md5(uniqid('', true)));
		
		$arr = range('a', 'z');
		$arr = array_merge($arr, range(0, 9));
		$arr = array_merge($arr, range('A', 'Z'));
		shuffle($arr);
		$arr = implode('', $arr);
		$str = substr($arr, 1, 64) . microtime(true);
		var_dump(md5($str));
		return(md5($str));
	
		//return ('asdfq2rajdfj');
		
	}
	
	function insert($key){
		return $this->api->db->dsql()->table($this->_tableName)
			// ->debug()
			->set('key', $key)->do_insert();
	}
	
	function updateCount($id){
		return $this->api->db->dsql()->table($this->_tableName)
			// ->debug()
			->set('visits = visits + 1')
			->where('id', $id)
			->do_update();
	}
	
	function getIdByKey($key){
		return
		$this->_read(Array(
			'mode' => 'do_getOne',
			// 'debug' => true,
			'field' => 'id',
			'condition' => Array (
				'`key`' => $key
			)
		));
	}
}