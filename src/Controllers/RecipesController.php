<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;
use In3050Inm428WebDev\PhpMvc\Models;

class RecipesController extends Controller
{
   
    public function index()
    {
        // get type, default az
        $order = 'az';
        if (isset($_GET['order'])) {
            $order = $_GET['order'];
        }

        // check list order(ing) and get data
        switch ($order) {
            case 'az':
                $data["pagetitle"] = 'All Recipes A-Z';
                $template = 'recipes';
                break;
            case 'section':
                $data["pagetitle"] = 'All Recipes by Section';
                $template = 'recipesBySection';
                break;
            case 'latest':
                $data["pagetitle"] = 'Latest Recipes';
                $template = 'recipes';
                break;
        }

        // get content of recipe book
        $recipes = Models\RecipeBook::getRecipes($order);

        // output recipes to page data
        foreach ($recipes as $recipe){
            $recipe_data = get_object_vars($recipe);
            foreach ($recipe_data as $key => $value)
                $data['recipes'][][$key] = $value;
        }
        // render page
        $this->render($template, $data);
    }
}