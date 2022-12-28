<?php

class User extends DatabaseObject {

    protected static $table_name = "users";
    protected static $db_fields = array('id', 'username', 'password');
    public $id;
    public $username;
    public $password;

    public static function find_by_username($username = "") {
        $result_array = static::find_by_sql("SELECT * FROM users WHERE username='{$username}' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function authenticate($username = "", $password = "") {
        global $database;
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);

        $user = self::find_by_username($username);
        $hashed_password = "";
        if (!empty($user)) {
            $hashed_password = crypt($password, $user->password);
        }

        $sql = "SELECT * FROM users ";
        $sql .= "WHERE username = '{$username}' ";
        $sql .= "AND password = '{$hashed_password}' ";
        $sql .= "LIMIT 1";
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

}
