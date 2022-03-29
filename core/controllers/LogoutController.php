<?php

class LogoutController extends Controller {
  public function process($params) {
		if ($_SESSION['role'] !== 'guest') {
			session_unset();
			$_SESSION['username'] = 'Guest';
			$_SESSION['id'] = 0;
			$_SESSION['role'] = 'guest';
		}
		$this->redirect('home');
  }
}

?>