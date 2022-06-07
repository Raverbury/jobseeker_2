<?php

class RecruitController extends Controller
{
  public function process($params)
  {
    require('..\core\models\RecruitModel.php');
    $recruitModel = new RecruitModel();
    $action = array_shift($params);
    switch ($action) {
      case '':
        $this->redirect('recruit/all');
        break;
      case 'all':
        $recruitModel->getAllQuery(); // param = SESSION[id]
        $this->result = $recruitModel->getResult();
        $result = $this->result;
        if ($result['message'] == 'OK') {
          $this->view = 'recruitViewAll';
          header("HTTP/1.0 200");
          $this->head['title'] = 'View all JDs';
          $this->head['description'] = 'View all JDs';
        } else {
          $_SESSION['message'] = $result['message'];
          $_SESSION['showMessage'] = true;
          $_SESSION['messageType'] = 'danger';
          // $this->redirect('recruit/all');
        }
        break;
      case 'create':
        if ($_SESSION['role'] != 'employer') {
          $_SESSION['message'] = 'Must be logged in as an employer.';
          $_SESSION['showMessage'] = true;
          $_SESSION['messageType'] = 'danger';
          $this->redirect('recruit/all');
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $recruitModel->loadParams($_SESSION['id'], $_POST['companyname'], $_POST['title'], $_POST['expyear'], $_POST['salary'], $_POST['jobdes']);
          $recruitModel->executeQuery();
          $result = $recruitModel->getResult();
          if ($result['message'] == 'OK') {
            $_SESSION['message'] = 'Your JD has been created successfully.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $this->redirect('recruit/all');
          } else {
            $_SESSION['message'] = $result['message'];
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('recruit/create');
          }
          $this->redirect('recruit/all');
          //print_r($_POST);
        } else {
          $this->view = 'recruitCreate';
        }
        break;
      case 'view':
        if (count($params) > 0) { // queried id
          //print_r($params[0]);
          $recruitModel->getJDWithId($params[0]);
          $this->result = $recruitModel->getResult();
          $result = $this->result;
          $this->result['jdID'] = $params[0];
          if ($result['message'] == 'OK') {
            $this->view = 'recruitView';
            header("HTTP/1.0 200");
            $this->head['title'] = 'View a JD';
            $this->head['description'] = 'View a single JDs';
          } else {
            $_SESSION['message'] = $result['message'];
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('recruit/all');
          }
        } else {
          $this->redirect('recruit/all');
        }
        break;
      case 'apply':
        if ($_SESSION['role'] != 'candidate') {
          $_SESSION['message'] = 'Must be logged in as a candidate.';
          $_SESSION['showMessage'] = true;
          $_SESSION['messageType'] = 'danger';
          $this->redirect('recruit/all');
        }
        if (count($params) > 0) {
          $jdID = $params[0];
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $recruitModel->getJDWithId($params[0]);
          $this->result = $recruitModel->getResult();
          $result = $this->result;
          if ($result['message'] == 'OK') {
            $this->view = 'recruitView';
            header("HTTP/1.0 200");
            $this->head['title'] = 'View a JD';
            $this->head['description'] = 'View a single JDs';
          } else {
            $_SESSION['message'] = $result['message'];
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('recruit/all');
          }
          } else {
            require('../core/models/FetchCVByUserModel.php');
            $fetchCVs = new FetchCVByUserModel();
            $fetchCVs->loadParams($_SESSION['id']);
            $fetchCVs->executeQuery();
            $cvs = $fetchCVs->getResult();
            $this->data['cvs'] = $cvs['data'];
            $this->view = 'apply';
          }
        } else {
          $this->redirect('recruit/all');
        }
        break;
      default:
        $this->redirect('error');
        break;
    }
  }
}
