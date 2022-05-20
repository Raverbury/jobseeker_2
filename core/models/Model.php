<?php
// abstract model to extend from, common functionalities include
// executing queries
// returning results
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'jobseeker');

abstract class Model {
	protected $dbInstance;
	protected $result = array('message' => '');

	function __construct() {
		$this->dbInstance = $this->getDBInstance();
		$this->autoGenTable();
	}

  private function getDBInstance() {
    $sql = '
    CREATE DATABASE IF NOT EXISTS '.DB_NAME.'
    ;';
    $instance = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    $instance->query($sql);
    return new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

	private function autoGenTable() {
		$sql = '
		CREATE TABLE IF NOT EXISTS users (
			id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			username VARCHAR(50) NOT NULL UNIQUE,
			password VARCHAR(255) NOT NULL,
			role ENUM("admin", "employer", "candidate") NOT NULL
		);';
		$this->dbInstance->query($sql);
	}

	function __destruct() {
		$this->dbInstance->close();
	}

	abstract function executeQuery();

	public function getResult() {
		return $this->result;
	}
}
