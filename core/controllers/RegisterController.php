<?php

class RegisterController extends Controller {
  public function process($params) {
		// if this is from a register attempt aka with $_POST
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			require("../core/models/RegisterModel.php");
			$registerModel = new RegisterModel();
			$registerModel->executeQuery($_POST);
			$result = $registerModel->getResult();
			if ($result['message'] === 'OK') {
				$_SESSION['username'] = $result['username'];
				$_SESSION['id'] = $result['id'];
				$_SESSION['role'] = $result['role'];
				$this->redirect('home');
			}
			else {
				$this->data['message'] = $result['message'];
				$this->view = 'register';
			}
		}
		// without $_POST aka first time viewing the page
		else {
			if ($_SESSION['role'] === 'guest') {
				$this->view = 'register';
			}
			else {
				$this->redirect('home');
			}
		}
  }
}

?>