<?php

class LoginController extends Controller
{
  public function process($params)
  {
    if ($_SESSION['isLoggedIn']) {
      $_SESSION['showMessage'] = true;
      $_SESSION['messageType'] = 'danger';
      $_SESSION['message'] = 'You are already logged in';
      $this->redirect('home');
    }
    header("HTTP/1.0 200");
    $this->head['title'] = 'Login Page';
    $this->head['description'] = 'Log in with your account';
    $action = array_shift($params);
    switch ($action) {
      case '':
        // if this is from a login attempt aka with $_POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          require("../core/models/LoginModel.php");
          $loginModel = new LoginModel();
          $loginModel->loadParams($_POST['username'], $_POST['password']);
          $loginModel->executeQuery();
          $result = $loginModel->getResult();
          if ($result['message'] == 'OK') {
            $_SESSION['username'] = $result['username'];
            $_SESSION['id'] = $result['id'];
            $_SESSION['role'] = $result['role'];
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['message'] = 'Logged in successfully';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $this->redirect('home');
          } else {
            $_SESSION['message'] = $result['message'];
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->view = 'login';
          }
        }
        // without $_POST aka first time viewing the page
        else {
          $this->view = 'login';
        }
        break;
      default:
        $this->redirect('error');
        break;
    }
  }
}
