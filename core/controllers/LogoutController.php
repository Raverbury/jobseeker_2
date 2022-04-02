<?php

class LogoutController extends Controller {
  public function process($params) {
		if ($_SESSION['isLoggedIn']) {
			session_unset();
			$_SESSION['username'] = 'Guest';
			$_SESSION['id'] = -1;
			$_SESSION['role'] = 'guest';
			$_SESSION['isLoggedIn'] = false;
		}
		$this->redirect('home');
  }
}
