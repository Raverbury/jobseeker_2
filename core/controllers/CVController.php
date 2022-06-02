<?php

class CVController extends Controller
{
  public function process($params)
  {
    if ($_SESSION['isLoggedIn'] == false) {
      $_SESSION['showMessage'] = true;
      $_SESSION['message'] = 'You are not logged in';
      $_SESSION['messageType'] = 'danger';
      $this->redirect('home');
    }
    $action = array_shift($params);
    switch ($action) {
      case '':
        $this->redirect('cv/all');
        break;
      case 'all':
        require('../core/models/FetchCVModel.php');
        $temp = new FetchCVModel();
        $temp->executeQuery();
        $result = $temp->getResult();
        $this->data['names'] = $result['data'][0];
        $this->data['IDs'] = $result['data'][1];
        $this->data['owners'] = $result['data'][2];
        header("HTTP/1.0 200");
        $this->head['title'] = 'View all CVs';
        $this->head['description'] = 'View all CVs';
        $this->view = 'viewAllCVs';
        break;
      case 'view':
        if (count($params) == 0) {
          $this->redirect('cv/all');
        } else {
          require('../core/models/ViewCVModel.php');
          $temp = new ViewCVModel();
          $temp->loadParams($params[0]);
          $temp->executeQuery();
          $result = $temp->getResult();
          $this->data['cvData'] = $result['data'][0];
          if ($result['message'] == 'OK') {
            $this->view = 'viewCV';
            header("HTTP/1.0 200");
            $this->head['title'] = 'View a CV';
            $this->head['description'] = 'View a single CV';
          } else {
            $_SESSION['message'] = $result['message'];
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
          require('../core/models/UpdateCVModel.php');
          $temp = new UpdateCVModel();
          $temp->loadParams($_POST, $params[0]);
          $temp->executeQuery();
          $result = $temp->getResult();
          if ($result['message'] == 'OK') {
            $_SESSION['message'] = 'Your CV has been updated successfully.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $this->redirect('cv/all');
          } else {
            $_SESSION['message'] = $result['message'];
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('cv/all');
          }
        } else {
          require('../core/models/ViewCVModel.php');
          $temp = new ViewCVModel();
          $temp->loadParams($params[0]);
          $temp->executeQuery();
          $result = $temp->getResult();
          if ($result['message'] == 'OK') {
            if ($_SESSION['id'] != $result['data'][0]['UserID']) {
              $_SESSION['message'] = 'You do not have permission to edit this CV (must be the owner).';
              $_SESSION['showMessage'] = true;
              $_SESSION['messageType'] = 'danger';
              $this->redirect('cv/all');
            }
            $this->data['cvData'] = $result['data'][0];
            $this->view = 'editCV';
            header("HTTP/1.0 200");
            $this->head['title'] = 'Edit a CV';
            $this->head['description'] = 'Edit your CV';
          } else {
            $_SESSION['message'] = $result['message'];
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('cv/all');
          }
        }
        break;
      case 'create': // needs to be logged in as a candidate
        if ($_SESSION['role'] != 'candidate') {
          $_SESSION['message'] = 'You must be a candidate.';
          $_SESSION['showMessage'] = true;
          $_SESSION['messageType'] = 'danger';
          $this->redirect('cv/all');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          require('../core/models/CreateCVModel.php');
          $temp = new CreateCVModel();
          $temp->loadParams($_POST);
          $temp->executeQuery();
          $result = $temp->getResult();
          if ($result['message'] == 'OK') {
            $_SESSION['message'] = 'Your CV has been created successfully.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $this->redirect('cv/all');
          } else {
            $_SESSION['message'] = $result['message'];
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
