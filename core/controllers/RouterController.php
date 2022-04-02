<?php
// main controller, called so often that it might as well act be a part of the index
class RouterController extends Controller {
	protected $controller;

	function __construct() {
		session_start();
		if (!isset($_SESSION['id'])) {
			$_SESSION['username'] = 'Guest';
			$_SESSION['id'] = -1;
			$_SESSION['role'] = 'guest';
			$_SESSION['isLoggedIn'] = false;
		}
	}

	public function process($params) {
		$parsedUrl = $this->parseUrl($params[0]);
		if (empty($parsedUrl[0]))
      $this->redirect('home');
		$controllerClass = $this->dashesToCamel(array_shift($parsedUrl)) . 'Controller';
		if (file_exists('../core/controllers/' . $controllerClass . '.php')) {
    	$this->controller = new $controllerClass;
			$this->controller->process($parsedUrl);
			$this->data['title'] = $this->controller->head['title'];
			$this->data['description'] = $this->controller->head['description'];
			$this->view = 'frame';
		}
		else
    	$this->redirect('error');
  }

	private function parseUrl($url) {
		$parsedUrl = parse_url($url);
		$parsedUrl["path"] = ltrim($parsedUrl["path"], "/");
		$parsedUrl["path"] = trim($parsedUrl["path"]);
		$explodedUrl = explode("/", $parsedUrl["path"]);
		return $explodedUrl;
	}

	private function dashesToCamel($text) {
		$text = str_replace('-', ' ', $text);
		$text = ucwords($text); // apply uppercase to first letter
		$text = str_replace(' ', '', $text);
		return $text;
	}
}
