<?php
class databaseActions extends AbstractModel {
	protected $_databaseObject;
	private   $_tableName;
	
	function init() {
		parent::init();
		$this->__setDatabaseObject();
		// $this->__readTableShema();
		// var_dump($this->_tableName);
	}
	
	// abstract function __setDatabaseObject();
	protected function __getDatabaseObject(){
		return $this->_databaseObject;
	}
	
	// abstract function __readTableShema();
	// abstract function __read();
	// abstract function __write();
	
	private function __setTableName($string){
		$this->_tableName = $string;
	}
	
	protected function __getTableName(){
		if (!$this->_tableName){
			throw new AWModelException('_tableName property must be set ');
		}
		else {
			return $this->_tableName;
		}
	}
	
}

class MyPDO extends databaseActions {
	protected function __setDatabaseObject(){
		$pdo =  $this->api->getConfig('pdo');
		if (!$pdo['dsn'] || !$pdo['user'] || !isset($pdo['password'])) {
			throw new AWModelException('$config[\'pdo\'] must be set ');
		}
		else {
			$this->_databaseObject = new PDO($pdo['dsn'], $pdo['user'], $pdo['password']);
			return $this->_databaseObject;
		}
	}
	function __readTableShema(){
		$dbh = $this->__getDatabaseObject();
		$sth = $dbh->prepare("DESCRIBE admin");
		$sth->execute();

		/* Fetch all of the remaining rows in the result set */
		print("Fetch all of the remaining rows in the result set:\n");
		$result = $sth->fetchAll(PDO::FETCH_COLUMN);
		print_r($result);
	}
	
	function __read(){}
	function __write(){}
}

class MyDsql extends databaseActions {

	function __setDatabaseObject(){
		$this->_databaseObject = $this->api->db->dsql();
		return $this->_databaseObject;
	}
	private function __readTableShema($table_name){
		// $table = $this->__getDatabaseObject()->query('DESCRIBE `' . $table_name .  '`');
		// echo $table;
		// $f = $this->__getDatabaseObject()->query('DESCRIBE `' . $table_name .  '`')->do_getAllHash();
		// var_dump($f);
		// $f = $this->__getDatabaseObject()->query('DESCRIBE `admin`');
		// $f = $this->api->db->dsql()->query('DESCRIBE `admin`');
		// $f->do_getHash();
		// print_r($f);
	}
	function _read($table_name, $options){
		$this->__readTableShema($table_name);
		$table = $this->__getDatabaseObject()->table($table_name);
		if ($options['debug']){
			$table->debug();
		}
		if (!$options['mode']) {
			$mode = 'do_getAllHash';
		}
		else {
			$mode = $options['mode'];
		}
		if ($options['field']) {
			if (is_array($options['field'])) {
				foreach ($options['field'] as $f) {
					$table->field($f);
				}
			}
			else {
				$table->field($options['field']);
			}
		}
		
		if ($options['condition']) {
			if (is_array($options['condition'])) {
				foreach ($options['condition'] AS $_k => $_v) {
					if (isset($_v)){
						$table->where($_k, $_v);
					} 
					else {
						$table->where($_k);
					}
				}
			}
			else {
				$table->where($options['condition']);
			}
		}
		
		if ($options['order']) {
			if (is_array($options['order'])) {
				foreach ($options['order'] AS $_k => $_v) {
					if (isset($_v)){
						$table->order($_k, $_v);
					} 
					else {
						$table->order($_k);
					}
				}
			}
			else {
				$table->order($options['order']);
			}
		}
		
		return $table->$mode();
	}
	
	function __write(){
	
	}
}


class AWModel extends AbstractController{
	protected $_useDsn = false;
	protected $_tableName  = false;
	
	private $__databaseObject = false;
	protected $__primaryKey = 'id';
	
	private   $__arrDatabaseDrivers = Array('MyDsql', 'MyPdo');
	protected $_databaseDriverKey  = false;
	
	function init(){
		parent::init();
		if (!$this->__checkDatabaseDriverExists($this->_databaseDriverKey)){
			throw new AWModelException('Unknown driver Type');
		}
		else {
			$this->__setDatabaseObject($this->_databaseDriverKey);
		}
	}
	
	private function __checkDatabaseDriverExists($string){
		return in_array(strtolower($string), array_map('strtolower', $this->__arrDatabaseDrivers));
	}
	
	private function __setDatabaseObject($driver){
		$this->__databaseObject = $this->add($driver);
	}
	
	private function __getDatabaseObject(){
		return $this->__databaseObject;
	}
	
	protected function _read($options = Array()){
		if (!$this->_tableName){
			throw new AWModelException('User _tableName must be set ');
		}
		else {
			$db = $this->__getDatabaseObject();
			return $db->_read($this->_tableName, $options);
			//echo $db;
			/*
			$table = $this->_getDatabaseObj()->table($this->__getTableName())->debug();
			echo $table;
			foreach ($condition AS $_k => $v) {
				if (isset($v)){
					$table->where($_k, $v);
				} 
				else {
					$table->where($_k);
				}
			}
			return $table->$mode();
			*/
		}
	}
	
	
/*
	private function __setPdoObject(){
		$pdo =  $this->api->getConfig('pdo');
		if (!$pdo['dsn'] || !$pdo['user'] || !$pdo['password']) {
			throw new AWModelException('$config[\'pdo\'] must be set ');
		}
		else {
			$this->pdo = new PDO('mysql:host=localhost;dbname=test', $pdo['user'], $pdo['password']);
			return $this->pdo;
		}
	}
	
	private function __getPdoObject(){
		return $this->pdo;
	}
	
	
	private function _setDatabaseObj(){
		return $this->db = $this->api->db->dsql();
	}
	
	private function _getDatabaseObj(){
		return $this->_setDatabaseObj();
	}
	
	private function __setTableName($string){
		$this->_tableName = $string;
	}
	
	private function __getTableName(){
		return $this->_tableName;
	}
	
	private function __read($condition){
	}
	
	
	protected function _read($mode = 'do_getAllHash', $condition=false){
		if (!$this->_tableName){
			throw new AWModelException('User _tableName must be set ');
		}
		else {
			$table = $this->_getDatabaseObj()->table($this->__getTableName());
			foreach ($condition AS $_k => $v) {
				if (isset($v)){
					$table->where($_k, $v);
				} 
				else {
					$table->where($_k);
				}
			}
			return $table->$mode();
		}
	}
	
	private function __insert(){
	
	}
	
	private function __update(){
	
	}
	
	protected function _write($data, $condition=false){
		if ($condition) {
			$this->_read('do_getAllHash', Array(
				$this->__getTableName() => $data[$this->__getTableName()]
			));
		}
		
		
	}
*/
}

class AWModelException extends Exception {}