<?php

class ApplyModel extends Model
{
  private $jdId;
  private $userId;
  private $cvId;
  public function loadParams($jdId, $uid, $cvId)
  {
    $this->userId = $uid;
    $this->jdId = $jdId;
    $this->cvId = $cvId;
  }
  public function executeQuery()
  {
    $query = "INSERT INTO applications (postID, userID, cvID) VALUES (".$this->jdId.", ".$this->userId.", ".$this->cvId.") ON DUPLICATE KEY UPDATE cvID = ".$this->cvId.";";
    if ($this->cvId == 'delete') {
      $query = "DELETE FROM applications WHERE applications.postID = ".$this->jdId." AND applications.userID = ".$this->userId.";";
    }
    if ($statement = $this->dbInstance->prepare($query)) {
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
      $this->result['message'] = 'OK';
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
  }
}
