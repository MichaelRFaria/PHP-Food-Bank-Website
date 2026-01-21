<?php

namespace In3050Inm428WebDev\PhpMvc\Models;

class Recipe
{
    public $id;
    public $name;
    public $description;
    public $section;

    public function __construct($id, $name, $description, $section)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->section = $section;
    }
}