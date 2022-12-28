<?php

require_once(LIB_PATH . DS . 'initialize.php');

class Recipe extends DatabaseObject {

    protected static $table_name = "recipes";
    protected static $db_fields = array("id", "title", "content", "category_id", "trash");
    public $id;
    public $title;
    public $content;
    public $category_id;
    public $trash;
    
    public static function find_by_category_id($id) {
        return Recipe::find_by_sql("SELECT * FROM recipes WHERE category_id='{$id}' AND trash = 0 ORDER BY TRIM(title) ASC");
    }
    
    public static function count_by_category_id($id) {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table_name . " WHERE category_id='{$id}' AND trash = 0";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }
    
    public static function find_recipes_in_trash() {
        return Recipe::find_by_sql("SELECT * FROM recipes WHERE trash = 1");
    }
    
    public static function count_recipes_in_trash() {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table_name . " WHERE trash = 1";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }
    
    public static function search($terms, $title_only){
        if($title_only==0){
            return Recipe::find_by_sql("SELECT * FROM recipes WHERE MATCH (title, content) AGAINST('{$terms}')");
        } else if($title_only==1){
            return Recipe::find_by_sql("SELECT * FROM recipes WHERE MATCH (title) AGAINST('{$terms}')");
        }
    }
}