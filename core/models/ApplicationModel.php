<?php
class ApplicationModel extends PostgresModel
{
  private static $instance = null;
  private static function getInstance()
  {
    if (ApplicationModel::$instance == null) {
      ApplicationModel::$instance = new ApplicationModel();
    }
    return ApplicationModel::$instance;
  }
  private function __construct()
  {
    parent::__construct();
  }
  public static function apply(string $user_id, string $cv_id, string $jd_id)
  {
    $response = new ModelResponse();
    try {
      $query = "INSERT INTO applications (user_id, cv_id, post_id) VALUES ({$user_id}, {$cv_id}, {$jd_id}) ON CONFLICT (user_id, post_id) DO UPDATE SET cv_id = {$cv_id}";
      if ($cv_id == "delete") {
        $query = "DELETE FROM applications WHERE applications.post_id = {$jd_id} AND applications.user_id = {$user_id}";
      }

      ApplicationModel::getInstance()->run($query);

      $response->message = "OK";
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
    }
    return $response;
  }
  public static function cvIdWhere(string $jd_id, string $user_id)
  {
    $response = new ModelResponse();
    try {
      $query = "SELECT cv_id FROM applications WHERE applications.post_id = {$jd_id} AND applications.user_id = {$user_id}";

      $result = ApplicationModel::getInstance()->run($query);

      if (count($result) > 0) {
        $result = [$result[0]['cv_id']];
      }
      else
      {
        $result = [-1];
      }

      $response->message = "OK";
      $response->query_result = $result;
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
    }
    return $response;
  }
}
