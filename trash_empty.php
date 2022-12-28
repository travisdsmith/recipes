<?php

$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");

$dbObject = new DatabaseObject();
$dbObject->find_by_sql("DELETE FROM favorites WHERE recipe_id IN (SELECT id FROM recipes WHERE trash = 1)");
$dbObject->find_by_sql("DELETE FROM notes WHERE recipe_id IN (SELECT id FROM recipes WHERE trash = 1)");
$dbObject->find_by_sql("DELETE FROM recipes WHERE trash = 1");

redirect_to("trash_can.php");
