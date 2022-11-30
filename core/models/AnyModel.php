<?php
class AnyModel extends PostgresModel
{
  private function __construct()
  {
    parent::__construct();
  }
  public function custom_query($sql)
  {
    $response = new ModelResponse();
    $response->query_result = $this->run($sql);
    return $response;
  }
}
