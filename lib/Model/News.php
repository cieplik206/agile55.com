<?php
class Model_News extends AWModel{
	var $_tableName         = 'news';
	var $_databaseDriverKey = 'MyDsql';

	function init(){
		parent::init();
	}

	function getById($id){
		return
		$this->_read(Array(
			'mode' => 'do_getHash',
			// 'debug' => true,
			'field' => '*, DATE_FORMAT(`date`, \'%b %D, %Y\') AS date',
			'condition' => Array (
				$this->__primaryKey => $id
			)
		));
	}
	
	function getAllActive($limit=false){
		$db = $this->api->db->dsql()->table($this->_tableName)
			->field('*, DATE_FORMAT(`date`, \'%M %D, %Y\') AS formated_date, LEFT(date, 4) AS year')
			// ->field('*, DATE_FORMAT(`date`, \'%M %D\') AS formated_date')
			->order('`date` DESC, id DESC')
			->where('`date` <= DATE(NOW())')
			->where('public', 'Y');
		if ($limit){
			$db->limit($limit);
		}
		return $db->do_getAllHash();
	}
	
	function getAllActiveForYear($year){
		$year = (int)($year);
		$db = $this->api->db->dsql()->table($this->_tableName)
			// ->debug()
			// ->field('*, DATE_FORMAT(`date`, \'%M %D, %Y\') AS formated_date')
			->field('*, DATE_FORMAT(`date`, \'%M %D\') AS formated_date, LEFT(date, 4) AS year')
			->order('`date` DESC, id DESC')
			->where('LEFT(date, 4) = ' . $year)
			->where('`date` <= DATE(NOW())')
			->where('public', 'Y');
		if ($limit){
			$db->limit($limit);
		}
		return $db->do_getAllHash();
	}
    
    function getLastYear(){
		$db = $this->api->db->dsql()->table($this->_tableName)
            // ->debug()
			->field('DATE_FORMAT(`date`, \'%Y\') AS year')
			->order('date DESC')
			->where('`date` <= DATE(NOW())')
			->where('public', 'Y');
        $result = $db->do_getOne();
        
		return $result;
	}
    
    function getAllYears(){
		$db = $this->api->db->dsql()->table($this->_tableName)
            // ->debug()
			->field('DATE_FORMAT(`date`, \'%Y\') AS year')
			->group('DATE_FORMAT(`date`, \'%Y\')')
			->order('date DESC')
			->where('`date` <= DATE(NOW())')
			->where('public', 'Y');
        $result = $db->do_getAllHash();
        
		return $result;
	}
	
	function getByUrl($url){
		return
		$this->_read(Array(
			'mode' => 'do_getHash',
			// 'debug' => true,
			'field' => '*, DATE_FORMAT(`date`, \'%M %D, %Y\') AS formated_date, LEFT(date, 4) AS year',
			'condition' => Array (
				'url' => $url
			)
		));
	}
    
    function getNavigation($id, $date, $mode){
        $id = (int)$id;
		$date = mysql_real_escape_string($date);
		$db = $this->api->db->dsql()->table($this->_tableName)
			->field('*, DATE_FORMAT(`date`, \'%M %D\') AS formated_date, LEFT(date, 4) AS year')
			//->debug()
		;
		if ('prev' == $mode){
			// $db->where('date <= "' . $date . '"');
			$db->where('`date` <= "' . $date. '"');
			//db->where('`date` <= "' . $date . '" AND id < ' . $id);
			$db->order('date DESC, id DESC');
			$db->limit('1', '1');
		} 
		else {
			// $db->where('date >= "' . $date . '"');
			$db->where('date >= "' . $date . '"');
			//$db->where('date >= "' . $date . '" AND id > ' . $id);
			$db->order('date ASC, id DESC');
			$db->limit('1', '1');
		}
		return $db->do_getHash();
	}

	
}
