<?php

class CVController extends Controller
{
  public function process($params)
  {
    if ($_SESSION['isLoggedIn'] == false) {
      $_SESSION['showMessage'] = true;
      $_SESSION['message'] = 'Must be logged in.';
      $_SESSION['messageType'] = 'danger';
      $this->redirect('home');
    }
    $action = array_shift($params);
    switch ($action) {
      case '':
        $this->redirect('cv/all');
        break;
      case 'all':
        $response = CVModel::all();
        $this->data['allCvs'] = $response->query_result;
        header("HTTP/1.0 200");
        $this->head['title'] = 'View all CVs';
        $this->head['description'] = 'View all CVs';
        $this->view = 'viewAllCVs';
        break;
      case 'view':
        if (count($params) == 0) {
          $this->redirect('cv/all');
        } else {
          $response = CVModel::byId($params[0]);
          $this->data['cvData'] = $response->query_result;
          if ($response->message == 'OK') {
            $this->view = 'viewCV';
            header("HTTP/1.0 200");
            $this->head['title'] = 'View a CV';
            $this->head['description'] = 'View a single CV';
          } else {
            $_SESSION['message'] = $response->message;
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('cv/all');
          }
        }
        break;
      case 'edit': // needs to be logged in as the owner of the cv
        if (count($params) == 0) {
          $this->redirect('cv/all');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $response = CVModel::update($_POST, $params[0]);
          if ($response->message == 'OK') {
            $_SESSION['message'] = 'Your CV has been updated successfully.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $this->redirect('cv/all');
          } else {
            $_SESSION['message'] = $response->message;
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('cv/all');
          }
        } else {
          $response = CVModel::byId($params[0]);
          if ($response->message == 'OK') {
            if ($_SESSION['id'] != $response->query_result['owner_id']) {
              $_SESSION['message'] = 'You do not have permission to edit this CV (must be the owner).';
              $_SESSION['showMessage'] = true;
              $_SESSION['messageType'] = 'danger';
              $this->redirect('cv/all');
            }
            $this->data['cvData'] = $response->query_result;
            $this->view = 'editCV';
            header("HTTP/1.0 200");
            $this->head['title'] = 'Edit a CV';
            $this->head['description'] = 'Edit your CV';
          } else {
            $_SESSION['message'] = $response->message;
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('cv/all');
          }
        }
        break;
      case 'create': // needs to be logged in as a candidate
        if ($_SESSION['role'] != 'candidate') {
          $_SESSION['message'] = 'Must be logged in as a candidate.';
          $_SESSION['showMessage'] = true;
          $_SESSION['messageType'] = 'danger';
          $this->redirect('cv/all');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $response = CVModel::insert($_POST);
          if ($response->message == 'OK') {
            $_SESSION['message'] = 'Your CV has been created successfully.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $this->redirect('cv/all');
          } else {
            $_SESSION['message'] = $response->message;
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('cv/create');
          }
        } else {
          $this->view = 'createCV';
          header("HTTP/1.0 200");
          $this->head['title'] = 'Create a CV';
          $this->head['description'] = 'Create a new CV';
        }
        break;
      default:
        $this->redirect('error');
        break;
    }
  }
}
