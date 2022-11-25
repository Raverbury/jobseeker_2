<?php

class RegisterController extends Controller
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
    $this->head['title'] = 'Registration Page';
    $this->head['description'] = 'Register a new account';
    $action = array_shift($params);
    switch ($action) {
      case '':
        // if this is from a register attempt aka with $_POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // require("../core/models/RegisterModel.php");
          // $registerModel = new RegisterModel();
          // $registerModel->loadParams($_POST['username'], $_POST['password'], $_POST['retypePassword'], $_POST['role']);
          // $registerModel->executeQuery();
          // $result = $registerModel->getResult();
          $userModel = new UserModel();
          $response = $userModel->register($_POST['username'], $_POST['password'], $_POST['retypePassword'], $_POST['role']);
          if ($response->message == 'OK') {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $response->query_result['id'];
            $_SESSION['role'] = $_POST['role'];
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['message'] = 'User has been registered.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $this->redirect('home');
          } else {
            $_SESSION['message'] = $response->message;
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->view = 'register';
          }
        }
        // without $_POST aka first time viewing the page
        else {
          $this->view = 'register';
        }
        break;
      default:
        $this->redirect('error');
        break;
    }
  }
}
