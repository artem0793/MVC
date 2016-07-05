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
    $values = _get_request_data($fields, $method == 'get' ? $_GET : $_POST);

    return $values === $fields ? NULL : $values;
}

function _get_request_data($fields, $inputs) {
    $values = array();

    foreach ($fields as $field_name => $default_value) {
        if (isset($inputs[$field_name])) {
            $values[$field_name] = $inputs[$field_name];
        }
        else {
            $values[$field_name] = $default_value;
        }
    }

    return $values;
}

function variable_init() {
    global $config;

    $sth = db_link()->prepare('SELECT name, value FROM variables;');
    $sth->execute();

    foreach ($sth as $row) {
        $config[$row->name] = unserialize($row->value);
    }
}

function variable_get($name, $default_value = NULL) {
    global $config;

    return isset($config[$name]) ? $config[$name] : $default_value;
}

function variable_set($name, $value) {
    global $config;

    $sth = db_link()->prepare('INSERT INTO variables (name, value) VALUES (:name, :value) ON DUPLICATE KEY UPDATE value = :value;');
    $sth->execute(array(
        'name' => $name,
        'value' => serialize($value),
    ));
    $config[$name] = $value;
}

function l($path = '/') {
    if ($path[0] == '/' && !empty(Router::$path_suffix)) {
        return '/' . trim(Router::$path_suffix, '/') . $path;
    }

    return $path;
}
