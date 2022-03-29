<?php
// abstract controller to extend from, common functionalities include
// processing stuff based on the url
// rendering view
// redirecting
abstract class Controller {
  protected $data = array();
	protected $view = NULL;
  protected $head = array('title' => NULL, 'description' => NULL);

	abstract function process($params);

	public function renderView() {
    if ($this->view) {
      extract($this->data);
      require("../core/views/" . $this->view . ".php");
    }
	}

	public function redirect($url) {
    header("Location: /$url");
    header("Connection: close");
    exit;
	}
}

?>