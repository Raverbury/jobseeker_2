<?php
// abstract model to extend from, common functionalities include
// executing queries
// returning results
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'jobseeker');

abstract class Model
{
  protected $dbInstance;
  protected $result = array('message' => '');

  function __construct()
  {
    $this->dbInstance = $this->getDBInstance();
    $this->autoGenTables();
  }

  private function getDBInstance()
  {
    $sql = '
    CREATE DATABASE IF NOT EXISTS ' . DB_NAME . '
    ;';
    $instance = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    $instance->query($sql);
    return new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

  private function autoGenTables()
  {
    $sql = '
		CREATE TABLE IF NOT EXISTS users (
			id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			username VARCHAR(50) NOT NULL UNIQUE,
			password VARCHAR(255) NOT NULL,
			role ENUM("admin", "employer", "candidate") NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;';
    $this->dbInstance->query($sql);
    $sql = '
		CREATE TABLE IF NOT EXISTS `jobposts` (
      `postId` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
      `userId` int(11) NOT NULL,
      `companyname` text CHARACTER SET ascii NOT NULL,
      `title` text CHARACTER SET ascii NOT NULL,
      `expyear` tinyint(4) NOT NULL,
      `salary` int(11) NOT NULL,
      `jobdes` text CHARACTER SET ascii NOT NULL,
      FOREIGN KEY (userId) REFERENCES users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;';
    $this->dbInstance->query($sql);
    $sql = '
		CREATE TABLE IF NOT EXISTS `templates` (
      `cvID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
      `UserID` int(11) NOT NULL,
      `Name` varchar(100) NOT NULL,
      `Phone` varchar(15) NOT NULL,
      `Mail` varchar(100) NOT NULL,
      `Web` varchar(100) NOT NULL,
      `Place` varchar(100) NOT NULL,
      `About` varchar(100) NOT NULL,
      `company1` varchar(100) NOT NULL,
      `period1` varchar(16) NOT NULL,
      `role1` varchar(100) NOT NULL,
      `companydes1` varchar(100) NOT NULL,
      `company2` varchar(100) NOT NULL,
      `period2` varchar(16) NOT NULL,
      `role2` varchar(100) NOT NULL,
      `companydes2` varchar(100) NOT NULL,
      `company3` varchar(100) NOT NULL,
      `period3` varchar(16) NOT NULL,
      `role3` varchar(100) NOT NULL,
      `companydes3` varchar(100) NOT NULL,
      `skill1` varchar(16) NOT NULL,
      `skill2` varchar(16) NOT NULL,
      `skill3` varchar(16) NOT NULL,
      `skill4` varchar(16) NOT NULL,
      `skill5` varchar(16) NOT NULL,
      `skill6` varchar(16) NOT NULL,
      `slide1` varchar(100) NOT NULL,
      `slide2` varchar(100) NOT NULL,
      `slide3` varchar(100) NOT NULL,
      `slide4` varchar(100) NOT NULL,
      `slide5` varchar(100) NOT NULL,
      `slide6` varchar(100) NOT NULL,
      `hobbies` varchar(100) NOT NULL,
      FOREIGN KEY (UserID) REFERENCES users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;';
    $this->dbInstance->query($sql);
  }

  function __destruct()
  {
    $this->dbInstance->close();
  }

  abstract function executeQuery();

  public function getResult()
  {
    return $this->result;
  }
}
