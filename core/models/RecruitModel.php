<?php

class RecruitModel extends Model
{
  private $companyname;
  private $title;
  private $expyear;
  private $salary;
  private $jobdes;
  private $userId;
  public function loadParams($userId, $companyname, $title, $expyear, $salary, $jobdes)
  {
    $this->userId = $userId;
    $this->companyname = $companyname;
    $this->title = $title;
    $this->expyear = $expyear;
    $this->salary = $salary;
    $this->jobdes = htmlspecialchars($jobdes);
  }
  private function validate()
  {
    if ($this->companyname == '') {
      $this->result['message'] = 'Company name cannot be empty.';
      return false;
    }
    if ($this->title == '') {
      $this->result['message'] = 'The title cannot be empty.';
      return false;
    }
    if ($this->salary == '') {
      $this->salary = "Not disclosed";
      return false;
    }
    if ($this->jobdes == '') {
      $this->result['message'] = 'Job description cannot be empty.';
      return false;
    }
    return true;
  }
  public function executeQuery()
  {
    $query = '
        INSERT INTO jobposts 
        (userId, companyname, title, expyear, salary, jobdes) 
        VALUES 
        ("' . $this->userId . '","' . $this->companyname . '","' . $this->title . '","' . $this->expyear . '","' . $this->salary .  '","' . $this->jobdes . '");';
    if ($statement = $this->dbInstance->prepare($query)) {
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
      $this->result['message'] = 'OK';
      return;
    }
    else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
  }
  public function getAllQuery()
  {
    $postIds = [];
    $companynames = [];
    $titles = [];
    $expyears = [];
    $salarys = [];
    $userIds = [];
    $owners = [];
    $query = '
        SELECT jobposts.*, users.username
        FROM jobposts LEFT JOIN users ON jobposts.userId = users.id
        ';
    if ($statement = $this->dbInstance->prepare($query)) {
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
      $statement->store_result();
      $statement->bind_result($postId, $userId, $companyname, $title, $expyear, $salary, $jobdes, $owner);
      while ($statement->fetch()) {
        array_push($companynames, $companyname);
        array_push($titles, $title);
        array_push($expyears, $expyear);
        array_push($salarys, $salary);
        array_push($userIds, $userIds);
        array_push($postIds, $postId);
        array_push($owners, $owner);
      }
      $this->result['data'] = [$postIds, $userIds, $companynames, $titles, $expyears, $salarys, $owners];
      $this->result['message'] = 'OK';
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
  }
  public function getAllQueryFromUser($usrId)
  {
    $postIds = [];
    $companynames = [];
    $titles = [];
    $expyears = [];
    $salarys = [];
    $userIds = [];
    $query = '
        SELECT *
        FROM jobposts
        WHERE userId = "' . $usrId . '"
        ';
    if ($statement = $this->dbInstance->prepare($query)) {
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
      $statement->store_result();
      $statement->bind_result($postId, $userId, $companyname, $title, $expyear, $salary, $jobdes);
      while ($statement->fetch()) {
        array_push($companynames, $companyname);
        array_push($titles, $title);
        array_push($expyears, $expyear);
        array_push($salarys, $salary);
        array_push($userIds, $userIds);
        array_push($postIds, $postId);
      }
      $this->result['data'] = [$postIds, $userIds, $companynames, $titles, $expyears, $salarys];
      $this->result['message'] = 'OK';
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
  }
  public function getJDWithId($postId)
  {
    $companyname = null;
    $title = null;
    $expyear = null;
    $salary = null;
    $jobdes = null;
    $userId = null;
    $query = '
        SELECT *
        FROM jobposts
        WHERE postId = ' . $postId . '
        ';
    if ($statement = $this->dbInstance->prepare($query)) {
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
      $statement->store_result();
      $statement->bind_result($postId, $userId, $companyname, $title, $expyear, $salary, $jobdes);
      if ($statement->num_rows < 1) {
        $this->result['message'] = 'Cannot find a CV with such ID.';
        return;
      }
      while ($statement->fetch()) {
        $this->result['data'] = array(
          'postId' => $postId,
          'userId' => $userId,
          'companyname' => $companyname,
          'title' => $title,
          'expyear' => $expyear,
          'salary' => $salary,
          'jobdes' => $jobdes,
          'userId' => $userId
        );
        $this->result['message'] = 'OK';
      }
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
  }
}
