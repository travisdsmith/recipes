<?php

//VALIDATION FUNCTIONS
$errors = array();

function fieldname_as_text($fieldname) {
    $fieldname = str_replace("_", " ", $fieldname);
    $fieldname = ucfirst($fieldname);
    return $fieldname;
}

function has_presence($value) {
    return isset($value) && $value !== "";
}

function validate_presences($required_fields) {
    global $errors;
    foreach ($required_fields as $field) {
        $value = trim(filter_input(INPUT_POST, $field));
        if (!has_presence($value)) {
            $errors[$field] = fieldname_as_text($field) . " can't be blank.";
        }
    }
}

//OTHER FUNCTIONS
function redirect_to($location = NULL) {
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

function nl2li($string) {
    return "<li>" . implode("</li><li>", explode("\n", $string)) . "</li>";
}

function nl2brbr($string) {
    return str_replace("\n", "<br/><br/>", $string);
}

function nlnl2br($string) {
    return str_replace("\n", "<br/>", str_replace("\n\n", "<br/>", $string));
}

function my_autoloader($class_name) {
    $class_name = strtolower($class_name);
    $path = LIB_PATH . DS . "{$class_name}.php";
    if (file_exists($path)) {
        require_once($path);
    } else {
        die("The file {$class_name}.php could not be found.");
    }
}
spl_autoload_register('my_autoloader');

function output_message($message) {
    $msg_arr = explode("|", $message);
    if (!empty($msg_arr[1])) {
        switch ($msg_arr[0]) {
            case "info":
                return "<div class=\"alert alert-info\" role=\"alert\"><i class=\"fa fa-info-circle\"></i> " . htmlentities($msg_arr[1]) . "</div>";
            case "success":
                return "<div class=\"alert alert-success\" role=\"alert\"><i class=\"fa fa-check-circle\"></i> " . htmlentities($msg_arr[1]) . "</div>";
            case "warning":
                return "<div class=\"alert alert-warning\" role=\"alert\"><i class=\"fa fa-exclamation-circle\"></i> " . htmlentities($msg_arr[1]) . "</div>";
            case "danger":
                return "<div class=\"alert alert-danger\" role=\"alert\"><i class=\"fa fa-times-circle\"></i> " . htmlentities($msg_arr[1]) . "</div>";
        }
    } else {
        return "";
    }
}