<?php

$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");

$favorite = new Favorite();

if ($favorite->user_id = filter_input(INPUT_GET, "user") && $favorite->recipe_id = filter_input(INPUT_GET, "recipe")) {
    if ($favorite->create()) {
        $session->message("success|Recipe added to your favorites.");
    } else {
        $session->message("danger|Recipe can't be added to your favorites.");
    }

    redirect_to("recipe_view.php?id=" . filter_input(INPUT_GET, "recipe"));
} else {
    redirect_to("index.php");
}
?>