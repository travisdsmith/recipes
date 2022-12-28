<?php

require_once(LIB_PATH . DS . 'initialize.php');

class Favorite extends DatabaseObject {

    protected static $table_name = "favorites";
    protected static $db_fields = array("id", "recipe_id", "user_id");
    public $id;
    public $recipe_id;
    public $user_id;
    
    public static function find_by_user_id($id) {
        return Favorite::find_by_sql("SELECT * FROM favorites WHERE user_id='{$id}'");
    }
    
    public static function count_by_user_id($id) {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table_name . " WHERE user_id='{$id}'";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }
    
    public static function find_favorite($user, $recipe) {
        $result = Favorite::find_by_sql("SELECT * FROM favorites WHERE user_id='{$user}' AND recipe_id='{$recipe}' ");
        return array_shift($result);
    }
}