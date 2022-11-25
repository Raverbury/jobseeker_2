<?php
class UserModel extends PostgresModel
{
  private static $instance = null;
  private static function getInstance()
  {
    if (UserModel::$instance == null) {
      UserModel::$instance = new UserModel();
    }
    return UserModel::$instance;
  }
  private function __construct()
  {
    parent::__construct();
  }
  public static function register(string $username, string $password, string $retypePassword, string $role)
  {
    $response = new ModelResponse();
    if ($username == '') {
      $response->message = 'The username cannot be empty.';
      return $response;
    }
    if ($password == '') {
      $response->message = 'The password cannot be empty.';
      return $response;
    }
    if ($retypePassword == '') {
      $response->message = 'The retyped password cannot be empty.';
      return $response;
    }
    if ($password != $retypePassword) {
      $response->message = 'The passwords do not match.';
      return $response;
    }

    $result = UserModel::getInstance()->run("SELECT * FROM users WHERE username = '{$username}'");
    if (count($result) == 1) {
      $response->message = 'That username is already taken.';
      return $response;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    UserModel::getInstance()->run("INSERT INTO users (username, password, role) VALUES ('{$username}', '{$password}', '{$role}')");

    $result = UserModel::getInstance()->run("SELECT * FROM users WHERE username = '{$username}'");
    if (!$result || count($result) != 1) {
      $response->message = 'Something went wrong.';
      return $response;
    }

    $response->query_result = $result[0];
    return $response;
  }

  public static function login(string $username, string $password)
  {
    $response = new ModelResponse();
    if ($username == '') {
      $response->message = 'The username cannot be empty.';
      return $response;
    }
    if ($password == '') {
      $response->message = 'The password cannot be empty.';
      return $response;
    }

    $result = UserModel::getInstance()->run("SELECT * FROM users WHERE username = '{$username}'");
    if (!$result || count($result) != 1) {
      $response->message = 'Cannot find a user with such username.';
      return $response;
    }

    if (!password_verify($password, $result[0]['password'])) {
      $response->message = 'The provided password is incorrect.';
      return $response;
    }

    $response->query_result = $result[0];
    return $response;
  }
}
