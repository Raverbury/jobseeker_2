<?php
define("SESSION_EXPIRE_TIME", "30 minutes");

// main controller, called so often that it might as well act be a part of the index
class RouterController extends Controller
{
  protected $controller;


  function __construct()
  {
    session_start();
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
      if (isset($_SESSION['lastActive'])) {
        $session_expire_time = date('Y-m-d H:i:s', strtotime("+" . SESSION_EXPIRE_TIME, strtotime($_SESSION['lastActive'])));
        $current_time = date('Y-m-d H:i:s');
        // echo ($session_expire_time);
        // echo ($current_time);
        if (strtotime($session_expire_time) < strtotime($current_time)) {
          $_SESSION['username'] = 'Guest';
          $_SESSION['id'] = -1;
          $_SESSION['role'] = 'guest';
          $_SESSION['isLoggedIn'] = false;
          $_SESSION['message'] = 'Session has expired. Please log in again.';
          $_SESSION['showMessage'] = true;
          $_SESSION['messageType'] = 'warning';
          unset($_SESSION['lastActive']);
          $this->redirect('home');
        } else {
          $_SESSION['lastActive'] = date('Y-m-d H:i:s');
        }
      } else {
        $_SESSION['lastActive'] = date('Y-m-d H:i:s');
      }
    } elseif (!isset($_SESSION['id'])) {
      $_SESSION['username'] = 'Guest';
      $_SESSION['id'] = -1;
      $_SESSION['role'] = 'guest';
      $_SESSION['isLoggedIn'] = false;
      $_SESSION['message'] = '';
      $_SESSION['showMessage'] = false;
      $_SESSION['messageType'] = 'primary';
    }
    // echo json_encode($_SESSION);
  }

  public function process($params)
  {
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
    } else
      $this->redirect('error');
  }

  private function parseUrl($url)
  {
    $parsedUrl = parse_url($url);
    $parsedUrl["path"] = ltrim($parsedUrl["path"], "/");
    $parsedUrl["path"] = trim($parsedUrl["path"]);
    $explodedUrl = explode("/", $parsedUrl["path"]);
    return $explodedUrl;
  }

  private function dashesToCamel($text)
  {
    $text = str_replace('-', ' ', $text);
    $text = ucwords($text); // apply uppercase to first letter
    $text = str_replace(' ', '', $text);
    return $text;
  }
}
