<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;

class RegistrationController extends Controller
{
    public function index()
    {

        $data["pageTitle"] = 'Registration';
        $data["activePage"] = 'register';

        $this->render('register', $data);
    }
}