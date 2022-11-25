<?php
class CVModel extends PostgresModel
{
  private static $instance = null;
  private static function getInstance()
  {
    if (CVModel::$instance == null) {
      CVModel::$instance = new CVModel();
    }
    return CVModel::$instance;
  }
}
