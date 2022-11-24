<?php
class AnyModel extends PostgresModel
{
  public function custom_query($sql)
  {
    $response = new ModelResponse();
    $response->query_result = $this->run($sql);
    return $response;
  }
}
