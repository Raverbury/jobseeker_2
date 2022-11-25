<?php

class LoginController extends Controller
{
  public function process($params)
  {
    if ($_SESSION['isLoggedIn']) {
      $_SESSION['showMessage'] = true;
      $_SESSION['messageType'] = 'danger';
      $_SESSION['message'] = 'You are already logged in.';
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
          $response = UserModel::login($_POST['username'], $_POST['password']);
          if ($response->message == 'OK') {
            $_SESSION['username'] = $response->query_result['username'];
            $_SESSION['id'] = $response->query_result['id'];
            $_SESSION['role'] = $response->query_result['role'];
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['message'] = 'Logged in successfully.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $this->redirect('home');
          } else {
            $_SESSION['message'] = $response['message'];
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
