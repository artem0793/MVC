<?php

abstract class AbstractModel {
    protected $link;

    final public function __construct() {
        // Подключение к базе данных.
        // Если грубо.
        // $this->link = new PDO('mysql:dbname=mvc;host=127.0.0.1', 'root', 'cc');
    }
}
