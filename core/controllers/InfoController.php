<?php

class InfoController extends Controller {
  public function process($params) {
  	header("HTTP/1.0 200");
  	$this->head['title'] = 'Information';
		$this->head['description'] = 'Contains information about the website';
  	$this->view = 'info';
  }
}

?>