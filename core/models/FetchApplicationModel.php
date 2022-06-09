<?php

class FetchApplicationModel extends Model
{
  private $jdId;
  private $userId;
  public function loadParams($jdId, $uid)
  {
    $this->userId = $uid;
    $this->jdId = $jdId;
  }
  public function executeQuery()
  {
    $cvIds = [];
    $query = "SELECT cvID FROM applications WHERE applications.postID = ".$this->jdId." AND applications.userID = ".$this->userId.";";
    if ($statement = $this->dbInstance->prepare($query)) {
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
      $statement->store_result();
      $statement->bind_result($cvId);
      if ($statement->fetch()) {
        $this->result['data']['applied'] = $cvId;
      }
      else {
        $this->result['data']['applied'] = null;
      }
      $this->result['message'] = 'OK';
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
  }
}
