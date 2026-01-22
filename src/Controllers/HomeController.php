<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;

class HomeController extends Controller
{
    public function index()
    {

        $data["pageTitle"] = 'Community Table';
        $data["activePage"] = 'home';

        $this->render('index', $data);
    }
}