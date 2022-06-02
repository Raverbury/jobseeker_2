<?php

class UserController extends Controller
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
        $this->redirect('home');
        break;
      case 'view':
        if (count($params) < 1) {
          $this->redirect('home');
        }
        $id = array_shift($params);
        if ($_SESSION['id'] != $id) {
          $_SESSION['showMessage'] = true;
          $_SESSION['message'] = 'Must be logged in as the user with such ID.';
          $_SESSION['messageType'] = 'danger';
          $this->redirect('home');
        }
        require('../core/models/FetchCVByUserModel.php');
        $cvModel = new FetchCVByUserModel();
        $cvModel->loadParams($id);
        $cvModel->executeQuery();
        $cvResult = $cvModel->getResult();
        require('../core/models/FetchJDByUserModel.php');
        $jdModel = new FetchJDByUserModel();
        $jdModel->loadParams($id);
        $jdModel->executeQuery();
        $jdResult = $jdModel->getResult();
        if ($cvResult['message'] == 'OK' && $jdResult['message'] == 'OK') {
          $this->data['cv'] = $cvResult['data'];
          $this->data['jd'] = $jdResult['data'];
          header("HTTP/1.0 200");
          $this->head['title'] = 'Profile';
          $this->head['description'] = 'User profile page';
          $this->view = 'viewUser';
        }
        else {
          $_SESSION['showMessage'] = true;
          $_SESSION['message'] = 'CV: ' . $cvResult['message'] . '; JD: ' . $jdResult['message'];
          $_SESSION['messageType'] = 'danger';
          $this->redirect('home');
        }
        break;
      case 'changeUsername':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          if (count($params) < 1) {
            $this->redirect('home');
          }
          else {
            $id = array_shift($params);
          }
          require('../core/models/UpdateUsernameModel.php');
          $UUM = new UpdateUsernameModel();
          $UUM->loadParams($_POST['username'], $id);
          $UUM->executeQuery();
          $result = $UUM->getResult();
          if ($result['message'] == 'OK') {
            $_SESSION['message'] = 'Username was changed successfully.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $_SESSION['username'] = $_POST['username'];
            $this->redirect('user/view/'.$_SESSION['id']);
          } else {
            $_SESSION['message'] = $result['message'];
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('user/view/'.$_SESSION['id']);
          }
        }
        else {
          $this->redirect('home');
        }
        break;
      case 'changePassword':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          if (count($params) < 1) {
            $this->redirect('home');
          }
          else {
            $id = array_shift($params);
          }
          require('../core/models/UpdatePasswordModel.php');
          $UPM = new UpdatePasswordModel();
          $UPM->loadParams($_POST['oldPassword'], $_POST['newPassword'], $_POST['repeatPassword'], $id);
          $UPM->executeQuery();
          $result = $UPM->getResult();
          if ($result['message'] == 'OK') {
            $_SESSION['message'] = 'Password was changed successfully.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $this->redirect('user/view/'.$_SESSION['id']);
          } else {
            $_SESSION['message'] = $result['message'];
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('user/view/'.$_SESSION['id']);
          }
        }
        else {
          $this->redirect('home');
        }
        break;
      default:
        $this->redirect('error');
        break;
    }
  }
}
