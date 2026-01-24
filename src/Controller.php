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

        // test
        $twig->addGlobal('loggedIn',isset($_SESSION['loggedin']));
        $twig->addGlobal('role',$_SESSION['role'] ?? null);
        $twig->addGlobal('error',$_SESSION['error'] ?? null);
        $twig->addGlobal('message',$_SESSION['message'] ?? null);


        $template = $twig->load("$view.html");
        echo $template->render($data);

        unset($_SESSION['error'], $_SESSION['message']);

    }
}