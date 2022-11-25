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
}
