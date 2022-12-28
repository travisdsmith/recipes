<?php

require_once(LIB_PATH . DS . 'database.php');

class DatabaseObject {

    protected static $table_name;
    protected static $db_fields = array();

    public static function find_all() {
        return static::find_by_sql("SELECT * FROM " . static::$table_name);
    }

    public static function find_by_id($id = 0) {
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE id='{$id}' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_sql($query = "") {
        global $database;
        $result_set = $database->query($query);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)) {
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    }

    public static function count_all() {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    private static function instantiate($record) {
        $object = new static;
        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function has_attribute($attribute) {
        return array_key_exists($attribute, $this->attributes());
    }

    protected function attributes() {
        $attributes = array();
        foreach (static::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        global $database;
        $clean_attributes = array();
        foreach ($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }

    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create() {
        global $database;
        $this->id = $database->insert_id();
        $attributes = $this->sanitized_attributes();
        $query = "INSERT INTO " . static::$table_name . " (`";
        $query .= join("`, `", array_keys($attributes));
        $query .= "`) VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";
        if ($database->query(str_replace("''", "NULL", $query))) {
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        global $database;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "`{$key}`='{$value}'";
        }
        $query = "UPDATE " . static::$table_name . " SET ";
        $query .= join(", ", $attribute_pairs);
        $query .= " WHERE id='" . $database->escape_value($this->id) . "'";
        if ($database->query(str_replace("''", "NULL", $query))) {
            return true;
        } else {
            return false;
        }
    }

    public function delete() {
        global $database;
        $query = "DELETE FROM " . static::$table_name;
        $query .= " WHERE id='" . $database->escape_value($this->id);
        $query .= "' LIMIT 1";
        $database->query($query);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public static function get_db_fields() {
        return static::$db_fields;
    }

    public static function get_table_name() {
        return static::$table_name;
    }

}
