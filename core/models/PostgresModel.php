<?php
define('DB_HOST', 'localhost');
define('DB_DATABASE', 'jobseeker');
define('DB_USERNAME', 'postgres');
define('DB_PASSWORD', 'judgePer198');
define('DB_PORT', '5432');

abstract class PostgresModel
{
  private $pdo;
  function __construct()
  {
    $this->pdo = new PDO(PostgresModel::getDSN(false), DB_USERNAME, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    // suppress error here because it's probably because of a duplicate
    // imagine not supporting create database if not exists when it works perfectly fine with create table smh
    $this->run('CREATE DATABASE "' . DB_DATABASE . '";', true);
    $this->pdo = new PDO(PostgresModel::getDSN(), DB_USERNAME, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $this->autoCreateTables();
  }

  private static function getDSN(bool $useDB = true)
  {
    if ($useDB)
      return "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_DATABASE . ";";
    return "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";";
  }

  protected function run(string $sql, bool $suppress_error = false)
  {
    try {
      if (preg_match("/select/i", $sql)) {
        return $this->select($sql);
      } else {
        return $this->execute($sql);
      }
    } catch (Exception $e) {
      if (!$suppress_error) {
        throw $e;
      }
    }
  }

  private function select(string $sql)
  {
    $results = [];
    $stmt = $this->pdo->query($sql);
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      array_push($results, $row);
    }
    return $results;
  }

  private function execute(string $sql)
  {
    return $this->pdo->exec($sql);
  }

  private function createUsersTable()
  {
    // role enum
    $sql = "
    CREATE TYPE role AS ENUM ('admin', 'employer', 'candidate');";
    $this->run($sql, true);
    $sql = '
    CREATE TABLE IF NOT EXISTS users (
      id SERIAL NOT NULL PRIMARY KEY,
      username VARCHAR(32) NOT NULL UNIQUE,
      password VARCHAR(128) NOT NULL,
      role role
    )';
    $this->run($sql);
  }

  private function createJobpostsTable()
  {
    $sql = '
    CREATE TABLE IF NOT EXISTS jobposts (
      id SERIAL NOT NULL PRIMARY KEY,
      owner_id integer REFERENCES users NOT NULL,
      company_name text NOT NULL,
      title text NOT NULL,
      exp_year text NOT NULL,
      salary text NOT NULL,
      job_description text NOT NULL
    )';
    $this->run($sql);
  }

  private function createTemplatesTable()
  {
    $sql = '
    CREATE TABLE IF NOT EXISTS templates (
      id SERIAL NOT NULL PRIMARY KEY,
      owner_id integer REFERENCES users NOT NULL,
      name text NOT NULL,
      phone text NOT NULL,
      mail text NOT NULL,
      web text NOT NULL,
      place text NOT NULL,
      about text NOT NULL,
      company1 text,
      period1 text,
      role1 text,
      companydes1 text,
      company2 text,
      period2 text,
      role2 text,
      companydes2 text,
      company3 text,
      period3 text,
      role3 text,
      companydes3 text,
      skill1 text,
      skill2 text,
      skill3 text,
      skill4 text,
      skill5 text,
      skill6 text,
      slide1 text NOT NULL,
      slide2 text NOT NULL,
      slide3 text NOT NULL,
      slide4 text NOT NULL,
      slide5 text NOT NULL,
      slide6 text NOT NULL,
      hobbies text
    )';
    $this->run($sql);
  }

  private function createApplicatiosTable()
  {
    $sql = '
    CREATE TABLE IF NOT EXISTS applications (
      id SERIAL NOT NULL PRIMARY KEY,
      post_id integer REFERENCES jobposts NOT NULL,
      user_id integer REFERENCES users NOT NULL,
      cv_id integer REFERENCES templates NOT NULL,
      UNIQUE (post_id, user_id)
    )';
    $this->run($sql);
  }

  private function autoCreateTables()
  {
    $this->createUsersTable();
    $this->createJobpostsTable();
    $this->createTemplatesTable();
    $this->createApplicatiosTable();
  }
}

class ModelResponse
{
  public string $message;
  public array $query_result;
  public array $extra;

  public function __construct()
  {
    $this->message = "OK";
    $this->query_result = [];
    $this->extra = [];
  }
}
