<?php

class ErrorController extends Controller {
  public function process($params) {
		$action = array_shift($params);
		switch($action) {
			case '':
				header("HTTP/1.0 404 Not Found");
  			$this->head['title'] = 'Error 404';
				$this->head['description'] = 'Error 404';
  			$this->view = 'error';
				break;
			default:
				$this->redirect('error');
				break;
		}
  }
}
