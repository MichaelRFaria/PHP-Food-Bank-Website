<?php

namespace In3050Inm428WebDev\PhpMvc;

use In3050Inm428WebDev\PhpMvc\Controllers\HomeController;
use In3050Inm428WebDev\PhpMvc\Controllers\ContactController;
use In3050Inm428WebDev\PhpMvc\Controllers\GalleryController;
use In3050Inm428WebDev\PhpMvc\Controllers\TestimonialsController;
use In3050Inm428WebDev\PhpMvc\Controllers\LoginController;

use In3050Inm428WebDev\PhpMvc\Router;

$router = new Router();

$router->get('/', HomeController::class, 'index');
$router->get('/index.php', HomeController::class, 'index');
$router->get('/index.html', HomeController::class, 'index');
$router->get('/contact_us', ContactController::class, 'index');
$router->get('/gallery', GalleryController::class, 'index');
$router->get('/testimonials', TestimonialsController::class, 'index');
$router->get('/login', LoginController::class, 'index');

$router->dispatch();

?>