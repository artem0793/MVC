<?php

function db_connect($config) {
    global $link;

    if (!$link) {
        try {
            $link = new PDO(
                'mysql:' . http_build_query(array(
                    'dbname' => $config['db']['name'],
                    'host' => $config['db']['host'],
                    'port' => $config['db']['port'],
                    'charset' => 'UTF8',
                ), '', ';'),
                $config['db']['username'],
                $config['db']['password'],
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_AUTOCOMMIT => TRUE,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                )
            );
        } catch (Exception $e) {
            header('Content-type: text/html; charset=utf8');
            Router::setStatus(500);
            print '<h3>Не удалось подключиться к MySQL серверу.</h3>';
            exit;
        }
    }
}

function db_link() {
    global $link;

    return $link;
}
