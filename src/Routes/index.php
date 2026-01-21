<?php

namespace In3050Inm428WebDev\PhpMvc;

use In3050Inm428WebDev\PhpMvc\Controllers;
use In3050Inm428WebDev\PhpMvc\Router;

$router = new Router();

$router->get('/', Controllers\HomeController::class, 'index');
$router->get('/index.php', Controllers\HomeController::class, 'index');
$router->get('/index.html', Controllers\HomeController::class, 'index');
$router->get('/recipes.php', Controllers\RecipesController::class, 'index');;

$router->dispatch();

?>