<?php
class TransactionModel extends PostgresModel
{
  private static $instance = null;
  private static function getInstance()
  {
    if (TransactionModel::$instance == null) {
      TransactionModel::$instance = new TransactionModel();
    }
    return TransactionModel::$instance;
  }
  private function __construct()
  {
    parent::__construct();
  }
  public static function begin()
  {
    $sql = "START TRANSACTION";
    TransactionModel::getInstance()->run($sql);
  }
  public static function commit()
  {
    $sql = "COMMIT";
    TransactionModel::getInstance()->run($sql);
  }
  public static function rollback()
  {
    $sql = "ROLLBACK";
    TransactionModel::getInstance()->run($sql);
  }
}
