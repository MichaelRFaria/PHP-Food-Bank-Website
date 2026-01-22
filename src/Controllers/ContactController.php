<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;

class ContactController extends Controller
{
    public function index()
    {

        $data["pageTitle"] = 'Contact Us';
        $data["activePage"] = 'contact';

        $this->render('contact_us', $data);
    }
}