<?php

class LogoutController extends Controller
{
  public function process($params)
  {
    $action = array_shift($params);
    switch ($action) {
      case '':
        if ($_SESSION['isLoggedIn']) {
          session_unset();
          $_SESSION['username'] = 'Guest';
          $_SESSION['id'] = -1;
          $_SESSION['role'] = 'guest';
          $_SESSION['isLoggedIn'] = false;
          $_SESSION['message'] = 'Logged out successfully.';
          $_SESSION['showMessage'] = true;
          $_SESSION['messageType'] = 'success';
        }
        $this->redirect('home');
        break;
      default:
        $this->redirect('error');
        break;
    }
  }
}
