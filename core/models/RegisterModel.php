<?php

class RegisterModel extends Model
{
  private $username;
  private $password;
  private $retypePassword;
  private $role;

  public function loadParams($username, $password, $retypePassword, $role)
  {
    $this->username = $username;
    $this->password = $password;
    $this->retypePassword = $retypePassword;
    $this->role = $role;
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
    if ($this->retypePassword == '') {
      $this->result['message'] = 'The retyped password cannot be empty.';
      return false;
    }
    if ($this->password != $this->retypePassword) {
      $this->result['message'] = 'The passwords do not match.';
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
    // checking if username already exists
    $query = 'SELECT username FROM users WHERE username = ?';
    if ($statement = $this->dbInstance->prepare($query)) {
      $statement->bind_param('s', $this->username);
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
      $statement->store_result();
      if ($statement->num_rows == 1) {
        $this->result['message'] = 'This username is already taken.';
        return;
      }
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    // adding new user
    $query = 'INSERT INTO users (username, password, role) VALUES (?, ?, ?);';
    if ($statement = $this->dbInstance->prepare($query)) {
      $this->password = password_hash($this->password, PASSWORD_DEFAULT);
      $statement->bind_param('sss', $this->username, $this->password, $this->role);
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    // querying info to get id
    $query = 'SELECT id FROM users WHERE username = ?';
    if ($statement = $this->dbInstance->prepare($query)) {
      $statement->bind_param('s', $this->username);
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
      $statement->store_result();
      $statement->bind_result($id);
      if ($statement->fetch()) {
        $this->result['message'] = 'OK';
        $this->result['id'] = $id;
        $this->result['username'] = $this->username;
        $this->result['role'] = $this->role;
      } else {
        $this->result['message'] = 'Something went wrong. Please try again later.';
        return;
      }
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
  }
}
