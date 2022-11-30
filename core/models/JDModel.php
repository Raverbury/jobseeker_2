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

  public static function byOwnerId(string $id)
  {
    $response = new ModelResponse();
    try {
      $result = JDModel::getInstance()->run("SELECT * FROM jobposts WHERE owner_id = " . $id . "");
        $response->message = "OK";
        $result = $result;
        $response->query_result = $result;
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
    }
    return $response;
  }
}
