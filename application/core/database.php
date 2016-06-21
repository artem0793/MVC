<?php

function db_connect($config) {
    global $link;

    if (!$link) {
        try {
            $link = new PDO(
                'mysql:dbname=' . $config['dbname'] . ';host=' . $config['host'] . ';charset=UTF8',
                $config['username'],
                $config['password'],
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_AUTOCOMMIT => TRUE,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                )
            );
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

function db_link() {
    global $link;

    return $link;
}
