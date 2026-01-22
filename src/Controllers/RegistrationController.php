<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;

class RegistrationController extends Controller
{
    public function index()
    {

        $data["pageTitle"] = 'Registration';

        $this->render('register', $data);
    }
}