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
        $cv_response = CVModel::byOwnerId($id);
        $jd_response = JDModel::byOwnerId($id);
        if ($cv_response->message == "OK" && $jd_response->message == "OK") {
          $this->data['CVs'] = $cv_response->query_result;
          $this->data['JDs'] = $jd_response->query_result;
          header("HTTP/1.0 200");
          $this->head['title'] = 'Profile';
          $this->head['description'] = 'User profile page';
          $this->view = 'viewUser';
        }
        else {
          $_SESSION['showMessage'] = true;
          $_SESSION['message'] = 'CV: ' . $cv_response->message . '; JD: ' . $jd_response->message;
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
          $response = UserModel::updateUsername($id, $_POST['username']);
          if ($response->message == 'OK') {
            $_SESSION['message'] = 'Username was changed successfully.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $_SESSION['username'] = $_POST['username'];
            $this->redirect('user/view/'.$_SESSION['id']);
          } else {
            $_SESSION['message'] = $response->message;
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
          $response = UserModel::updatePassword($id, $_POST['oldPassword'], $_POST['newPassword'], $_POST['repeatPassword']);
          if ($response->message == 'OK') {
            $_SESSION['message'] = 'Password was changed successfully.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $this->redirect('user/view/'.$_SESSION['id']);
          } else {
            $_SESSION['message'] = $response->message;
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
