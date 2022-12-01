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

    TransactionModel::begin();

    try {

      $result = UserModel::getInstance()->run("SELECT * FROM users WHERE username = '{$username}'");
      if (count($result) == 1) {
        throw new ExplicitException("That username is already taken.");
      }

      $password = password_hash($password, PASSWORD_DEFAULT);
      UserModel::getInstance()->run("INSERT INTO users (username, password, role) VALUES ('{$username}', '{$password}', '{$role}')");

      $result = UserModel::getInstance()->run("SELECT * FROM users WHERE username = '{$username}'");
      if (!$result || count($result) != 1) {
        throw new ExplicitException("Cannot find the newly inserted user.");
      }

      $response->query_result = $result[0];
    } catch (ExplicitException $e) {
      $response->message = $e->getMessage();
      TransactionModel::rollback();
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
      TransactionModel::rollback();
    }
    TransactionModel::commit();
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

    TransactionModel::begin();

    try {

      $result = UserModel::getInstance()->run("SELECT * FROM users WHERE username = '{$username}'");
      if (!$result || count($result) != 1) {
        throw new ExplicitException('Cannot find a user with such username.');
      }

      if (!password_verify($password, $result[0]['password'])) {
        throw new ExplicitException('The provided password is incorrect.');
      }

      $response->query_result = $result[0];
    } catch (ExplicitException $e) {
      $response->message = $e->getMessage();
      TransactionModel::rollback();
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
      TransactionModel::rollback();
    }
    TransactionModel::commit();
    return $response;
  }

  public static function all(int $currentPage, string $searchUsername, string $filterRole)
  {
    define('ROWS_PER_PAGE', 10);
    $response = new ModelResponse();
    TransactionModel::begin();
    try {
      $searchUsername = ($searchUsername == '') ? '%' : $searchUsername;
      $filterRole = ($filterRole == '') ? '%' : $filterRole;
      $result = UserModel::getInstance()->run("SELECT id, username, role FROM users WHERE username LIKE '%{$searchUsername}%' AND role::text LIKE '%{$filterRole}%'");
      $numOfPages = ceil(count($result) / ROWS_PER_PAGE);

      // auto correct current page
      if ($numOfPages < 1) {
        $numOfPages = 1;
      }
      if ($currentPage < 1) {
        $currentPage = 1;
      } elseif ($currentPage > $numOfPages) {
        $currentPage = $numOfPages;
      }

      $result = array_slice($result, ($currentPage - 1) * ROWS_PER_PAGE, ROWS_PER_PAGE);
      $response->message = 'OK';
      $response->query_result = $result;
      $response->extra['numOfPages'] = $numOfPages;
      $response->extra['currentPage'] = $currentPage;
    } catch (ExplicitException $e) {
      $response->message = $e->getMessage();
      TransactionModel::rollback();
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
      TransactionModel::rollback();
    }
    TransactionModel::commit();
    return $response;
  }

  public static function updatePassword(string $id, string $old_password, string $new_password, string $repeat_password)
  {
    $response = new ModelResponse();
    if ($old_password == '') {
      $response->message = 'The old password cannot be empty.';
      return $response;
    }
    if ($new_password == '') {
      $response->message = 'The new password cannot be empty.';
      return $response;
    }
    if ($new_password == '') {
      $response->message = 'The repeat password cannot be empty.';
      return $response;
    }
    if ($repeat_password != $new_password) {
      $response->message = 'The new passwords do not match.';
      return $response;
    }

    TransactionModel::begin();
    try {
      $query = "SELECT * FROM users WHERE id = {$id}";
      $result = UserModel::getInstance()->run($query);
      $result = $result[0];
      if (!password_verify($old_password, $result['password'])) {
        throw new ExplicitException("Old password is incorrect.");
      }

      $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

      $query = "UPDATE users SET password = '{$hashed_password}' WHERE id = {$id}";
      UserModel::getInstance()->run($query);

      $response->message = "OK";
    } catch (ExplicitException $e) {
      $response->message = $e->getMessage();
      TransactionModel::rollback();
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
      TransactionModel::rollback();
    }
    TransactionModel::commit();
    return $response;
  }

  public static function updateUsername(string $id, string $username)
  {
    $response = new ModelResponse();
    TransactionModel::begin();
    try {
      if ($username == "") {
        $response->message = "The new username cannot be empty.";
        return $response;
      }

      $query = "SELECT * FROM users WHERE username = '{$username}'";
      $result = UserModel::getInstance()->run($query);
      if (count($result) >= 1) {
        throw new ExplicitException("This username is already in taken.");
      }

      $query = "UPDATE users SET username = '{$username}' WHERE id = '{$id}'";
      UserModel::getInstance()->run($query);

      $response->message = "OK";
    } catch (ExplicitException $e) {
      $response->message = $e->getMessage();
      TransactionModel::rollback();
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
      TransactionModel::rollback();
    }
    TransactionModel::commit();
    return $response;
  }
}
