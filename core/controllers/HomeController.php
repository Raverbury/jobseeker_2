<?php

class HomeController extends Controller {
  public function process($params) {
		$action = array_shift($params);
		switch($action) {
			case '':
				header("HTTP/1.0 200");
				$this->head['title'] = 'Home';
				$this->head['description'] = 'Jobseeker\s homepage';
				$this->view = 'home';
				break;
			default:
				$this->redirect('error');
				break;
		}
  }
}
