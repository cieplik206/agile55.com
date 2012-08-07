<?php
class Model_Comment extends AWModel{
	var $_tableName         = 'blog_comment';
	var $_databaseDriverKey = 'MyDsql';
	function init(){
		parent::init();
	}
	function getByBlogId($blog_id){
		return
		$this->_read(Array(
			'field' => '*',
			'condition' => Array (
				'blog_id'   => $blog_id,
				'is_enable' => 'Y'
			)
		));
	}
	function getById($id){
		$this->_read(Array($this->__primaryKey => $id));
	}
}