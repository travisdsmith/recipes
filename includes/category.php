<?php

require_once(LIB_PATH . DS . 'initialize.php');

class Category extends DatabaseObject {

    protected static $table_name = "categories";
    protected static $db_fields = array("id", "name");
    public $id;
    public $name;
    
    public static function find_all() {
        return static::find_by_sql("SELECT * FROM " . static::$table_name . " ORDER BY name ASC");
    }
    
}