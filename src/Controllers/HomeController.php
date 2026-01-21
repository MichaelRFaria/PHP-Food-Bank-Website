<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;

class HomeController extends Controller
{
    public function index()
    {

        $data["pagetitle"] = 'Recipebook';

        $this->render('index', $data);
    }
}