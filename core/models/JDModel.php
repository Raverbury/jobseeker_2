<?php
class JDModel extends PostgresModel
{
  private static $instance = null;
  private static function getInstance()
  {
    if (JDModel::$instance == null) {
      JDModel::$instance = new JDModel();
    }
    return JDModel::$instance;
  }
  private function __construct()
  {
    parent::__construct();
  }
  public static function byOwnerId(string $id)
  {
    $response = new ModelResponse();
    TransactionModel::begin();
    try {
      $result = JDModel::getInstance()->run("SELECT * FROM jobposts WHERE owner_id = " . $id . "");
      $response->message = "OK";
      $result = $result;
      $response->query_result = $result;
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
      TransactionModel::rollback();
    }
    TransactionModel::commit();
    return $response;
  }

  public static function insert(array $form_data)
  {
    $response = new ModelResponse();
    TransactionModel::begin();
    try {
      foreach ($form_data as &$ele) {
        if ($ele == '') $ele = 'None';
        $ele = "'" . htmlspecialchars($ele, ENT_QUOTES) . "'";
      }
      $user_id = $_SESSION['id'];
      $title = $form_data['title'];
      $company_name = $form_data['company_name'];
      $exp_year = $form_data['exp_year'];
      $salary = $form_data['salary'];
      $job_description = $form_data['job_des'];
      $query = "
        INSERT INTO jobposts 
        (owner_id, company_name, title, exp_year, salary, job_description) 
        VALUES 
        ({$user_id}, {$company_name}, {$title}, {$exp_year}, {$salary}, {$job_description})";
      JDModel::getInstance()->run($query);
      $response->message = "OK";
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
      TransactionModel::rollback();
    }
    TransactionModel::commit();
    return $response;
  }

  public static function all(string $search_key = "")
  {
    $response = new ModelResponse();
    TransactionModel::begin();
    try {
      $search_key = ($search_key == '') ? '%' : $search_key;
      $result = JDModel::getInstance()->run("SELECT * FROM jobposts LEFT JOIN users ON jobposts.owner_id = users.id WHERE jobposts.title LIKE '%{$search_key}%'");
      $response->message = "OK";
      $response->query_result = $result;
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
      TransactionModel::rollback();
    }
    TransactionModel::commit();
    return $response;
  }

  public static function byId(string $id)
  {
    $response = new ModelResponse();
    TransactionModel::begin();
    try {
      $result = JDModel::getInstance()->run("SELECT * FROM jobposts WHERE id = " . $id . "");
      if (count($result) <= 0) {
        throw new ExplicitException("Cannot find a JD with such ID.");
      } else {
        $response->message = "OK";
        $result = $result[0];
        $response->query_result = $result;
      }
    } catch (ExplicitException $e) {
      $response->message = $e->getMessage();
      TransactionModel::rollback();
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
      TransactionModel::rollback();
    }
    TransactionModel::commit();
    return $response;
  }
}
