<?php

class FetchCVByUserModel extends Model
{
  private $userId;
  public function loadParams($uid)
  {
    $this->userId = $uid;
  }
  public function executeQuery()
  {
    $IDs = [];
    $names = [];
    // get all users
    $query = "SELECT Name, cvID FROM templates WHERE templates.UserID = ".$this->userId."";
    if ($statement = $this->dbInstance->prepare($query)) {
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
      $statement->store_result();
      $statement->bind_result($name, $id);
      while ($statement->fetch()) {
        array_push($names, $name);
        array_push($IDs, $id);
      }
      $this->result['data']['cvNames'] = $names;
      $this->result['data']['cvIDs'] = $IDs;
      $this->result['message'] = 'OK';
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
  }
}
