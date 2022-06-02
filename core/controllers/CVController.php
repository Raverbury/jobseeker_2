<?php

class CVController extends Controller
{
  public function process($params)
  {
    $action = array_shift($params);
    switch ($action) {
      case '':
        $this->redirect('cv/all');
        break;
      case 'all':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          require('../core/models/FetchCVModel.php');
          $temp = new FetchCVModel();
          $temp->executeQuery();
          $result = $temp->getResult();
          $this->data['names'] = $result['data'][0];
          $this->data['IDs'] = $result['data'][1];
          $this->view = 'allCVs';
        } else {
          require('../core/models/FetchCVModel.php');
          $temp = new FetchCVModel();
          $temp->executeQuery();
          $result = $temp->getResult();
          $this->data['names'] = $result['data'][0];
          $this->data['IDs'] = $result['data'][1];
          if ($_SESSION['isLoggedIn'] == false) {
            $this->view = 'allCvsalter';
          } else {
            $this->view = 'allCVs';
          }
        }
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
      case 'edit':
        if (count($params) == 0) {
          $this->redirect('cv/all');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          require('../core/models/cvUpdateModel.php');
          $temp = new cvUpdateModel();
          $temp->loadParams($_POST, $params[0]);
          $temp->executeQuery();
          print($params[0]);

          $result = $temp->getResult();
          if ($result['message'] == 'OK') {
            $_SESSION['message'] = 'Sucessful!!!';
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
          $this->data['cvData'] = $result['data'][0];
          $this->view = 'editCV';
        }
        break;
      case 'create':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          print_r($_POST);
          require('../core/models/cvCreateModel.php');
          $temp = new cvCreateModel();
          $temp->loadParams($_POST);
          $temp->executeQuery();
          $result = $temp->getResult();
          if ($result['message'] == 'OK') {
            $_SESSION['message'] = 'Sucessful!!!';
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
          if ($_SESSION['isLoggedIn'] == false) {
            $_SESSION['message'] = 'Please Log In First!!!';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('home');
          }
          $this->view = 'cv';
        }
        break;
      default:
        $this->redirect('error');
        break;
    }
  }
}
