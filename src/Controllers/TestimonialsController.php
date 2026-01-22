<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;

class TestimonialsController extends Controller
{
    public function index()
    {

        $data["pagetitle"] = 'Testimonials';

        $this->render('testimonials', $data);
    }
}