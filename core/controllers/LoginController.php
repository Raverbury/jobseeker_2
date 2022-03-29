<?php

class LoginController extends Controller {
  public function process($params) {
		// if this is from a login attempt aka with $_POST
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			require("../core/models/LoginModel.php");
			$loginModel = new LoginModel();
			$loginModel->executeQuery($_POST);
			$result = $loginModel->getResult();
			if ($result['message'] === 'OK') {
				$_SESSION['username'] = $result['username'];
				$_SESSION['id'] = $result['id'];
				$_SESSION['role'] = $result['role'];
				$this->redirect('home');
			}
			else {
				$this->data['message'] = $result['message'];
				$this->view = 'login';
			}
		}
		// without $_POST aka first time viewing the page
		else {
			if ($_SESSION['role'] === 'guest') {
				$this->view = 'login';
			}
			else {
				$this->redirect('home');
			}
		}
  }
}

?>