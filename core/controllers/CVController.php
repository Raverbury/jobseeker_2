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
        $this->view = 'allCVs';
        break;
      case 'view':
        if (count($params) == 0) {
          $this->redirect('cv/all');
        } else {
          require('../core/models/viewCVModel.php');
          $temp = new viewCVModel();
          $temp->loadParams($params[0]);
          $temp->executeQuery();
          $result = $temp->getResult();
          $this->data['cvData'] = $result['data'][0];
          $this->view = 'viewCV';
        }
        break;
      case 'edit': // needs to be logged in as the owner of the cv
        if (count($params) == 0) {
          $this->redirect('cv/all');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          require('../core/models/cvUpdateModel.php');
          $temp = new cvUpdateModel();
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
            $this->view = 'register';
          }
        } else {
          require('../core/models/viewCVModel.php');
          $temp = new viewCVModel();
          $temp->loadParams($params[0]);
          $temp->executeQuery();
          $result = $temp->getResult();
          if ($_SESSION['id'] != $result['data'][0]['UserID']) {
            $_SESSION['message'] = 'You do not have permission to edit this CV.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('cv/all');
          }
          $this->data['cvData'] = $result['data'][0];
          $this->view = 'editCV';
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
          require('../core/models/cvCreateModel.php');
          $temp = new cvCreateModel();
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
            $this->view = 'register';
          }
        } else {
          $this->view = 'createCV';
        }
        break;
      default:
        $this->redirect('error');
        break;
    }
  }
}
