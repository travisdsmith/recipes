<?php

$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");

if ($id = filter_input(INPUT_GET, "id")) {
    $recipe = Recipe::find_by_id($id);
    $recipe->trash = 1;
    if ($recipe->update()) {
        $session->message("success|Recipe moved to trash.");
    } else {
        $session->message("danger|Could not restore recipe.");
    }

    redirect_to("recipe_view.php?id=" . $id);
} else {
    redirect_to("index.php");
}