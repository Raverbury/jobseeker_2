<?php

class FetchJDByUserModel extends Model
{
  private $userId;
  public function loadParams($uid)
  {
    $this->userId = $uid;
  }
  public function executeQuery()
  {
    $IDs = [];
    $titles = [];
    $query = "SELECT title, postId FROM jobposts WHERE jobposts.userId = ".$this->userId."";
    if ($statement = $this->dbInstance->prepare($query)) {
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
      $statement->store_result();
      $statement->bind_result($title, $id);
      while ($statement->fetch()) {
        array_push($titles, $title);
        array_push($IDs, $id);
      }
      $this->result['data']['jdTitles'] = $titles;
      $this->result['data']['jdIDs'] = $IDs;
      $this->result['message'] = 'OK';
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
  }
}
