<?php

$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");

$recipes = Recipe::find_recipes_in_trash();

foreach ($recipes as $recipe) {
    $favorites = Favorite::find_by_recipe_id($recipe->id);
    foreach ($favorites as $favorite) {
        $favorite->delete();
    }
    
    $notes = Note::find_by_recipe_id($recipe->id);
    foreach ($notes as $note) {
        $note->delete();
    }
    
    $recipe->delete();
}

$message = "success|Trash can emptied successfully.";

redirect_to("trash_can.php");
