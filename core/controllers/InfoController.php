<?php

class InfoController extends Controller
{
	public function process($params)
	{
		$action = array_shift($params);
		switch ($action) {
			case '':
				header("HTTP/1.0 200");
				$this->head['title'] = 'Information';
				$this->head['description'] = 'Contains information about the website';
				$this->view = 'info';
				break;
			default:
				$this->redirect('error');
				break;
		}
	}
}
