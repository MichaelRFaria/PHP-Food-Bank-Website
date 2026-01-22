<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;

class ContactController extends Controller
{
    public function index()
    {

        $data["pagetitle"] = 'Contact Us';

        $this->render('contact_us', $data);
    }
}