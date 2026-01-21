<?php

namespace In3050Inm428WebDev\PhpMvc;

require_once 'vendor/autoload.php';

class Controller
{
    public $data;
    
    protected function render($view, $data = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('src/Views');
        $twig = new \Twig\Environment($loader, ['cache' => FALSE, 'debug' => true ,]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        $template = $twig->load("$view.html");
        echo $template->render($data);

    }
}