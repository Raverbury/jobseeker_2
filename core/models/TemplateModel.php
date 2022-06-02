<?php

class TemplateModel extends Model
{

  private function autoCorrect()
  {
    if ($this->numOfPages < 1) {
      $this->numOfPages = 1;
    }
    if ($this->currentPage < 1) {
      $this->currentPage = 1;
    } elseif ($this->currentPage > $this->numOfPages) {
      $this->currentPage = $this->numOfPages;
    }
  }

  public function executeQuery()
  {
    $template = [];
    // get all users
    $query = "SELECT template role FROM templates";
    if ($statement = $this->dbInstance->prepare($query)) {
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    if ($statement->execute()) {
      $statement->store_result();
    }
  }
}
