<?php

namespace In3050Inm428WebDev\PhpMvc\Models;

use In3050Inm428WebDev\PhpMvc\Models;

require_once('./includes/dbconnect.php');

class RecipeBook
{
    
    public static function getRecipes($order){
        // setup sql
        $sql = 'SELECT r.recipe_id, recipe_name, recipe_description, section_name FROM recipe r LEFT JOIN recipe_section rs ON r.recipe_id = rs.recipe_id LEFT JOIN section s ON rs.section_id = s.section_id ORDER BY';
        // check list order(ing) and setup sql
        switch ($order) {
            case 'az':
                // Set ordering
                $sql .= ' recipe_name';
                 
                break;
            case 'section':
                // Set ordering
                $sql .= ' s.section_name, recipe_name';

                break;
            case 'latest':
                // Set ordering
                $sql .= ' recipe_date';

                break;
        }
        // get connect and data
        $connection = db_connect();

        // Prepare SQL, prepared statements will help prevent SQL injection.
        if ($stmt = $connection->prepare($sql)) {
            $stmt->execute();
            // output resultset as array of Recipes
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $recipes[] = new Models\Recipe($row['recipe_id'], $row['recipe_name'], $row['recipe_description'], $row['section_name']);
            }
        }
        // Close connection
        $connection->close();
        return $recipes;
    }
}