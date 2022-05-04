<?php

class RegisterController extends Controller
{
	public function process($params)
	{
		$action = array_shift($params);
		switch ($action) {
			case '':
				// if this is from a register attempt aka with $_POST
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					require("../core/models/RegisterModel.php");
					$registerModel = new RegisterModel();
          $registerModel->loadParams($_POST['username'], $_POST['password'], $_POST['retypePassword'], $_POST['role']);
					$registerModel->executeQuery();
					$result = $registerModel->getResult();
					if ($result['message'] == 'OK') {
						$_SESSION['username'] = $result['username'];
						$_SESSION['id'] = $result['id'];
						$_SESSION['role'] = $result['role'];
						$_SESSION['isLoggedIn'] = true;
            $_SESSION['message'] = 'User has been registered';
            $_SESSION['showMessage'] = true;
						$this->redirect('home');
					} else {
						$_SESSION['message'] = $result['message'];
            $_SESSION['showMessage'] = true;
						$this->view = 'register';
					}
				}
				// without $_POST aka first time viewing the page
				else {
					if ($_SESSION['isLoggedIn']) {
						$this->redirect('home');
					} else {
						$this->view = 'register';
					}
				}
				break;
			default:
				$this->redirect('error');
				break;
		}
	}
}
