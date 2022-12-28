<?php

require_once(LIB_PATH . DS . 'initialize.php');

class Note extends DatabaseObject {

    protected static $table_name = "notes";
    protected static $db_fields = array("id", "content", "user_id", "recipe_id");
    public $id;
    public $content;
    public $user_id;
    public $recipe_id;
    
    public static function find_by_recipe_id($recipe_id) {
        return static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE recipe_id = {$recipe_id}");
    }
    
}