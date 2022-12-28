<?php

$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");

if ($id = filter_input(INPUT_GET, 'id')) {
    $note = Note::find_by_id($id);

    if ($note->delete()) {
        $session->message("success|Note deleted.");
    } else {
        $session->message("danger|Note could not be deleted.");
    }

    redirect_to("recipe_view.php?id=" . $note->recipe_id);
} else {
    redirect_to("index.php");
}
?>