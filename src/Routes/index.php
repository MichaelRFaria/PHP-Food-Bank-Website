<?php

namespace In3050Inm428WebDev\PhpMvc;

use In3050Inm428WebDev\PhpMvc\Controllers\HomeController;
use In3050Inm428WebDev\PhpMvc\Controllers\ContactController;
use In3050Inm428WebDev\PhpMvc\Controllers\GalleryController;
use In3050Inm428WebDev\PhpMvc\Controllers\TestimonialsController;
use In3050Inm428WebDev\PhpMvc\Router;

$router = new Router();

$router->get('/', HomeController::class, 'index');
$router->get('/index.php', HomeController::class, 'index');
$router->get('/index.html', HomeController::class, 'index');
$router->get('/contact_us.html', ContactController::class, 'index');
$router->get('/gallery.html', GalleryController::class, 'index');
$router->get('/testimonials.html', TestimonialsController::class, 'index');

$router->dispatch();

?>