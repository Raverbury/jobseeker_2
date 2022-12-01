<?php
class AnyModel extends PostgresModel
{
  private static $instance = null;
  private static function getInstance()
  {
    if (AnyModel::$instance == null) {
      AnyModel::$instance = new AnyModel();
    }
    return AnyModel::$instance;
  }
  private function __construct()
  {
    parent::__construct();
  }
  public static function custom_query($sql)
  {
    $response = new ModelResponse();
    $response->query_result = AnyModel::getInstance()->run($sql);
    return $response;
  }
}
