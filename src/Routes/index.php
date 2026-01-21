<?php

namespace In3050Inm428WebDev\PhpMvc;

use In3050Inm428WebDev\PhpMvc\Controllers\HomeController;
use In3050Inm428WebDev\PhpMvc\Router;

$router = new Router();

$router->get('/', HomeController::class, 'index');
$router->get('/index.php', HomeController::class, 'index');
$router->get('/index.html', HomeController::class, 'index');
//$router->get('/recipes.php', RecipesController::class, 'index');;

$router->dispatch();

?>