<?php

class LoginModel extends Model
{
  private $username;
  private $password;
  public function loadParams($username, $password)
  {
    $this->username = $username;
    $this->password = $password;
  }
  private function validate()
  {
    if ($this->username == '') {
      $this->result['message'] = 'The username cannot be empty.';
      return false;
    }
    if ($this->password == '') {
      $this->result['message'] = 'The password cannot be empty.';
      return false;
    }
    return true;
  }
  public function executeQuery()
  {
    if ($this->validate() == false) {
      return;
    }
    $id = NULL;
    $role = NULL;
    $retrievedPassword = NULL;
    // retrieving user info
    $query = 'SELECT id, username, password, role FROM users WHERE username = ?';
    if ($statement = $this->dbInstance->prepare($query)) {
      $statement->bind_param('s', $this->username);
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
      $statement->store_result();
      if ($statement->num_rows == 1) {
        $statement->bind_result($id, $username, $retrievedPassword, $role);
        if ($statement->fetch()) {
          if (password_verify($this->password, $retrievedPassword)) {
            $this->result['message'] = 'OK';
            $this->result['id'] = $id;
            $this->result['username'] = $username;
            $this->result['role'] = $role;
          } else {
            $this->result['message'] = 'The password provided is incorrect.';
          }
        } else {
          $this->result['message'] = 'Something went wrong. Please try again later.';
          return;
        }
      } else {
        $this->result['message'] = 'Could not find a user with the provided username.';
      }
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
  }
}
