<?php
mb_internal_encoding("UTF-8");

function autoloadFunction($class)
{
  // Ends with a string "Controller"?
  if (preg_match('/Controller$/', $class))
    require("../core/controllers/" . $class . ".php");
  else
    require("../core/models/" . $class . ".php");
}

spl_autoload_register("autoloadFunction");

// $userManager = new UserManager();
$router = new RouterController();
$router->process(array($_SERVER['REQUEST_URI']));
$router->renderView();
