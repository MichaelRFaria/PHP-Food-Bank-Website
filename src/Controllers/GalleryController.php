<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;

class GalleryController extends Controller
{
    public function index()
    {

        $data["pagetitle"] = 'Gallery';

        $this->render('gallery', $data);
    }
}