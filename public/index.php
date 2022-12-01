<?php
mb_internal_encoding("UTF-8");

function autoloadFunction($class)
{
  // Ends with a string "Controller"?
  if (preg_match('/Controller$/', $class))
    require("../core/controllers/" . $class . ".php");
  elseif (preg_match('/Model$/', $class))
    require("../core/models/" . $class . ".php");
  else
    require("../core/other/" . $class . ".php");
}

spl_autoload_register("autoloadFunction");

// $userManager = new UserManager();
$router = new RouterController();
$router->process(array($_SERVER['REQUEST_URI']));
$router->renderView();
