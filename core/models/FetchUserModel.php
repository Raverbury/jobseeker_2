<?php

class FetchUserModel extends Model {
  private $currentPage;
  private $entriesPerPage = 10;
  private $numOfPages;

  public function loadParams($currentPage) {
    $this->currentPage = $currentPage;
  }
  private function autoCorrect() {
    if ($this->currentPage < 1) {
			$this->currentPage = 1;
		}
    elseif ($this->currentPage > $this->numOfPages) {
      $this->currentPage = $this->numOfPages;
    }
  }
  public function executeQuery() {
    $ids = [];
    $usns = [];
    $roles = [];
		// get all users
		$query = 'SELECT id, username, role FROM users';
		if ($statement = $this->dbInstance->prepare($query)) {
		}
		else {
			$this->result['message'] = 'Something went wrong. Please try again later.';
			return;
		}
		if ($statement->execute()) {
			$statement->store_result();
      $this->numOfPages = ceil($statement->num_rows / $this->entriesPerPage);
      $this->autoCorrect();
			$statement->bind_result($id, $username, $role);
      $count = 1;
      $lower = 1 + ($this->currentPage - 1) * $this->entriesPerPage;
      $upper = $lower + $this->entriesPerPage - 1;
			while ($statement->fetch()) {
        if ($count > $upper) {
          break;
        }
        if ($count >= $lower && $count <= $upper) {
				  array_push($ids, $id);
          array_push($usns, $username);
          array_push($roles, $role);
          $this->result['data'] = [$ids, $usns, $roles];
          $this->result['message'] = 'OK';
          $this->result['numOfPages'] = $this->numOfPages;
          $this->result['currentPage'] = $this->currentPage;
        }
        $count++;
			}
		}
		else {
			$this->result['message'] = 'Something went wrong. Please try again later.';
			return;
		}
  }
}