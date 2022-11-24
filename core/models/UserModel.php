<?php
class UserModel extends PostgresModel
{
  public function register(string $username, string $password, string $retypePassword, string $role)
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

    $result = $this->run("SELECT * FROM users WHERE username = '{$username}'");
    if (count($result) == 1) {
      $response->message = 'That username is already taken.';
      return $response;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $this->run("INSERT INTO users (username, password, role) VALUES ('{$username}', '{$password}', '{$role}')");

    $result = $this->run("SELECT * FROM users WHERE username = '{$username}'");
    if (!$result || count($result) != 1) {
      $response->message = 'Something went wrong.';
      return $response;
    }

    $response->query_result = $result;
    return $response;
  }
}
