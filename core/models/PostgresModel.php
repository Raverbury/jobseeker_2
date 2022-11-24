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
    $temp_pdo = new PDO(PostgresModel::getDSN(false), DB_USERNAME, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    try {
      $temp_pdo->exec('CREATE DATABASE "' . DB_DATABASE . '";');
    } catch (Exception $e) {
      // print($e->getMessage());
      // do nothing, probably because of duplicate
      // imagine not supporting IF NOT EXISTS for CREATE DATABASE when it's perfectly valid with CREATE TABLE
    }
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
      exp_year int NOT NULL,
      salary int NOT NULL,
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
      name varchar(100) NOT NULL,
      phone varchar(15) NOT NULL,
      mail varchar(100) NOT NULL,
      web varchar(100) NOT NULL,
      place varchar(100) NOT NULL,
      about varchar(100) NOT NULL,
      company_1 varchar(100),
      period_1 varchar(16),
      role_1 text,
      company_description_1 text,
      company_2 varchar(100),
      period_2 varchar(16),
      role_2 text,
      company_description_2 text,
      company_3 varchar(100),
      period_3 varchar(16),
      role_3 text,
      company_description_3 text,
      skill_1 text,
      skill_2 text,
      skill_3 text,
      skill_4 text,
      skill_5 text,
      skill_6 text,
      mastery_1 varchar(100) NOT NULL,
      mastery_2 varchar(100) NOT NULL,
      mastery_3 varchar(100) NOT NULL,
      mastery_4 varchar(100) NOT NULL,
      mastery_5 varchar(100) NOT NULL,
      mastery_6 varchar(100) NOT NULL,
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
