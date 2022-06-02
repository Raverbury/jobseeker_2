<?php

class UpdateUsernameModel extends Model
{
  private $newUsername;
  private $userId;

  public function loadParams($newUsn, $uid)
  {
    $this->newUsername = $newUsn;
    $this->userId = $uid;
  }
  private function validate() {
    if ($this->newUsername == '') {
      $this->result['message'] = 'The new username cannot be empty.';
      return false;
    }
  }
  public function executeQuery()
  {
    $this->validate();
    // retrieving user info
    $query = 'SELECT username FROM users WHERE username = ?';
    if ($statement = $this->dbInstance->prepare($query)) {
      $statement->bind_param('s', $this->newUsername);
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
    $query = 'UPDATE users SET username = "' . $this->newUsername . '" WHERE users.id = ' . $this->userId;
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
