<?php

class HomeController extends Controller {
  public function process($params) {
  	header("HTTP/1.0 200");
  	$this->head['title'] = 'Home';
		$this->head['description'] = 'Jobseeker\s homepage';
  	$this->view = 'home';
  }
}

?>