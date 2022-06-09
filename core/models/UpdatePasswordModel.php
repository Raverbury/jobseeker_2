<?php

class UpdatePasswordModel extends Model
{
  private $oldPassword;
  private $newPassword;
  private $repeatPassword;
  private $userId;

  public function loadParams($oldPw, $newPw, $repeatPw, $uid)
  {
    $this->oldPassword = $oldPw;
    $this->newPassword = $newPw;
    $this->repeatPassword = $repeatPw;
    $this->userId = $uid;
  }
  private function validate() {
    if ($this->oldPassword == '') {
      $this->result['message'] = 'The old username cannot be empty.';
      return false;
    }
    if ($this->newPassword == '') {
      $this->result['message'] = 'The new username cannot be empty.';
      return false;
    }
    if ($this->repeatPassword == '') {
      $this->result['message'] = 'The repeat username cannot be empty.';
      return false;
    }
    if ($this->repeatPassword != $this->newPassword) {
      $this->result['message'] = 'The new passwords do not match.';
      return false;
    }
  }
  public function executeQuery()
  {
    $this->validate();
    $query = 'SELECT id, username, password, role FROM users WHERE id = ' . $this->userId;
    if ($statement = $this->dbInstance->prepare($query)) {
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
          } else {
            $this->result['message'] = 'The password provided is incorrect.';
          }
        } else {
          $this->result['message'] = 'Something went wrong. Please try again later.';
          return;
        }
      } else {
        $this->result['message'] = 'Could not find a user with the provided ID.';
      }
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }

    $hashedPw = password_hash($this->newPassword, PASSWORD_DEFAULT);
    $query = 'UPDATE users SET password = "' . $hashedPw . '" WHERE users.id = ' . $this->userId;
    if ($statement = $this->dbInstance->prepare($query)) {
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
      $statement->store_result();
      $this->result['message'] = 'OK';
      return;
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
  }
}
