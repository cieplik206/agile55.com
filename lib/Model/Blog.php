<?php
class Model_Blog extends AWModel{
	var $_tableName         = 'blog';
	var $_databaseDriverKey = 'MyDsql';

	function init(){
		parent::init();
	}
	
	function getAll(){
		return
		$this->_read(Array(
			'mode' => 'do_getAllHash',
			// 'debug' => true,
			'field' => '*, DATE_FORMAT(`date`, \'%b %D, %Y\') AS formated_date, 
				(SELECT COUNT(1) FROM blog_comment WHERE blog_comment.blog_id = blog.id AND is_enable ="Y" ) as comment_count',
			'condition' => Array (
				'`date` <= DATE(NOW())' => null,
				'public' => 'Y',
			),
			'order' => 'date DESC'
		));
	}

	function getById($id){
		return
		$this->_read(Array(
			'mode' => 'do_getHash',
			// 'debug' => true,
			'field' => '*, DATE_FORMAT(`date`, \'%b %D, %Y\') AS formated_date',
			'condition' => Array (
				$this->__primaryKey => $id,
				'public' => 'Y',
			)
		));
	}
	
	function getByUrl($url){
		return
		$this->_read(Array(
			'mode' => 'do_getHash',
			// 'debug' => true,
			'field' => '*, DATE_FORMAT(`date`, \'%M %D, %Y\') AS formated_date,
                (SELECT COUNT(1) FROM blog_comment WHERE blog_comment.blog_id = blog.id AND is_enable ="Y") as comment_count
            ',
			'condition' => Array (
				'url' => $url,
				'public' => 'Y',
			)
		));
	}
	
	function getLastRow(){
		return
		$this->_read(Array(
			'mode'  => 'do_getHash',
			// 'debug' => true,
			'field' => '*, DATE_FORMAT(`date`, \'%b %D, %Y\') AS formated_date, 
				(SELECT COUNT(1) FROM blog_comment WHERE blog_comment.blog_id = blog.id AND is_enable ="Y" ) as comment_count',
			'order' => 'date DESC',
			'limit' => 1,
			'condition' => Array(
				'public' => 'Y',
			)
		));
	}
	
	function getNavigation($date, $mode){
		$date = mysql_real_escape_string($date);
		$db = $this->api->db->dsql()->table($this->_tableName)
			->field('*, DATE_FORMAT(`date`, \'%M %D\') AS formated_date')
			// ->debug()
		;
		if ('prev' == $mode){
			$db->where('date < "' . $date . '"');
			$db->where('public', 'Y');
			$db->order('date DESC');
			$db->limit('1');
		} 
		else {
			$db->where('date > "' . $date . '"');
			$db->where('public', 'Y');
			$db->order('date ASC');
			$db->limit('1');
		}
		return $db->do_getHash();
	}
}
