<?php

$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");

if (filter_input(INPUT_POST, 'submit')) {
    $note = new Note();
    $note->content = filter_input(INPUT_POST, 'content');
    $note->recipe_id = filter_input(INPUT_POST, 'recipe_id');
    $note->user_id = $session->user_id->id;

    if ($note->create()) {
        $session->message("success|Note added.");
    } else {
        $session->message("danger|Note could not be added.");
    }

    redirect_to("recipe_view.php?id=" . filter_input(INPUT_POST, "recipe_id"));
} else {
    redirect_to("index.php");
}
?>