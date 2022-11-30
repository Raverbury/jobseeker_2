<?php

use function PHPSTORM_META\type;

class AdminController extends Controller
{
  public function process($params)
  {
    if (!($_SESSION['isLoggedIn'] && $_SESSION['role'] == 'admin')) {
      $_SESSION['message'] = 'Requires administrator privileges.';
      $_SESSION['showMessage'] = true;
      $_SESSION['messageType'] = 'danger';
      $this->redirect('home');
    }
    $action = array_shift($params);
    switch ($action) {
      case '':
        $this->redirect('admin/viewAllUsers');
        break;
      case 'addUser':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
          $response = UserModel::register($_POST['username'], $_POST['password'], $_POST['retypePassword'], $_POST['role']);
          if ($response->message == 'OK') {
            $_SESSION['message'] = 'User has been registered.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $this->redirect('admin');
          } else {
            $_SESSION['message'] = $response['message'];
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->view = 'admin';
          }
        } else {
          $this->redirect('admin');
        }
      case 'viewAllUsers':
        // check params
        $this->data['currentPage'] = 1;
        $this->data['searchUsername'] = '';
        $this->data['filterRole'] = '';
        $bad = false;
        if (isset($_GET['page'])) {
          if (is_numeric($_GET['page'])) {
            $this->data['currentPage'] = (int)($_GET['page']);
          } else {
            $bad = true;
          }
        } else {
          $bad = true;
        }
        if (isset($_GET['searchUsername'])) {
          $this->data['searchUsername'] = $_GET['searchUsername'];
        } else {
          $bad = true;
        }
        if (isset($_GET['filterRole'])) {
          $this->data['filterRole'] = $_GET['filterRole'];
        } else {
          $bad = true;
        }
        if ($bad) {
          $final = 'admin/viewAllUsers?page=' . $this->data['currentPage'] . '&searchUsername=' . $this->data['searchUsername'] . '&filterRole=' . $this->data['filterRole'];
          $this->redirect($final);
        }
        $this->view = 'admin';
        header("HTTP/1.0 200");
        $this->head['title'] = 'Admin';
        $this->head['description'] = 'Manage users';
        $response = UserModel::all($this->data['currentPage'], $this->data['searchUsername'], $this->data['filterRole']);
        if ($response->message == 'OK') {
          $this->data['numOfPages'] = $response->extra['numOfPages'];
          $this->data['users'] = $response->query_result;
          $this->data['currentPage'] = $response->extra['currentPage'];
        }
        break;
      default:
        $this->redirect('error');
        break;
    }
  }
}
