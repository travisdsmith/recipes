<?php

$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");

$favorite = Favorite::find_by_id(filter_input(INPUT_GET, "id"));

if ($favorite) {
    if ($favorite->delete()) {
        $session->message("success|Recipe removed from your favorites.");
    } else {
        $session->message("danger|Recipe can't be removed from your favorites.");
    }

    redirect_to("recipe_view.php?id=" . $favorite->id);
} else {
    redirect_to("index.php");
}
?>