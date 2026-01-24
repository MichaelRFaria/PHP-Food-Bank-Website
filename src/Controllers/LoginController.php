<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;

class LoginController extends Controller
{
    public function index()
    {

        $data["pageTitle"] = 'Login';
        $data["activePage"] = 'login';

        $this->render('login', $data);
    }
}