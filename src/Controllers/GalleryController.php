<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;

class GalleryController extends Controller
{
    public function index()
    {

        $data["pageTitle"] = 'Gallery';
        $data["activePage"] = 'gallery';

        $this->render('gallery', $data);
    }
}