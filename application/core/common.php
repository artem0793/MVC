<?php

define('FILE_CONFIG_PATH', DAPP . '/config.php');

function theme($template, array $vars = array()) {
    $template_file = DAPP . '/views/' . $template .'.tpl.php';

    if (!file_exists($template_file)) {
        return NULL;
    }

    if (!empty($vars)) {
        extract($vars);
    }

    ob_start();

    include $template_file;

    return ob_get_clean();
}

function get_request_data($fields, $method = 'get') {
    $method = '_' . strtoupper($method);
    $inputs = array_intersect_key($GLOBALS[$method], $fields);
    $values = array();

    foreach($fields as $field_name => $required) {
        if ($required && empty($inputs[$field_name])) {
            return NULL;
        }

        $values[$field_name] = !empty($inputs[$field_name]) ? urldecode($inputs[$field_name]) : NULL;
    }

    return $values;
}
